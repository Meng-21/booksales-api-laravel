<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Genre::create([
            'name'=>'Action',
            'description'=>'Genre yang menekankan pada aksi,pertempuran dan kecepatan'
        ]);

        Genre::create([
            'name'=>'Romance',
            'description'=>'Genre yang menekankan pada hubungan romantis dan cinta'
        ]);

        Genre::create([
            'name'=>'Fantasi',
            'description'=>'Genre yang mengekplorasi imajinasi dan dunia tak nyata. '
        ]);

        Genre::create([
            'name' => 'Horor',
            'description' => 'Genre yang bertujuan menimbulkan rasa takut, tegang, dan misteri.'
        ]);

        Genre::create([
            'name' => 'Sejarah',
            'description' => 'Genre yang mengangkat peristiwa atau latar belakang sejarah nyata.'
        ]);

        Genre::create([
            'name' => 'Fiksi Ilmiah',
            'description' => 'Genre yang menggabungkan sains, teknologi, dan imajinasi masa depan.'
        ]);
    }
}
