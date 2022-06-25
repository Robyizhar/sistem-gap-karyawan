<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;
// use App\Models\User;
use App\Models\Master\Unit;
use DB;

class PermissionsDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // delete semua data user, role, permission
        DB::table('menus')->delete();
        DB::table('users')->delete();
        DB::table('roles')->delete();
        DB::table('permissions')->delete();
        DB::table('model_has_permissions')->delete();
        DB::table('model_has_roles')->delete();
        DB::table('role_has_permissions')->delete();

        $menus = [
            'Dashboard',
            'Jabatan',
            'Unit',
            'Pangkat',
            'Level',
            'Karyawan',
            'Karyawan PKWT',
            'Penilaian',
            'Promosi',
            'User Group',
            'User',
            'Pensiun',
            'Penilaian NKI',
            'Kontrak',

            'Refresh',
            'SMTP',
            'Setting'
        ];

        for ($i=0; $i < sizeOf($menus); $i++) {
            Menu::create([ 'id' => $i+1, 'name' => $menus[$i] ]);
        }

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $index_menus = 0;
        $menu_id = 1;
        $menus = [
            'Dashboard',
            'Jabatan',
            'Unit',
            'Pangkat',
            'Level',
            'Karyawan',
            'Karyawan PKWT',
            'Penilaian',
            'Promosi',
            'User Group',
            'User',
            'Pensiun',
            'Penilaian NKI',
            'Kontrak'
        ];
        $actions = ['View', 'Add', 'Edit', 'Delete'];

        // buat permission
        do {
            for ($i=0; $i < sizeOf($actions); $i++) {
                Permission::create([
                    'name' => $actions[$i].'-'.$menus[$index_menus],
                    'menu_id' => $menu_id
                ]);
            }
            $index_menus++;
            $menu_id++;
        } while ($index_menus < sizeOf($menus));

        Permission::create(['name' => 'View-Rekapitulasi Level', 'menu_id' => 19 ]);
        Permission::create(['name' => 'View-Rekapitulasi Pangkat', 'menu_id' => 20 ]);
        Permission::create(['name' => 'View-Rekapitulasi PKWT', 'menu_id' => 23 ]);

        // buat role
        $kaun = Role::create(['id' => 3, 'name' => 'Kapala Unit']);
        $dir = Role::create(['id' => 2, 'name' => 'Direktur']);
        $admin = Role::create(['id' => 1, 'name' => 'Administrator']);
        $dev = Role::create(['id' => 4, 'name' => 'Developer']);
        $dev->givePermissionTo(Permission::all());
        $kaun->givePermissionTo(['View-Penilaian', 'Add-Penilaian', 'Edit-Penilaian', 'Delete-Penilaian', 'View-Penilaian NKI', 'Add-Penilaian NKI', 'Edit-Penilaian NKI', 'Delete-Penilaian NKI', 'View-Karyawan', 'View-Karyawan PKWT']);

        $units = Unit::get();

        $user = \App\Models\User::factory()->create([
            'name' => 'Developer',
            'unit_id' => null,
            'role_id' => 4,
            'email' => 'dev@peruri.com',
            'password' => Hash::make('dev')
        ]);

        $user->assignRole($dev);

        $user = \App\Models\User::factory()->create([
            'name' => 'HRD',
            'unit_id' => null,
            'role_id' => 1,
            'email' => 'hrd@peruri.com',
            'password' => Hash::make('hrd')
        ]);

        $user->assignRole($admin);

        $user = \App\Models\User::factory()->create([
            'name' => 'Direktur',
            'unit_id' => null,
            'role_id' => 2,
            'email' => 'direktur@peruri.com',
            'password' => Hash::make('direktur')
        ]);

        $user->assignRole($dir);

        foreach ($units as $unit) {
            $nama = 'Kepala ' . $unit->nama;
            $email = 'kepala_' . $unit->kode . '@peruri.com';
            $user = \App\Models\User::factory()->create([
                'name' => $nama,
                'unit_id' => $unit->id,
                'role_id' => 3,
                'email' => $email,
                'password' => Hash::make($unit->kode)
            ]);

            $user->assignRole($kaun);
        }
    }
}
