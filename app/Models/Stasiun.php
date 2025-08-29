<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;

class Stasiun extends Model
{
    use HasFactory;
    use SoftDeletes, CascadesDeletes;

    protected $cascadeDeletes = ['mesins'];

    protected $dates = ['deleted_at'];

    protected $guarded = ['id'];

    protected $fillable = [
        'nama_stasiun',
        'kode_stasiun',
        'deskripsi'
    ];

    public function mesins()
    {
        return $this->hasMany(Mesin::class);
    }

    public function jadwalPreventive()
    {
        return $this->hasMany(JadwalPreventive::class);
    }
}
