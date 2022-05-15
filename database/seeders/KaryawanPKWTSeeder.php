<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Master\KaryawanPKWT;
use App\Models\KontrakPkwt;
use App\Service\ServiceKaryawanPkwt;
use Carbon;
use DB;

class KaryawanPKWTSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $time = Carbon\Carbon::now();
        $now = $time->toDateTimeString();

        DB::table('karyawan_pkwt')->delete();
        DB::table('kontrak_pkwts')->delete();

        $service = new ServiceKaryawanPkwt;
        $karyawans = $service->dataKaryawanPkwt();
        $id = 1;

        foreach ($karyawans as $karyawan) {

            KaryawanPKWT::create([
                'id'            => $id,
                'np'            => $karyawan['np'],
                'nama'          => strtoupper($karyawan['nama']),
                'unit_id'       => $karyawan['unit_id'],
                'kode_bagan_id' => $karyawan['kode_bagan_id'],
                'status'        => $karyawan['status'],
                'kontrak'       => 1,
                'keterangan'    => $karyawan['status']
            ]);

            KontrakPkwt::create([
                'karyawan_pkwt_id'  => $id,
                'no_sp'             => 'SP-'.$id.'/1/2020',
                'tanggal_sp'        => date("Y-m-d", strtotime('2019-01-28')),
                'tanggal_mulai'     => date("Y-m-d", strtotime('2019-01-31')),
                'tanggal_berakhir'  => date("Y-m-d", strtotime('2022-04-03')),
                'tanggal_addendum'  => date("Y-m-d", strtotime('2019-03-31')),
                'kontrak_ke'        => 1
            ]);

            $id++;
        }
    }
}

