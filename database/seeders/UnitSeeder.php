<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Service\ServiceKaryawan;
use App\Models\Master\Unit;
use DB;

class UnitSeeder extends Seeder
{
    protected $dummy;

    public function run() {
        DB::table('units')->delete();

        $this->dummy = new ServiceKaryawan;

        $units = $this->dummy->dataUnit();
        $index = 1;
        foreach ($units as $unit) {
            Unit::create([
                'id' => $index,
                'kode' => $unit['kode'],
                'nama' => $unit['nama']
            ]);
            $index++;
        }
    }
}
