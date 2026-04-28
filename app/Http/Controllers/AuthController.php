<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request) {
        //1. setUp Validator
        $validator = Validator::make ($request->all(),[
            'name'=>'required|string|max:255',
            'email'=> 'required|email|max:255|unique:users',
            'password'=> 'required|min:8'
        ]);

        //2. Cek Validator 
        if ($validator->fails()){
            return response()->json($validator->errors(),422);
        }
        //3. Cretae User 
        $user =User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> bcrypt($request->password)
        ]);

        //4. Cek keberhasilan 
        if ($user){
            return response()->json([
                'success'=>true,
                'massage'=> 'User created successfully',
                'data'=> $user
            ],201);
        }
        //5. Cek kegagalan 
        return response()->json([
            'success'=>true,
            'massage'=> 'User created successfully',
        ],409);     //pesan 409 adalah pesan Conflict 
    }


    public function login(Request $request){
        //1. set Up validator
        $validator = Validator::make($request-> all(), [
            'email'=> 'required|email',
            'password'=> 'required'
        ]);
        //2. Cek Validator
        if($validator->fails()){
            return response()->json($validator->erors(),422);
        }
        //3. Get Kredensial dari req yang dikirim oleh postman 
        $credentials = $request->only('email','password');

        //4. Cek isFailed 
        if (!$token = auth()->guard('api')-> attempt($credentials)){
            return response()->json([
                'success' => false,
                'message'=> 'Email atau password anda salah'
            ],401);
        }
        
        //5. Cek IsSuccess

        return response()->json([
            'success'=>true,
            'message'=> 'Login Successfully',
            'user'=> auth()->guard('api')-> user(),
            'token'=>$token,
        ],200);
    }

    public function logout(Request $request){
        //try catch 
        //1. melakukan invalidate token 
        //cek is Success


        //catch 
        //1. Cek Is Faild 
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                'success'=>true,
                'message'=>'Logout  Successfully'
            ],200);
        } catch(JWTException $e){
            return response()->json([
                'success'=> false,
                'message'=> 'Logout Failed'
            ]);
        }
    }

}
