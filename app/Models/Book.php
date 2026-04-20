<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    private $books =[
        [
            'title' => 'Pulang',
            'description' => 'Petualangan seorang pelmula yang kembali kedesa kelahirannya',
            'price' => 40000,
            'stock' => 15,
            'cover_photo' => 'pulang.jpg',
            'genre_id' => 1,
            'author_id' => 1
        ],
        [
            'title' => 'Sebuah Seni untuk bersikap Bodo Amat',
            'description' => 'Buku yang enceritakan tentang kehidapan dan filosofi',
            'price' => 25000,
            'stock' => 5,
            'cover_photo' => 'Sebuah_seni.jpg',
            'genre_id' => 2,
            'author_id' => 2
        ],
        [
            'title' => 'Naruto',
            'description' => 'Buku yang menceritakan tentang fiksi',
            'price' => 10000,
            'stock' => 8,
            'cover_photo' => 'naruto.jpg',
            'genre_id' => 3,
            'author_id' => 3
        ],
    ];

    public function getBooks(){
        return $this->books;
    }
}
