<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserCollection;
use Illuminate\Auth\Events\Registered;
use App\Http\Resources\FavoriteResource;
use App\Http\Resources\RestaurantResource;
use App\Http\Resources\UserFavoriteCollection;

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

       // event(new Registered($user));
        //event(new Registered($user));

        //create a token for the user
        $token = $user->createToken($user->name);
        $object = $token->accessToken;
       
        return response()->json([
            'user' => new UserResource($user),
            'Access Token' => $object,
           
        ]);
    }


    //login function

    public function login(Request $request, User $user){
        $loginDetails = [
            'email' => $request->email,
            'password' => $request->password
        ];

        //if user attempt to login, and their details matches with what is in the db
        //check if a user is verified
        //create a token for them
        if(auth()->attempt($loginDetails, $request->get('remember'))){

           
        
                //find the authenticated user
                $user = auth()->user();
                $token = $user->createToken($user->username);
    
                return response()->json([
                    'user' => new UserResource($user),
                    'access token' => $token->accessToken,
                    'remember-me' => $request->get('remember')
                    //'csrf' => $csrftoken
                ]);
            
           
        }else{
            return response()->json([
                'message' => 'Incorrect Credentials',
           ]);
        }
    }


    //fetch a particular user will all their favorites
    public function getUserwithFavorites(User $user)
    {

        $user = Auth::user();
        
        
        $userFavorites = $user->favorites;

        return new UserFavoriteCollection($userFavorites) ;
    }


    //fetch a particular user will all their reviews
    public function getUserwithReviews(User $user){

        $user = Auth::user();

       // \Log::debug($user);
        return new UserResource($user);
      
   
        
    }


    public function logout(Request $request){

       // logout functionality
       // find the authenticated user
       $user = Auth::user();

       //get the token and save it in a variable
       $token = $user->token();

       //return $token;
//if you find the user, revoke the token
       if($user){
        $token->revoke();
        return response()->json([
            "message" =>  "Successfully logged out ",
            'token' => $token
        ]);

       }else{
        return "user not found";
       }

              
 
    

    }



}
