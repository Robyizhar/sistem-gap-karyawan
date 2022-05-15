<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKontrakPkwtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontrak_pkwts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('karyawan_pkwt_id');
            $table->string('no_sp');
            $table->integer('kontrak_ke');
            $table->date('tanggal_sp');
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
            $table->date('tanggal_addendum');
            $table->timestamps();

            $table->foreign('karyawan_pkwt_id')->references('id')->on('karyawan_pkwt')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kontrak_pkwts');
    }
}
