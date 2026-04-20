<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(){
        $data = new Author();
        $Authors = $data->getAuthor();

        return view('authors',['authors' => $Authors]);
    }
}
