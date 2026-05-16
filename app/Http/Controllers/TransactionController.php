<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index(){
        $transaction = Transaction::with('user', 'book')->get();

        if ($transaction->isEmpty()){
            return response()->json([
                "succes" => true,
                "massage"=> "Resource data not found"
            ],200);
        }

        return response()->json([
            "succes" => true,
            "massage" => "Get all resources",
            "data" => $transaction
        ],200);
    }


    //create
public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'book_id' => 'required|exists:books,id',
        'quantity' => 'required|integer|min:1'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validation error',
            'data' => $validator->errors()
        ], 422);
    }

    $user = auth('api')->user();

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized'
        ], 401);
    }

    $book = Book::find($request->book_id);

    // cek stock
    if ($book->stock < $request->quantity) {
        return response()->json([
            'success' => false,
            'message' => 'Stock tidak cukup'
        ], 400);
    }

    // generate order
    $uniqueCode = 'ORD-' . strtoupper(uniqid());

    // hitung total
    $totalAmount = $book->price * $request->quantity;

    // KURANGI STOCK (HANYA SEKALI)
    $book->stock -= $request->quantity;
    $book->save();

    // simpan transaksi
    $transaction = Transaction::create([
        'order_number' => $uniqueCode,
        'customer_id' => $user->id,
        'quantity' => $request->quantity,
        'book_id' => $request->book_id,
        'total_amount' => $totalAmount
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Transaction created successfully',
        'data' => $transaction
    ], 201);
}


    //show
    public function show($id){
        $user =auth('api')->user();

        if(!$user){
            return response()->json([
                'success'=> false,
                'mesaage'=> 'Unauthorized'
            ],401);
        }
        $transaction = Transaction::with('user','book')
        ->where('id',$id)
        ->where('customer_id',$user->id)
        ->first();

        if(!$transaction){
        return response()->json([
                'success'=> false,
                'message'=> 'Data tidak ditemukan'
            ],404);
         }

        return response()->json([
                'success'=> true,
                'message'=> 'Detail transaksi',
                'data'=> $transaction
            ],200);
    }


    //update

    public function update(Request $request, $id){
        $user = auth('api')->user();

        if(!$user){
            return response()->json([
                'success'=> false,
                'message'=> 'Unauthorized'
            ],401);
        }

        $transaction = Transaction::where('id',$id)
            ->where('customer_id',$user->id)
            ->first();

        if(!$transaction){
            return response()->json([
                'success'=> false,
                'message'=> 'Data tidak ditemukan'
            ],404);
        }

        $validator = Validator::make($request->all(),[
            'quantity'=> 'required|integer|min:1'
        ]);

        if($validator->fails()){
            return response()->json([
                'success'=> false,
                'message'=> 'Validation error',
                'data'=> $validator->errors()
            ],422);
        }

        $book = Book::find($transaction->book_id);

        // balikin stok lama
        $book->stock += $transaction->quantity;

        // cek stok baru
        if($book->stock < $request->quantity){
            return response()->json([
                'success'=> false,
                'message'=> 'stock tidak cukup'
            ],400);
        }

        // kurangi stok lagi
        $book->stock -= $request->quantity;
        $book->save();

        $transaction->quantity = $request->quantity;
        $transaction->total_amount = $book->price * $request->quantity;
        $transaction->save();

        return response()->json([
            'success'=> true,
            'message'=> 'Transaksi berhasil diupdate',
            'data'=> $transaction
        ],200);
    }


    //destroy
    public function destroy($id){
        $user = auth('api')->user();

        if(!$user || $user->role !== 'admin'){
            return response()->json([
                'success'=> false,
                'message'=> 'Hanya admin yang bisa menghapus'
            ],403);
        }

        $transaction = Transaction::find($id);

        if(!$transaction){
            return response()->json([
                'success'=> false,
                'message'=> 'Data tidak ditemukan'
            ],404);
        }

        // balikin stok
        $book = Book::find($transaction->book_id);
        $book->stock += $transaction->quantity;
        $book->save();

        $transaction->delete();

        return response()->json([
            'success'=> true,
            'message'=> 'Transaksi berhasil dihapus'
        ],200);
    }

    // history transaksi user login
    public function history()
    {
        $user = auth('api')->user();

        if(!$user){
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ],401);
        }

        $transaction = Transaction::with('book')
            ->where('customer_id', $user->id)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Get history transaction',
            'data' => $transaction
        ],200);
    }

}
