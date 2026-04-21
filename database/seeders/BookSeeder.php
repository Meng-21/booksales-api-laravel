<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::insert([
            [
                'author_id' => 1,
                'title' => 'Hujan',
                'description' => 'Novel tentang masa depan',
                'year' => 2016
            ],
            [
                'author_id' => 2,
                'title' => 'Laskar Pelangi',
                'description' => 'Kisah inspiratif anak sekolah',
                'year' => 2005
            ],
            [
                'author_id' => 3,
                'title' => 'Bumi Manusia',
                'description' => 'Sejarah Indonesia',
                'year' => 1980
            ],
            [
                'author_id' => 4,
                'title' => 'Supernova',
                'description' => 'Fiksi ilmiah',
                'year' => 2001
            ],
            [
                'author_id' => 5,
                'title' => 'Ayat Ayat Cinta',
                'description' => 'Novel religi',
                'year' => 2004
            ],
         ]);

    }
}
