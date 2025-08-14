<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener todos los usuarios y roles existentes
        $users = User::all();
        $roles = Role::all();

        // Verificar que existan usuarios y roles
        if ($users->isEmpty() || $roles->isEmpty()) {
            $this->command->warn('⚠️ Asegúrate de tener usuarios y roles antes de ejecutar ProfileSeeder.');
            return;
        }

        // Crear un perfil para cada usuario
        foreach ($users as $user) {
            Profile::create([
                'user_id'  => $user->id,
                'role_id'  => $roles->random()->id, // Asigna un rol aleatorio
                'password' => bcrypt('password123'), // Contraseña por defecto
                'photo'    => 'default.jpg',         // Imagen por defecto
            ]);
        }

        $this->command->info('✅ Perfiles creados exitosamente.');
    }
}
