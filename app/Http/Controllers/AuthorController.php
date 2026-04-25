<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Container\Attributes\Auth;
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

        public function show(string $id){
            $author =Author::find($id);

            if (! $author){
            return response()->json([
                'success'=> false,
                'message'=> 'Resource not found'
            ],404);
        }

            return response()->json([
                'success'=> true,
                'message'=> 'Get detail resource',
                'data'=> $author
            ],200);

        }


         public function update(string $id, Request $request){
            //1. mencari data 
            $author = Author::find($id);

            if (!$author){
                return response()->json([
                    'success'=>false,
                    'massage'=> 'Resorce not found'
                ],404);
            }

            //2.melakukan validator 
            $validator = Validator::make($request-> all(),[
                'name'=> 'required|string|max:100',
                'email'=> 'required|email|unique:authors,email'
            ]);

            if ($validator ->fails()){
                return response()->json([
                    'success'=> false,
                    'message'=> $validator->errors()
                ],422);
            }

            //3. menyiapkan data yang akan di update 
            $data=[
                'name' =>$request->name,
                'email'=> $request-> email,
            ];

            //update data baru ke database 
            $author ->update($data);

            return response()->json([
                'success'=>true,
                'message' => 'Resource update successflly!',
                'data'=> $author
            ],200); 

        }


        public function destroy (string $id){
            $author = Author::find($id);

            if (!$author){
                return response()->json([
                    'success'=> true,
                    'message'=> 'Delete Resource Successfully'
                ],200);
            }

            if (!$author){
                return response()->json([
                    'success'=>false,
                    'massage'=> 'Resource not found'
                ],404);
            }

            $author->delete();
        }
    }
