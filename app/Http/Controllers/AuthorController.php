<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    public function index(){
        $authors=Author::all();

        if ($authors->isEmpty()){
            return response()->json([
               "succes" => true,
                "massage"=> "Resource data not found" 
            ],200);
        }
        
        return response()->json([
            "succes" => true,
            "massage" => "Get all resources",
            "data" => $authors
        ],200);
    }

        public function store(Request $request){
            // 1membuat validator untuk memvalidari 
            $validator = Validator::make($request->all(),[
                'name'=> 'required|string|max:100',
                'email'=> 'required|email|unique:authors,email'
            ]);

            //2. mencek semua validator erornya
            if ($validator->fails()){
                return response()->json([
                    'success'=> false,
                    'message'=> $validator->errors()
                ],422);
            }

            //menginsert data 
            $author = Author::create([
                'name' =>$request->name,
                'email'=> $request-> email,
            ]);


             //5 menampilkan response 
            return response()->json([
                'success'=> true,
                'message'=> 'Resource added successfully!',
                'data'=> $author
            ],201);
        }
    }
