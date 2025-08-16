<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('publications')->insert([
            [
                'title_publication' => 'Derrumbe en la vía Morales - Piendamó',
                'type_publication' => 'Desastre Natural',
                'severity_publication' => 'Alta',
                'location_publication' => 'Vereda San Isidro, Morales, Cauca',
                'description_publication' => 'Un fuerte derrumbe bloqueó completamente la vía principal, impidiendo el paso vehicular y peatonal.',
                'url_imagen' => 'https://example.com/derrumbe.jpg',
                'date_publication' => Carbon::now()->subDays(2),
                'profile_id' => 1, // Asegúrate de que exista un perfil con ID=1
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title_publication' => 'Inundaciones en la zona urbana de Morales',
                'type_publication' => 'Emergencia Climática',
                'severity_publication' => 'Media',
                'location_publication' => 'Barrio La Esperanza, Morales, Cauca',
                'description_publication' => 'Las lluvias intensas provocaron el desbordamiento de una quebrada, afectando varias viviendas.',
                'url_imagen' => 'https://example.com/inundacion.jpg',
                'date_publication' => Carbon::now()->subDays(5),
                'profile_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title_publication' => 'Incendio forestal en zona rural',
                'type_publication' => 'Incendio',
                'severity_publication' => 'Alta',
                'location_publication' => 'Vereda Los Alpes, Morales, Cauca',
                'description_publication' => 'Un incendio de gran magnitud afecta cultivos y amenaza viviendas cercanas. Bomberos trabajan en la zona.',
                'url_imagen' => 'https://example.com/incendio.jpg',
                'date_publication' => Carbon::now()->subDay(),
                'profile_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
