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
        // $user = Auth::user();

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

         $user = Auth::user();

//if a user has already added the restaurant throw an error else add it
//pluck to get the particular column in the table and change it into an array
        $userFavorites =  $user->favorites()->pluck('restaurant_id')->toArray();
       // return $userFavorites;

        if (in_array($request->restaurant_id, $userFavorites)) {
            return response()->json([
                'message' => "restaurant has already been added"
            ]);
        }

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
        //
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
