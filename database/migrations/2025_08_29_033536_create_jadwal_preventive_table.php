<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalPreventiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_preventive', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mesin_id');
            $table->unsignedBigInteger('stasiun_id');
            $table->string('nama_preventive');
            $table->text('deskripsi')->nullable();
            $table->integer('periode');
            $table->enum('satuan_periode', ['hari', 'minggu', 'bulan', 'tahun'])->default('hari');
            $table->datetime('tanggal_mulai');
            $table->datetime('jadwal_berikutnya'); // Jadwal preventive maintenance berikutnya
            $table->datetime('jadwal_terakhir_dilakukan')->nullable(); // Kapan terakhir kali dilakukan
            $table->boolean('is_active')->default(true); // Status aktif/nonaktif
            $table->integer('prioritas')->default(1); // Prioritas (1=rendah, 2=sedang, 3=tinggi)
            $table->text('catatan')->nullable(); // Catatan tambahan
            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraints
            $table->foreign('mesin_id')->references('id')->on('mesins')->onDelete('cascade');
            $table->foreign('stasiun_id')->references('id')->on('stasiuns')->onDelete('cascade');

            // Index untuk performa
            $table->index(['mesin_id', 'stasiun_id', 'is_active']);
            $table->index('jadwal_berikutnya');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal_preventive');
    }
}
