<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(PangkatSeeder::class);
        $this->call(LevelSeeder::class);
        $this->call(JabatanSeeder::class);
        $this->call(UnitSeeder::class);
        $this->call(AksesJabatanSeeder::class);
        $this->call(KaryawanSeeder::class);
        $this->call(KaryawanPKWTSeeder::class);
        $this->call(PermissionsDemoSeeder::class);
        $this->call(IndexPenilaianSeeder::class);
    }
}
