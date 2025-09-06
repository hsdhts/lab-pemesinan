<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovePeriodeAndSatuanPeriodeFromMaintenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('maintenances', function (Blueprint $table) {
            $table->dropColumn(['periode', 'satuan_periode']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('maintenances', function (Blueprint $table) {
            $table->integer('periode')->nullable();
            $table->string('satuan_periode')->nullable();
        });
    }
}
