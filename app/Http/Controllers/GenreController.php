<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index(){
        $data= new Genre();
        $Genres = $data->getGenre();

        return view('genres',['genres' => $Genres]);
    }
}
