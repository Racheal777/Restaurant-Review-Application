<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    //register function
    public function register(Request $request){

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->username = $request->input('username');
        $user->password = Hash::make( $request->input('password'));
        
       

        //save the user;
        $user->save();

        //create a token for the user
        $token = $user->createToken($user->name);
        $object = $token->accessToken;

        return response()->json([
            'user' => new UserResource($user),
            'Access Token' => $object
        ]);
    }


    //login function

    public function login(Request $request){
        $loginDetails = [
            'email' => $request->email,
            'password' => $request->password
        ];

        //if user attempt to login, and their details matches with what is in the db
        //create a token for them
        if(auth()->attempt($loginDetails)){
            $user = auth()->user();
            $token = auth()->user()->createToken($user->username);

            return response()->json([
                'user' => new UserResource($user),
                'access token' => $token->accessToken
            ]);
        }else{
            return response()->json([
                'message' => 'Incorrect Credentials',
           ]);
        }
    }



    //fetch a particular user will all their reviews
    public function getUserwithReviews(User $user){
       // $user = User::all();
       // $user = auth()->user();
       $loggedinUser = auth('api')->user();

       //return $loggedinUser;

       if($loggedinUser){
        //$user = User::find($loggedinUser->id);
        return new UserResource($loggedinUser);
       }

        
    }
}