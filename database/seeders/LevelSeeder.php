<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Master\Level;
use DB;

class LevelSeeder extends Seeder
{

    public function run() {

        DB::table('levels')->delete();

        $levels = [
            'Senior',
            'Auditor',
            'Kepala ',
            'Penangg',
            'Koordin',
            'Staff C',
            'Penyusu',
            'Junior ',
            'Staff K',
            'Sekreta',
            'Staff P',
            'Perenca',
            'Juris I',
            'Juris J',
            'Staff R',
            'Staff T',
            'Head of',
            'Pengadm',
            'Coordin',
            'Ahli Pe',
            'Ahli Mu',
            'Asisten',
            'Pengelo',
            'Koodina',
            'Staff M',
            'Ahli Ma',
            'Petugas',
            'Widyais',
            'Officer',
            'Pengeva',
            'Network',
            'Applica',
            'Penata ',
            'Pemrose',
            'Komanda',
            'ICT Tec',
            'Pengana',
            'Periset',
            'Drawer ',
            'Desaine',
            'Analis ',
            'Pembuat',
            'OP IV',
            'OP III',
            'OP II',
            'OP I',
            'OP Cukai',
            'Asistan',
            'Teknisi',
            'OP 2',
            'OP Elektronik',
            'Pemasan',
            'Pemerik',
            'Perekay',
            'OP Sekuriti',
        ];

        for ($index=0; $index < count($levels); $index++) {

            Level::create([
                'id' => $index + 1, 'kode' => $index + 1, 'nama' => $levels[$index]
            ]);

        }

    }
}
