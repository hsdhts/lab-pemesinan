<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelumasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelumas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sparepart_id')->onDelete('cascade')->onUpdate('cascade');
            $table->string('metode_pelumasan');
            $table->string('lubricant');
            $table->enum('lubricating_interval', ['sekali 60 hari','satu kali per shift']);
            $table->date('pelumasan_terakhir');
            $table->timestamps();
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
        Schema::dropIfExists('pelumas');
    }
}
