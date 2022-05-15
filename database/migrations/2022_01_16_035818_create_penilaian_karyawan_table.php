<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianKaryawanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_karyawan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_karyawan');
            $table->integer('id_unit_kerja');
            $table->integer('sertifikasi_lsp')->nullable();
            $table->string('no')->nullable();
            $table->string('file_sertifikasi')->nullable();
            $table->integer('nilai_kedisiplinan')->nullable()->default(0);
            $table->string('keterangan_hukuman')->nullable()->default('Tidak Hukuman');
            $table->string('keyword')->nullable()->default('-');
            $table->integer('nilai_kepatuhan')->nullable()->default(0);
            $table->integer('nilai_sikap_kerja')->nullable()->default(0);
            $table->integer('nilai_inisiatif')->nullable()->default(0);
            $table->boolean('status_promosi')->nullable()->default(0);
            $table->float('persentase')->nullable()->default(0);
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
        Schema::dropIfExists('penilaian_karyawan');
    }
}
