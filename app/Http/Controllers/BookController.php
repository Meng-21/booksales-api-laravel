<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index(){
        
        $books =Book::all();

        if ($books->isEmpty()){
            return response()->json([
                "succes" => true,
                "massage"=> "Resource data not found"
            ],200);
        }

        return response()->json([
            "succes" => true,
            "massage" => "Get all resources",
            "data" => $books
        ],200);
    }

    public function store(Request $request){
        //1.membuat validator untuk memvalidasi semua nya 
       $validator = Validator::make($request ->all(),[
            'title'=> 'required|string|max:100',
            'description'=> 'required|string',
            'price'=>'required|numeric',
            'stock'=> 'required|integer',
            'cover_photo'=> 'required|image|mimes:jpeg,jpg,png|max:2048',
            'genre_id'=> 'required|exists:genres,id',
            'author_id'=> 'required|exists:authors,id'
        ]);

        //2. mencek semua validator erorr
        if( $validator -> fails()) {
            return response()->json([
                'success'=> false,
                'massage'=> $validator->errors()
            ],422);
        }


        //3. Upload Data
        $image = $request->file('cover_photo');
        $image->store('books','public');


        //4. meng insert data 
        $book = Book::create([
            'title'=> $request->title,
            'description'=> $request->description,
            'price'=> $request->price,
            'stock'=> $request->stock,
            'cover_photo'=> $image->hashName(),
            'genre_id'=> $request -> genre_id,
            'author_id'=> $request->author_id,

        ]);

        //5. menampilkan response 
        return response()->json([
            'success'=>true,
            'message' => 'Resource added successflly!',
            'data'=> $book
        ],201);
    }

    public function show (string $id){
        $book = Book::find($id);

        if (!$book){
            return response()->json([
                'success'=>false,
                'massage'=> 'Resorce not found'
            ],404);
        }

        return response()->json([
            'success'=>true,
            'message'=>'Get detail resource',
            'data'=> $book
        ],200);
    }

    public function update(string $id, Request $request){
        //1. menacari data 
        $book = Book::find($id);

        if (!$book){
            return response()->json([
                'success'=>false,
                'massage'=> 'Resorce not found'
            ],404);
        }


        //2. melakukan validator 
        $validator = Validator::make($request ->all(),[
            'title'=> 'required|string|max:100',
            'description'=> 'required|string',
            'price'=>'required|numeric',
            'stock'=> 'required|integer',
            'cover_photo'=> 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'genre_id'=> 'required|exists:genres,id',
            'author_id'=> 'required|exists:authors,id'
        ]);

        if ($validator ->fails()){
            return response()->json([
                'success'=> false,
                'massage'=> $validator->errors()
            ],422);
        }

        //3. menyiapkan data yang di update 
        $data =[
            'title'=> $request->title,
            'description'=> $request->description,
            'price'=> $request->price,
            'stock'=> $request->stock,
            'genre_id'=> $request -> genre_id,
            'author_id'=> $request->author_id,
        ];

        // 4. handle image 
        if ($request->hasFile('cover_photo')){
            $image = $request->file('cover_photo');
             $image->store('books','public');

             if($book->cover_photo){
                Storage::disk('public')->delete('books/' . $book->cover_photo);
             }

             $data['cover_photo'] = $image ->hashName();
        }

        //update data baru ke database 
        $book ->update($data);

        return response()->json([
            'success'=>true,
            'message' => 'Resource update successflly!',
            'data'=> $book
        ],200);    
 }

    public function destroy(string $id){
        $book = Book::find($id);

        if (!$book){
            return response()->json([
                'success'=>false,
                'massage'=> 'Resorce not found'
            ],404);
        }


        if ($book ->cover_photo){
            //delete from storage
            Storage::disk('public')->delete ('books/' . $book->cover_photo);
        }
        $book->delete();

        return response()->json([
            'success'=>true,
            'message'=>'Delete Resource Succesfully'
        ],200);
    }
}
