<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Carbon;

class IndexPenilaianSeeder extends Seeder {

    public function run() {

        DB::table('index_penilaians')->delete();

        $questions = [
            'Apakah karyawan selalu datang tepat waktu saat bekerja?',
            'Apakah semua pekerjaan karyawan selesai dengan baik dan tepat waktu?',
            'Apakah karyawan menolak atau menerima tugas tambahan dari atasan karyawan?',
            'Apakah target karyawan semua tercapai?',
            'Apakah karyawan mampu bersikap baik dengan atasan dan rekan kerja sesama yang ada di satu perusahaan tersebut?',
            'Apakah SOP semua berjalan baik?',
            'Apakah karyawan bisa berkoordinasi dengan semua bagian baik atasan maupun bawahan dan juga team?'
        ];

        $index = 1;

        for ($i=0; $i < count($questions); $i++) {
            DB::table('index_penilaians')->insert([
                ['id' => $index, 'question' => $questions[$i]]
            ]);
            $index++;
        }

    }

}
