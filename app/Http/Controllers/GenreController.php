<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    public function index(){
        $genres = Genre::all();

        if ($genres->isEmpty()){
            return response()->json([
                "succes" => true,
                "massage"=> "Resource data not found"
            ],200);
        }

        return response()->json([
            "success" => true,
            "message" => "Get all resources",
            "data" => $genres
        ],200);
    }


    public function store(Request $request){
        //1. membuat validator untuk memvalidasi semuanya 
        $validator = Validator::make($request-> all(),[
            'name' => 'required|string|max:100',
            'description' => 'required|string'
        ]);

        //2. mencek semua validator erorr
        if ($validator ->fails()){
            return response()->json([
                'success'=> false,
                'message'=> $validator->errors()
            ],422);
        }

        //menginsert data 
        $genre = Genre::create([
            'name'=> $request->name,
            'description'=> $request-> description,
        ]);

        //5 menampilkan response 
        return response()->json([
            'success'=> true,
            'message'=> 'Resource added successfully!',
            'data'=> $genre
        ],201);
    }

    public function show (string $id){
        $genre = Genre::find($id);

        if (! $genre){
            return response()->json([
                'success'=> false,
                'message'=> 'Resource not found'
            ],404);
        }

        return response()->json([
            'success'=> true,
            'massage'=> 'Get Deatil Resource ',
            'data'=> $genre
        ],200);
    }

    public function update(string $id, Request $request){
        //1. mencari data 
        $genre = Genre::find($id);

        if (!$genre){
            return response()->json([
                'success'=>false,
                'massage'=> 'Resorce not found'
            ],404);
        }

        //2.melakukan validator 
        $validator = Validator::make($request-> all(),[
            'name' => 'required|string|max:100',
            'description' => 'required|string'
        ]);

        if ($validator ->fails()){
            return response()->json([
                'success'=> false,
                'message'=> $validator->errors()
            ],422);
        }

        //3. menyiapkan data yang akan di update 
        $data=[
            'name'=> $request->name,
            'description'=> $request-> description,
        ];

        //update data baru ke database 
        $genre ->update($data);

        return response()->json([
            'success'=>true,
            'message' => 'Resource update successflly!',
            'data'=> $genre
        ],200); 

    }

    public function destroy (string $id){
        $genre =Genre::find($id);

        if(!$genre){
            return response()->json([
                'success'=> true,
                'message'=>'Delete Resource Successfully'
            ],200);
        }

        if (!$genre){
                return response()->json([
                    'success'=>false,
                    'massage'=> 'Resource not found'
                ],404);
            }

            $genre->delete();
    }
}
