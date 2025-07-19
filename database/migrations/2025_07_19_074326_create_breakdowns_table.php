<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBreakdownsTable extends Migration
{
    public function up()
    {
        Schema::create('breakdowns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mesin_id')->constrained()->onDelete('cascade');
            $table->dateTime('tanggal_kejadian');
            $table->dateTime('tanggal_selesai')->nullable();
            $table->text('deskripsi_masalah');
            $table->text('tindakan_perbaikan')->nullable();
            $table->enum('status', ['belum', 'on_going', 'selesai'])->default('belum');
            $table->string('foto_kerusakan')->nullable();
            $table->string('foto_perbaikan')->nullable();
            $table->timestamps();
        });

        Schema::create('breakdown_sparepart', function (Blueprint $table) {
            $table->id();
            $table->foreignId('breakdown_id')->constrained()->onDelete('cascade');
            $table->foreignId('sparepart_id')->constrained()->onDelete('cascade');
            $table->integer('jumlah');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('breakdown_sparepart');
        Schema::dropIfExists('breakdowns');
    }
}
