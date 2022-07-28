<?php

namespace App\Http\Controllers;

use App\Http\Resources\RestaurantCollection;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\RestaurantResource;
use App\Http\Resources\UserResource;

class RestaurantController extends Controller

{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $diner = Restaurant::all();

        return new RestaurantCollection($diner);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return "helllo";
        //
        
        $diner = new Restaurant();

       // dd($diner->image);

        $diner->name = $request->input('name');
        $diner->about = $request->input('about');
        $diner->location = $request->input('location');
        $diner->profileimage = Storage::url($this->UploadImage($request));
        $diner->images = explode(' ', $this->multipleUploads($request)) ;

       

        $diner->save();

        return new RestaurantResource($diner);

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
    public function destroy(Restaurant $restaurant)
    {
        //delete all restaurant
        // $restaurant = Restaurant::find($id);

         $restaurant->delete();

         //return new UserResource($restaurant);
    }
}
