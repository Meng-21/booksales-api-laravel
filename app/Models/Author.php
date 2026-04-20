<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    private $authors =[
        [
            'id' => 1,
            'nama'=> 'Andrea Hirata'
        ],
        [
            'id' => 2,
            'nama' => 'Tere Liye'
        ],
        [
            'id' => 3,
            'nama' => 'Pramoedya Ananta  Toer'   
        ],
        [
            'id' => 4,
            'nama' => 'Raditya Dika'
        ],
        [
            'id' => 5,
            'nama' => 'Dee Lestari'  
        ],
    ];

    public function getAuthor(){
        return $this->authors;
    }
}
