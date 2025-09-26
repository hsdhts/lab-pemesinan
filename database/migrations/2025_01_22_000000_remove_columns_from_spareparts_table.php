<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnsFromSparepartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('spareparts', function (Blueprint $table) {
            $table->dropColumn(['sparepart_image', 'jumlah', 'estimasi']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('spareparts', function (Blueprint $table) {
            $table->string('sparepart_image')->after('id');
            $table->integer('jumlah')->after('nama_sparepart');
            $table->date('estimasi')->nullable()->after('jumlah');
        });
    }
}