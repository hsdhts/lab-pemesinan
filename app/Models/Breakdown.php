<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breakdown extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function mesin()
    {
        return $this->belongsTo(Mesin::class);
    }

    public function spareparts()
    {
        return $this->belongsToMany(Sparepart::class)->withPivot('jumlah');
    }
}
