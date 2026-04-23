<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(){
        
        $books =Book::all();

        return response()->json([
            "succes" => true,
            "massage" => "Get all resources",
            "data" => $books
        ],200);
    }
}
