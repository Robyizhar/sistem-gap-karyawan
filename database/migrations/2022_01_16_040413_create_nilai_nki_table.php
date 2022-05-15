<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiNkiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_nki', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('id_karyawan');
            $table->string('file');
            $table->string('tahun');
            $table->string('nilai_nki');

            $table->foreign('id_karyawan')->references('id')->on('karyawans')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nilai_nki');
    }
}
