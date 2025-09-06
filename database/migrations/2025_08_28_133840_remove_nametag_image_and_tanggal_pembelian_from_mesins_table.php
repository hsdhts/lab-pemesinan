<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveNametagImageAndTanggalPembelianFromMesinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mesins', function (Blueprint $table) {
            $table->dropColumn(['nameTag_image', 'tanggal_pembelian']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mesins', function (Blueprint $table) {
            $table->string('nameTag_image')->nullable();
            $table->date('tanggal_pembelian')->nullable();
        });
    }
}
