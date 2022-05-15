<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JabatanRelation;
use App\Service\ServiceKaryawan;
use App\Models\Master\Jabatan;
use App\Models\Master\Unit;
use DB;

class AksesJabatanSeeder extends Seeder
{

    public function run() {

        DB::table('jabatan_relations')->delete();

        $this->dummy = new ServiceKaryawan;

        $jabatans = Jabatan::get();
        $units = Unit::get();

        $jabatan_relation = $this->dummy->jabatanRelation();
        $index = 1;

        $matching_jabatan = [];

        foreach ($jabatan_relation as $relation) {
            foreach ($jabatans as $jabatan) {
                if ($relation['jabatan'] == $jabatan->nama) {
                    $matching_jabatan [] = [
                        'jabatan_id' =>  $jabatan->id,
                        'level_id' =>  $relation['level'],
                        'pangkat_id' =>  $relation['pangkat'],
                        'unit' =>  $relation['unit'],
                    ];
                }
            }
        }

        foreach ($matching_jabatan as $key) {
            
            foreach ($units as $unit) {
                if ($key['unit'] == $unit->nama) {

                    JabatanRelation::create([
                        'id' => $index,
                        'jabatan_id' =>  $key['jabatan_id'],
                        'level_id' =>  $key['level_id'],
                        'pangkat_id' =>  $key['pangkat_id'],
                        'unit_id' =>  $unit->id,
                    ]);
                    $index++;
                }
            }

        }

    }
}
