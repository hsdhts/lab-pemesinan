<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;


class Maintenance extends Model
{
    use HasFactory;
    use SoftDeletes, CascadesDeletes;

    protected $cascadeDeletes = ['jadwal', 'form'];

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'mesin_id',
        'nama_maintenance',
        'deskripsi',
        'interval',
        'warna',
        'foto_kerusakan'
    ]; 

    public function mesin(){
        return $this->belongsTo(Mesin::class);
    }

    public function jadwal(){
        return $this->hasMany(Jadwal::class);
    }

    public function sparepart() {
        return $this->belongsToMany(Sparepart::class)->withPivot('jumlah');
    }

    public function form(){
        return $this->hasMany(Form::class);
    }

    public function rencana_terakhir(){
        return $this->hasOne(Jadwal::class)->latestOfMany('tanggal_rencana');       
    }

    public function jadwalPreventive(){
        return $this->hasMany(JadwalPreventive::class);
    }

}
