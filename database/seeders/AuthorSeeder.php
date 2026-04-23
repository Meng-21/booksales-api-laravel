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
            'name' => 'Tere Liye',
            'email' => 'tere@123.com'
         ]);

        Author::create([
            'name' => 'Pramoedya Ananta Toer',
            'email' => 'pram@oeed.com',
        ]);

        Author::create([
            'name' => 'Andrea Hirata',
            'email' => 'andrea@678.com',
        ]);

        Author::create([
            'name' => 'Pidi Baiq',
            'email' => 'pidi@baiq.com',
        ]);

        Author::create([
            'name' => 'Ahmad Fuadi',
            'email' => 'fuadi@menara.com',
        ]);
    }
}
