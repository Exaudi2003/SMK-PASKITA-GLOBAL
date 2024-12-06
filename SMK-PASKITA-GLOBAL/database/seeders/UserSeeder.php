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

        // Data pengguna dengan peran masing-masing
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

        // Loop untuk membuat data user dan assign role
        foreach ($users as $data) {
            $user = User::create([
                'name'      => $data['name'],
                'username'  => $data['username'],
                'email'     => $data['email'],
                'status'    => $data['status'],
                'password'  => $data['password'],
            ]);

            // Assign peran ke user
            $user->assignRole($data['role']);
            $this->command->info('Data User ' . $user->name . ' dengan peran ' . $data['role'] . ' telah dibuat.');
        }
    }
}
