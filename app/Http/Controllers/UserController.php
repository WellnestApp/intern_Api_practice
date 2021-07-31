<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function registerUser(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),202);
        }

        $users = User::create(
            array_merge($validator->validated()
            ,[
                'password' => Hash::make($request->password)
            ]
        ),

        );

    $token = [];
    $token['token_passport'] = $users->createToken('api-application')->accessToken;

    return response()->json(
        [
        'isSuccess' => true,
        'User_created' => $users,
        'Token_created' => $token
        ],200
    );

    }


    public function login(Request $request){

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $resultArray = [];
            $resultArray['token'] = $user->createToken('token')->accessToken;
            return response()->json([
                "User"=>$user,
                "Token_created"=>$resultArray],200);
        }else{
            return response()->json(
                ["error"=>"Unaunthenticated"],402
            );
        }

    }

    public function logout(Request $request){

        $token = $request->user()->token();
         $token->revoke();
         return response()->json(
             [
                 'isLogout' => true,
                 'isMessage' => 'You have Successfully logout'
             ],200
         );

    }

}
