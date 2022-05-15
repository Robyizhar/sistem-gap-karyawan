<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePensiunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pensiuns', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100)->nullable()->default('text');
            $table->string('unit_kerja', 100)->nullable()->default('text');
            $table->string('pangkat', 100)->nullable()->default('text');
            $table->string('sisa_masa_tugas', 100)->nullable()->default('text');
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
        Schema::dropIfExists('pensiuns');
    }
}
