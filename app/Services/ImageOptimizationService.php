<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageOptimizationService
{
    /**
     * Optimize and store uploaded image
     *
     * @param UploadedFile $file
     * @param string $folder
     * @param int $maxWidth
     * @param int $maxHeight
     * @param int $quality
     * @return string|null
     */
    public function optimizeAndStore(
        UploadedFile $file,
        string $folder,
        int $maxWidth = 1200,
        int $maxHeight = 800,
        int $quality = 85
    ): ?string {
        try {
            // Create organized folder structure by date
            $dateFolder = date('Y/m');
            $fullFolder = $folder . '/' . $dateFolder;
            
            // Generate unique filename
            $filename = date('d_His') . '_' . uniqid() . '.jpg';
            $path = $fullFolder . '/' . $filename;
            
            // Create optimized image with ImageManager v3
            $manager = new ImageManager(new Driver());
            $image = $manager->read($file->getPathname())
                ->scaleDown($maxWidth, $maxHeight)
                ->toJpeg($quality);
            
            // Store to public disk
            Storage::disk('public')->put($path, $image->toString());
            
            return $path;
        } catch (\Exception $e) {
            \Log::error('Image optimization failed: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Create thumbnail version of image
     *
     * @param string $imagePath
     * @param int $width
     * @param int $height
     * @return string|null
     */
    public function createThumbnail(
        string $imagePath,
        int $width = 300,
        int $height = 200
    ): ?string {
        try {
            if (!Storage::disk('public')->exists($imagePath)) {
                return null;
            }

            $pathInfo = pathinfo($imagePath);
            $thumbnailPath = $pathInfo['dirname'] . '/thumb_' . $pathInfo['basename'];
            
            $manager = new ImageManager(new Driver());
            $image = $manager->read(Storage::disk('public')->path($imagePath))
                ->cover($width, $height)
                ->toJpeg(80);
            
            Storage::disk('public')->put($thumbnailPath, $image->toString());
            
            return $thumbnailPath;
        } catch (\Exception $e) {
            \Log::error('Thumbnail creation failed: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Delete image and its thumbnail
     *
     * @param string $imagePath
     * @return bool
     */
    public function deleteImage(string $imagePath): bool
    {
        try {
            $deleted = true;
            
            // Delete main image
            if (Storage::disk('public')->exists($imagePath)) {
                $deleted = Storage::disk('public')->delete($imagePath);
            }
            
            // Delete thumbnail if exists
            $pathInfo = pathinfo($imagePath);
            $thumbnailPath = $pathInfo['dirname'] . '/thumb_' . $pathInfo['basename'];
            
            if (Storage::disk('public')->exists($thumbnailPath)) {
                Storage::disk('public')->delete($thumbnailPath);
            }
            
            return $deleted;
        } catch (\Exception $e) {
            \Log::error('Image deletion failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get optimized image URL
     *
     * @param string|null $imagePath
     * @param bool $thumbnail
     * @return string|null
     */
    public function getImageUrl(?string $imagePath, bool $thumbnail = false): ?string
    {
        if (!$imagePath) {
            return null;
        }

        if ($thumbnail) {
            $pathInfo = pathinfo($imagePath);
            $thumbnailPath = $pathInfo['dirname'] . '/thumb_' . $pathInfo['basename'];
            
            if (Storage::disk('public')->exists($thumbnailPath)) {
                return Storage::disk('public')->url($thumbnailPath);
            }
        }

        return Storage::disk('public')->exists($imagePath) 
            ? Storage::disk('public')->url($imagePath) 
            : null;
    }

    /**
     * Get image file size in bytes
     *
     * @param string $imagePath
     * @return int|null
     */
    public function getImageSize(string $imagePath): ?int
    {
        try {
            return Storage::disk('public')->exists($imagePath) 
                ? Storage::disk('public')->size($imagePath) 
                : null;
        } catch (\Exception $e) {
            return null;
        }
    }
}