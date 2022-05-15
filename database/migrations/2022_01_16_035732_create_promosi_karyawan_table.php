<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromosiKaryawanTable extends Migration {

    public function up() {
        Schema::create('promosi_karyawan', function (Blueprint $table) {
            $table->id();
            $table->integer('penilaian_karyawan_id');
            $table->integer('unit_id');
            $table->integer('jabatan_id');
            $table->integer('new_jabatan_id');
            $table->integer('pangkat_id');
            $table->integer('new_pangkat_id');
            $table->integer('level_id');
            $table->integer('new_level_id');
            $table->date('tmt_sebelumnya');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('promosi_karyawan');
    }
}
