<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class JadwalPreventive extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'jadwal_preventive';

    protected $fillable = [
        'mesin_id',
        'stasiun_id',
        'nama_preventive',
        'deskripsi',
        'periode',
        'satuan_periode',
        'tanggal_mulai',
        'jadwal_berikutnya',
        'jadwal_terakhir_dilakukan',
        'is_active',
        'prioritas',
        'catatan'
    ];

    protected $dates = [
        'tanggal_mulai',
        'jadwal_berikutnya',
        'jadwal_terakhir_dilakukan',
        'deleted_at'
    ];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'jadwal_berikutnya' => 'datetime',
        'jadwal_terakhir_dilakukan' => 'datetime',
        'is_active' => 'boolean'
    ];

    // Relasi dengan Mesin
    public function mesin()
    {
        return $this->belongsTo(Mesin::class);
    }

    // Relasi dengan Stasiun
    public function stasiun()
    {
        return $this->belongsTo(Stasiun::class);
    }

    // Fungsi untuk menghitung jadwal berikutnya
    public function hitungJadwalBerikutnya($tanggalDasar = null)
    {
        $tanggal = $tanggalDasar ? Carbon::parse($tanggalDasar) : Carbon::now();
        
        switch ($this->satuan_periode) {
            case 'hari':
                return $tanggal->addDays($this->periode);
            case 'minggu':
                return $tanggal->addWeeks($this->periode);
            case 'bulan':
                return $tanggal->addMonths($this->periode);
            case 'tahun':
                return $tanggal->addYears($this->periode);
            default:
                return $tanggal->addDays($this->periode);
        }
    }

    // Fungsi untuk update jadwal setelah maintenance dilakukan
    public function selesaiMaintenance()
    {
        $this->jadwal_terakhir_dilakukan = Carbon::now();
        $this->jadwal_berikutnya = $this->hitungJadwalBerikutnya();
        $this->save();
    }

    // Scope untuk jadwal yang sudah jatuh tempo
    public function scopeJatuhTempo($query)
    {
        return $query->where('jadwal_berikutnya', '<=', Carbon::now())
                    ->where('is_active', true);
    }

    // Scope untuk jadwal aktif
    public function scopeAktif($query)
    {
        return $query->where('is_active', true);
    }

    // Fungsi untuk mendapatkan status prioritas dalam text
    public function getPrioritasTextAttribute()
    {
        switch ($this->prioritas) {
            case 1:
                return 'Rendah';
            case 2:
                return 'Sedang';
            case 3:
                return 'Tinggi';
            default:
                return 'Rendah';
        }
    }

    // Fungsi untuk mendapatkan warna badge berdasarkan prioritas
    public function getPrioritasColorAttribute()
    {
        switch ($this->prioritas) {
            case 1:
                return 'success'; // hijau
            case 2:
                return 'warning'; // kuning
            case 3:
                return 'danger'; // merah
            default:
                return 'secondary';
        }
    }
}
