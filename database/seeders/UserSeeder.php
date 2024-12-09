<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Buat peran (roles) jika belum ada
        $roles = ['Admin', 'Kepala Sekolah', 'Guru'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        $users = [
            [
                'name'      => 'Admin Sekolah',
                'username'  => 'admin',
                'email'     => 'admin@sch.id',
                'role'      => 'Admin',
                'status'    => 'Aktif',
                'password'  => bcrypt('Password123'),
            ],
            [
                'name'      => 'Kepala Sekolah',
                'username'  => 'kepsek',
                'email'     => 'kepsek@sch.id',
                'role'      => 'Kepala Sekolah',
                'status'    => 'Aktif',
                'password'  => bcrypt('Bismillah'),
            ],
            [
                'name'      => 'Guru Matematika',
                'username'  => 'guru_math',
                'email'     => 'guru@sch.id',
                'role'      => 'Guru',
                'status'    => 'Aktif',
                'password'  => bcrypt('PasswordGuru'),
            ]
        ];

        // foreach ($users as $data) {
        //     $user = User::create([
        //         'name'      => $data['name'],
        //         'username'  => $data['username'],
        //         'email'     => $data['email'],
        //         'status'    => $data['status'],
        //         'password'  => $data['password'],
        //     ]);

        //     $user->assignRole($data['role']);
        //     $this->command->info('Data User ' . $user->name . ' dengan peran ' . $data['role'] . ' telah dibuat.');
        // }
        foreach ($users as $data) {
            $user = User::create([
                'name'      => $data['name'],
                'username'  => $data['username'],
                'email'     => $data['email'],
                'status'    => $data['status'],
                'password'  => $data['password'],
            ]);

            // Pastikan role sudah ada dan sudah terassign
            $role = Role::where('name', $data['role'])->first();
            if ($role) {
                $user->assignRole($role);
                $this->command->info('Role "' . $role->name . '" assigned to user "' . $user->name . '"');
            } else {
                $this->command->info('Role "' . $data['role'] . '" not found for user "' . $user->name . '"');
            }

            $this->command->info('Data User ' . $user->name . ' dengan peran ' . $data['role'] . ' telah dibuat.');
        }

    }
}
