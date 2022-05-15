<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawanPkwtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawan_pkwt', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('np');
            $table->string('nama');
            $table->unsignedBigInteger('unit_id');
            $table->string('kode_bagan_id');
            $table->string('status');
            $table->integer('kontrak');
            $table->string('keterangan');
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karyawan_pkwt');
    }
}
