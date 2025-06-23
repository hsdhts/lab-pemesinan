<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ShiftOneLabs\LaravelCascadeDeletes\CascadesDeletes;


class KernelHydroCyclone extends Model
{
    use HasFactory;
    use SoftDeletes, CascadesDeletes;


    protected $guarded = ['id'];

    // public function kernelhydrocyclones()
    // {
    //     return $this->belongs
    // }
}
