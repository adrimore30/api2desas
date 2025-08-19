<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('messages')->insert([
            [
                'content' => 'Hola, ¿cómo estás?',
                'is_read' => false,
                'sender_profile_id' => 1,
                'receiver_profile_id' => 2,
                'profile_id' => 1, // el remitente
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'content' => 'Todo bien, gracias. ¿Y tú?',
                'is_read' => false,
                'sender_profile_id' => 2,
                'receiver_profile_id' => 1,
                'profile_id' => 2, // el remitente
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
