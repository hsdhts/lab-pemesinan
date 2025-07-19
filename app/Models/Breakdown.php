<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Breakdown extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'tanggal_kejadian' => 'datetime',
        'tanggal_selesai' => 'datetime'
    ];

    public function mesin()
    {
        return $this->belongsTo(Mesin::class);
    }

    public function spareparts()
    {
        return $this->belongsToMany(Sparepart::class, 'breakdown_sparepart')
                    ->withPivot(['jumlah'])
                    ->withTimestamps();
    }
}
