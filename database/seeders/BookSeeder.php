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
        Book::create([
            'title' => 'Laskar Pelangi',
            'description' => 'An inspiring story about the struggle of a group of students and their teacher in Belitung',
            'price' => 40000,
            'stock' => 5,
            'cover_photo' => 'laskar_pelangi.jpg',
            'genre_id' => 1,
            'author_id' => 1,
        ]);

        Book::create([
            'title' => 'Bumi Manusia',
            'description' => 'A historical novel set in colonial Indonesia',
            'price' => 50000,
            'stock' => 7,
            'cover_photo' => 'bumi_manusia.jpg',
            'genre_id' => 2,
            'author_id' => 2,
        ]);

        Book::create([
            'title' => 'Dilan 1990',
            'description' => 'A romantic high school love story',
            'price' => 35000,
            'stock' => 10,
            'cover_photo' => 'dilan_1990.jpg',
            'genre_id' => 3,
            'author_id' => 4,
        ]);

        Book::create([
            'title' => 'Negeri 5 Menara',
            'description' => 'A story about students in Islamic boarding school chasing their dreams',
            'price' => 45000,
            'stock' => 6,
            'cover_photo' => 'negeri_5_menara.jpg',
            'genre_id' => 1,
            'author_id' => 5,
        ]);

        Book::create([
            'title' => 'Ayat-Ayat Cinta',
            'description' => 'A religious and romantic story set in Egypt',
            'price' => 48000,
            'stock' => 4,
            'cover_photo' => 'ayat_ayat_cinta.jpg',
            'genre_id' => 4,
            'author_id' => 1,
        ]);

    }
}
