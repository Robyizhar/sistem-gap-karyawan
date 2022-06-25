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

            $datestart_tanggal_mulai = strtotime('2019-12-10');
            $dateend_tanggal_mulai = strtotime('2021-12-31');
            $daystep_tanggal_mulai = 86400;
            $datebetween_tanggal_mulai = abs(($dateend_tanggal_mulai - $datestart_tanggal_mulai) / $daystep_tanggal_mulai);
            $randomday_tanggal_mulai = rand(0, $datebetween_tanggal_mulai);

            $datestart_tanggal_berakhir = strtotime('2021-12-10');
            $dateend_tanggal_berakhir = strtotime('2023-12-31');
            $daystep_tanggal_berakhir = 86400;
            $datebetween_tanggal_berakhir = abs(($dateend_tanggal_berakhir - $datestart_tanggal_berakhir) / $daystep_tanggal_berakhir);
            $randomday_tanggal_berakhir = rand(0, $datebetween_tanggal_berakhir);

            KontrakPkwt::create([
                'karyawan_pkwt_id'  => $id,
                'no_sp'             => 'SP-'.$id.'/1/2020',
                'tanggal_sp'        => date("Y-m-d", strtotime('2021-01-28')),
                'tanggal_mulai'     => date("Y-m-d", $datestart_tanggal_mulai + ($randomday_tanggal_mulai * $daystep_tanggal_mulai)),
                'tanggal_berakhir'  => date("Y-m-d", $datestart_tanggal_berakhir + ($randomday_tanggal_berakhir * $daystep_tanggal_berakhir)),
                'tanggal_addendum'  => date("Y-m-d", strtotime('2019-03-31')),
                'kontrak_ke'        => 2
            ]);

            $id++;
        }
    }
}

