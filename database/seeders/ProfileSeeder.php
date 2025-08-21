<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        Profile::create([
            'password' => bcrypt('123456'),
            'photo' => 'default.png',
            'user_id' => 1,
            'role_id' => 1,
        ]);

        Profile::create([
            'password' => bcrypt('654321'),
            'photo' => 'avatar2.png',
            'user_id' => 2,
            'role_id' => 2,
        ]);
    }
}
