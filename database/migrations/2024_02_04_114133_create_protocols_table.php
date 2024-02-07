<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProtocolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protocols', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mesin_id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('sparepart_id')->onDelete('cascade')->onUpdate('cascade');
            $table->string('inspection_item');
            $table->string('tolerance');
            $table->string('data');
            $table->enum('validation_data', ['Good', 'Not Good']);
            $table->date('last_protocol');
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
        Schema::dropIfExists('protocols');
    }
}
