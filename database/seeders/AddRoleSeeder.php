<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AddRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name'          => 'Perpustakaan',
                'guard_name'    => 'web'
            ],
            [
                'name'          => 'PPDB',
                'guard_name'    => 'web'
            ]
        ];

        foreach ($roles as $roleData) {
            $role = Role::firstOrCreate($roleData);
            $this->command->info('Role "' . $role->name . '" has been created or already exists.');
        }
    }
}
