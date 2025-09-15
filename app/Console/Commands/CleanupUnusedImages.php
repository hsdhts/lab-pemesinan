<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\Jadwal;
use App\Models\Maintenance;
use App\Services\ImageOptimizationService;

class CleanupUnusedImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:cleanup {--dry-run : Show what would be deleted without actually deleting}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up unused images from storage';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $isDryRun = $this->option('dry-run');
        $imageService = new ImageOptimizationService();
        
        $this->info('Starting image cleanup process...');
        
        if ($isDryRun) {
            $this->warn('DRY RUN MODE - No files will be deleted');
        }

        // Get all images from database
        $usedImages = collect();
        
        // Get images from jadwals table
        $jadwalImages = Jadwal::whereNotNull('foto_perbaikan')
            ->pluck('foto_perbaikan')
            ->filter();
        $usedImages = $usedImages->merge($jadwalImages);
        
        // Get images from maintenance table
        $maintenanceImages = Maintenance::whereNotNull('foto_kerusakan')
            ->pluck('foto_kerusakan')
            ->filter();
        $usedImages = $usedImages->merge($maintenanceImages);
        
        // Remove duplicates
        $usedImages = $usedImages->unique();
        
        $this->info(sprintf('Found %d images in database', $usedImages->count()));
        
        // Get all images from storage
        $storageFolders = ['foto_perbaikan', 'maintenance_photos'];
        $storageImages = collect();
        
        foreach ($storageFolders as $folder) {
            if (Storage::disk('public')->exists($folder)) {
                $folderImages = collect(Storage::disk('public')->files($folder))
                    ->filter(function ($file) {
                        return in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                    });
                $storageImages = $storageImages->merge($folderImages);
            }
        }
        
        $this->info(sprintf('Found %d images in storage', $storageImages->count()));
        
        // Find unused images
        $unusedImages = $storageImages->diff($usedImages);
        
        if ($unusedImages->isEmpty()) {
            $this->info('No unused images found!');
            return 0;
        }
        
        $this->warn(sprintf('Found %d unused images:', $unusedImages->count()));
        
        $totalSize = 0;
        $deletedCount = 0;
        
        foreach ($unusedImages as $imagePath) {
            $size = $imageService->getImageSize($imagePath) ?: 0;
            $totalSize += $size;
            
            $this->line(sprintf('- %s (%s)', $imagePath, $this->formatBytes($size)));
            
            if (!$isDryRun) {
                if ($imageService->deleteImage($imagePath)) {
                    $deletedCount++;
                } else {
                    $this->error(sprintf('Failed to delete: %s', $imagePath));
                }
            }
        }
        
        if ($isDryRun) {
            $this->info(sprintf('Would delete %d images, saving %s of storage space', 
                $unusedImages->count(), 
                $this->formatBytes($totalSize)
            ));
        } else {
            $this->info(sprintf('Successfully deleted %d images, freed %s of storage space', 
                $deletedCount, 
                $this->formatBytes($totalSize)
            ));
        }
        
        return 0;
    }
    
    /**
     * Format bytes to human readable format
     *
     * @param int $bytes
     * @return string
     */
    private function formatBytes(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        
        $bytes /= pow(1024, $pow);
        
        return round($bytes, 2) . ' ' . $units[$pow];
    }
}