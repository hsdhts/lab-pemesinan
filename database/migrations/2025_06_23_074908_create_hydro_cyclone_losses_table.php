<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHydroCycloneLossesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hydro_cyclone_losses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('image_HydroCycloneLosses');
            $table->string('shift');
            $table->string('nama_operator');
            $table->string('sample_weight');
            $table->string('whole_kernel');
            $table->string('broken_kernel');
            $table->string('whole_nut');
            $table->string('broken_nut');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hydro_cyclone_losses');
    }
}
