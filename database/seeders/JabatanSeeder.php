<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Service\ServiceKaryawan;
use App\Models\Master\Jabatan;
use DB;

class JabatanSeeder extends Seeder
{
    protected $dummy;

    public function run() {

        DB::table('jabatans')->delete();

        $this->dummy = new ServiceKaryawan;

        $jabatans = $this->dummy->dataJabatan();
        $index = 1;
        foreach ($jabatans as $jabatan) {
            Jabatan::create([
                'id' => $index,
                'kode' => $index,
                'nama' => $jabatan['nama']
            ]);
            $index++;
        }

    }
}
