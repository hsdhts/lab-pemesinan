<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKernelHydroCyclonesTable extends Migration
{
    public function up()
    {
        Schema::create('kernel_hydro_cyclones', function (Blueprint $table) {
            $table->id();
            $table->string('image_kernelHydroCyclone');
            $table->string('shift');
            $table->string('nama_operator');
            $table->string('hydrocyclone');
            $table->string('sample_weight');
            $table->string('whole_nut');
            $table->string('shell_from_whole_nut');
            $table->string('broken_nut');
            $table->string('shell_from_broken_nut');
            $table->string('loose_shell');
            $table->string('stone');
            $table->string('broken_kernel');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kernel_hydro_cyclones');
    }
}
