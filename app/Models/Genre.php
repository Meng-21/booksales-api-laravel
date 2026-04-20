<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    private $genres =[
        [
            'id' => 1,
            'nama' => 'Fiksi',
        ],
        [
            'id' => 2,
            'nama' => 'Non-Fiksi', 
        ],
        [
            'id' => 3,
            'nama' => 'Fantasi', 
        ],
        [
            'id' => 4,
            'nama' => 'Horor', 
        ],
        [
            'id' => 5,
            'nama' => 'Romantis', 
        ],
    ];

    public function getGenre(){
        return $this->genres;
    }
}
