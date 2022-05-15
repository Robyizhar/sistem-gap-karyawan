<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Master\Pangkat;
use DB;

class PangkatSeeder extends Seeder
{
    public function run() {

        DB::table('pangkats')->delete();
        $pangkats = [
            ['Supervisor (13)', '13'],
            ['Asisten Spv (12)', '12'],
            ['Sub-manager (14)', '14'],
            ['Senior Staff (11)', '11'],
            ['Senior Manager (17)', '17'],
            ['Asisten Manager (15)', '15'],
            ['Staff-3 (9)', '9'],
            ['Staff-4 (10)', '10'],
            ['Staff-2 (8)', '8'],
            ['Senior Spv (14)', '14'],
            ['Asisten VP (18)', '18'],
            ['Manager (16)', '16'],
            ['Deputi Manager (16)', '16'],
            ['Staff-1 (7)', '7'],
            ['VP 1 (18)', '18'],
            ['VP 2 (19)', '19'],
            ['Senior VP (20)', '20'],
        ];

        for ($index=0; $index < count($pangkats); $index++) {
            Pangkat::create([ 
                'id' => $index+1, 
                'kode' => $pangkats[$index][1], 
                'nama' => $pangkats[$index][0], 
                'grade' => $pangkats[$index][1] 
            ]);
        }
    }
}
