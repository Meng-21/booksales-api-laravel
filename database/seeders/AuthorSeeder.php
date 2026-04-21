<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::create([
            ['name' => 'Tere Liye','email' => 'tere@123.com'],
            ['name' => 'Andrea Hirata', 'email' => 'andrea@678.com'],
            ['name' => 'Pramoedya', 'email' => 'pram@oed.com'],
            ['name' => 'Dee Lestari', 'email' => 'dee@lar.com'],
            ['name' => 'Habiburrahman', 'email' => 'habib@rahman.com'],
        ]);
    }
}
