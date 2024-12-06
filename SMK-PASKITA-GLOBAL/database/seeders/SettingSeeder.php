<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run()
    {
        $user = User::where('role', 'Admin')->first();

        if ($user) {
            Setting::create([
                'isEmail'   => false,
                'user_id'   => $user->id
            ]);
            $this->command->info('Data Setting has been saved.');
        } else {
            $this->command->info('Admin user not found. Skipping setting creation.');
        }
    }
}
