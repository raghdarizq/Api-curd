<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UsersController extends Controller
{
    //
    function index(Request $request)
    {
        $user= User::where('email', $request->email)->first();
        // print_r($data);
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }

          // $user->tokens()->delete();
             $token = $user->createToken('my-app-token')->plainTextToken;

            $response = [
                'user' => $user,
                'token' => $token
            ];

             return response($response, 201);
    }
    function register (Request $req){
        $fields = $req->validate([
            "name" =>"required|string",
            "email" => "required|string|email|unique:users",
            "password" =>"required|string|confirmed",
        ]);
        $user =User::create([
        "name" => $fields["name"],
        "email" => $fields["email"],
        "password" => $fields["password"],

        ]);

    $token = $user->createToken('my-app-token')->plainTextToken;
    
    $response =[
        "status" => true,
        "message" => "Registered successfully",
        "data" => [
            "user" =>$user,
            "token"=>$token
        ]
     ];
     return $response;
   }
   function logout(){
       auth()->user()->tokens()->delete();
       
   }
}