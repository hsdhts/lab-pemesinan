<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStasiunIdToMesinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mesins', function (Blueprint $table) {
            $table->foreignId('stasiun_id')->nullable()->after('kategori_id');
            $table->foreign('stasiun_id')->references('id')->on('stasiuns')->onDelete('set null');
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
            $table->dropForeign(['stasiun_id']);
            $table->dropColumn('stasiun_id');
        });
    }
}