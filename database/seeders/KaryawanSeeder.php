<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Service\ServiceKaryawan;
use App\Models\Master\Karyawan;
use App\Models\Master\Jabatan;
use App\Models\Master\Unit;
use DB;
use Carbon;

class KaryawanSeeder extends Seeder
{
    protected $dummy;

    public function run() {

        $time = Carbon\Carbon::now();
        $now = $time->toDateTimeString();

        DB::table('karyawans')->delete();

        $this->dummy = new ServiceKaryawan;

        $jabatans = Jabatan::get();
        $karyawans = $this->dummy->dataKaryawan();
        $units = Unit::get();

        $data_karyawans = [];

        foreach ($karyawans as $karyawan) {

            foreach ($jabatans as $jabatan) {
                if ($karyawan[2] == $jabatan->nama) {
                    $data_karyawans [] = [
                        'np' =>  $karyawan[0],
                        'nama_lengkap' =>  $karyawan[1],
                        'tempat_lahir' =>  $karyawan[6],
                        'tanggal_lahir' =>  $karyawan[3],
                        'tanggal_masuk' =>  $karyawan[4],
                        'tanggal_pensiun' =>  $karyawan[5],
                        'level_id' =>  $karyawan[9],
                        'pangkat_id' =>  $karyawan[10],
                        'tmt_jabatan' =>  $now,
                        // 'masa_jabatan' =>  'Belum Update',
                        'jabatan_id' =>  $jabatan->id,
                        'unit' => $karyawan[8],
                    ];
                }
            }
        }

        $data_karyawan_unit = [];

        foreach ($data_karyawans as $data_karyawan) {

            foreach ($units as $unit) {
                if ($data_karyawan['unit'] == $unit->nama) {
                    Karyawan::create([
                        'np' =>  $data_karyawan['np'],
                        'nama_lengkap' =>  $data_karyawan['nama_lengkap'],
                        'tempat_lahir' =>  $data_karyawan['tempat_lahir'],
                        'tanggal_lahir' => date("Y-m-d", strtotime($data_karyawan['tanggal_lahir'])),
                        'tanggal_masuk' =>  date("Y-m-d", strtotime($data_karyawan['tanggal_masuk'])),
                        'tanggal_pensiun' =>  date("Y-m-d", strtotime($data_karyawan['tanggal_pensiun'])),
                        'level_id' =>  (int)$data_karyawan['level_id'],
                        'pangkat_id' =>  (int)$data_karyawan['pangkat_id'],
                        'tmt_jabatan' =>  date("Y-m-d", strtotime($data_karyawan['tanggal_masuk']. ' + 3 years')),
                        // 'masa_jabatan' =>  'Belum Update',
                        'jabatan_id' =>  (int)$data_karyawan['jabatan_id'],
                        'unit_kerja_id' => $unit->id
                    ]);
                }
            }
        }

    }
}
// $newDate = date('Y-m-d', strtotime($date. ' + 5 years'));
