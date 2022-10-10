<?php

namespace App\Http\Controllers;

use App\Http\Resources\FavoriteCollection;
use App\Http\Resources\FavoriteResource;
use App\Models\Favorite;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $user = Auth::user();

        // return $user->favorites;
        $favorite = Favorite::all();

        return new FavoriteCollection($favorite);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Restaurant $restaurant)
    {
        //add a favorite
        $favorite = new Favorite();

        //authenticate a user
         $user = Auth::user();

//if a user has already added the restaurant throw an error else add it
//pluck to get the particular column in the table and change it into an array
//check the resturants id and see if it matches
        $userFavorites =  $user->favorites()->pluck('restaurant_id')->toArray();
       // return $userFavorites;

       //if you pluck the id into an array, check if the one being added has an id
       //that matches the one in the array
       //compare the incoming id with the original array 
        if (in_array($request->restaurant_id, $userFavorites)) {
            return response()->json([
                'message' => "restaurant has already been added"
            ]);
        }

        //if it doesnt exist, add it
        $favorite->user_id = $user->id;
        $favorite->restaurant_id = $request->input('restaurant_id');

        $favorite->save();

        return new FavoriteResource($favorite);

       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //find all favorite base on the user id
        //$favorite = Favorite::

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Favorite $favorite)
    {
        //
       // $favorite = Favorite::find($id);

        $favorite->delete();
    }
}
