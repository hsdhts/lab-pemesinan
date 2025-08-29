<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\JadwalPreventive;
use App\Models\Jadwal;
use App\Models\Maintenance;
use Carbon\Carbon;

class GeneratePreventiveSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'preventive:generate {--force : Force generate even if not due}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate jadwal maintenance dari preventive maintenance yang jatuh tempo';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Memulai generate jadwal preventive maintenance...');
        
        $force = $this->option('force');
        $today = Carbon::today();
        
        // Ambil jadwal preventive yang aktif dan jatuh tempo
        $query = JadwalPreventive::aktif()->with(['mesin', 'stasiun']);
        
        if (!$force) {
            $query->jatuhTempo();
        }
        
        $jadwalPreventives = $query->get();
        
        if ($jadwalPreventives->isEmpty()) {
            $this->info('Tidak ada jadwal preventive maintenance yang jatuh tempo.');
            return 0;
        }
        
        $this->info("Ditemukan {$jadwalPreventives->count()} jadwal preventive yang perlu diproses.");
        
        $generated = 0;
        $skipped = 0;
        
        foreach ($jadwalPreventives as $jadwalPreventive) {
            try {
                // Cari maintenance berdasarkan mesin_id
                $maintenance = Maintenance::where('mesin_id', $jadwalPreventive->mesin_id)->first();
                
                if (!$maintenance) {
                    $this->warn("Maintenance untuk mesin {$jadwalPreventive->mesin->nama_mesin} tidak ditemukan, dilewati.");
                    $skipped++;
                    continue;
                }
                
                // Cek apakah sudah ada jadwal untuk tanggal ini
                $existingJadwal = Jadwal::where('maintenance_id', $maintenance->id)
                    ->whereDate('tanggal_jadwal', $jadwalPreventive->jadwal_berikutnya)
                    ->first();
                
                if ($existingJadwal && !$force) {
                    $this->warn("Jadwal untuk {$jadwalPreventive->nama_preventive} sudah ada, dilewati.");
                    $skipped++;
                    continue;
                }
                
                // Buat jadwal baru
                $jadwal = new Jadwal();
                $jadwal->maintenance_id = $maintenance->id;
                $jadwal->tanggal_jadwal = $jadwalPreventive->jadwal_berikutnya;
                $jadwal->status = 'Belum Dikerjakan';
                $jadwal->keterangan = "Auto-generated dari preventive: {$jadwalPreventive->nama_preventive}";
                $jadwal->save();
                
                // Update jadwal preventive
                $jadwalPreventive->jadwal_terakhir_dilakukan = $jadwalPreventive->jadwal_berikutnya;
                $jadwalPreventive->jadwal_berikutnya = $jadwalPreventive->hitungJadwalBerikutnya();
                $jadwalPreventive->save();
                
                $this->info("✓ Generated jadwal untuk: {$jadwalPreventive->nama_preventive} - {$jadwalPreventive->mesin->nama_mesin}");
                $generated++;
                
            } catch (\Exception $e) {
                $this->error("✗ Error generating jadwal untuk {$jadwalPreventive->nama_preventive}: {$e->getMessage()}");
            }
        }
        
        $this->info("\nSelesai! Generated: {$generated}, Skipped: {$skipped}");
        
        return 0;
    }
}
