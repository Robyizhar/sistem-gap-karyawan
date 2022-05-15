<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('np');
            $table->string('nama_lengkap');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->date('tanggal_masuk');
            $table->date('tanggal_pensiun');
            // $table->string('tanggal_mpp');
            $table->boolean('status_pensiun')->default(0);
            // $table->string('kode_unit_kerja');
            $table->integer('unit_kerja_id');
            $table->integer('jabatan_id');
            $table->integer('level_id');
            // $table->integer('grade_jabatan_id');
            $table->integer('pangkat_id');
            // $table->string('grade_pangkat');
            $table->date('tmt_jabatan');
            // $table->string('masa_jabatan');
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);


            // $table->foreign('jabatan_id')->references('id')->on('jabatan')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('pangkat_id')->references('id')->on('pangkats')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('unit_kerja_id')->references('id')->on('units')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('posisi_id')->references('id')->on('posisi')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karyawans');
    }
}
