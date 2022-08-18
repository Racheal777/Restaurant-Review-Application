<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Restaurant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\App;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\RestaurantResource;
use App\Http\Resources\RestaurantCollection;

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
        $diner = new Restaurant();
        //
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = Str::random(25) . '.' . $file->getClientOriginalExtension();
            $folder = 'public/uploads/profile/avatars';
            // if (App::environment(['staging', 'production', 'development'])) {
            //     $folder = 'uploads/profileimages';
            // }
            $url = $this->uploadSingle($file, $folder, $fileName);
            $diner->profileimage = $url;
            
        }

        if ($request->hasFile('images')) {
            $images = $request->file('images');

            foreach($images as $image){
            $fileName = Str::random(25) . '.' . $image->getClientOriginalExtension();
            $folder = 'public/uploads/images';
            if (App::environment(['staging', 'production'])) {
                $folder = 'uploads/images';
            }
            $urls = $this->uploadMutiple($image, $folder, $fileName);
            }
           
            $diner->images = explode(' ', $urls);
            
        }


        
        

       // dd($diner->image);

        $diner->name = $request->input('name');
        $diner->about = $request->input('about');
        $diner->location = $request->input('location');
        $diner->contact = $request->input('contact');
        $diner->website_url = $request->input('website_url');
        $diner->category = $request->input('category');
        $diner->working_hours = $request->input('working_hours');
        //$diner->profileimage = $url;
        // $diner->profileimage = Storage::url($this->UploadImage($request));
        //$diner->images = explode(' ', $this->multipleUploads($request)) ;

        $diner->save();

        return new RestaurantResource($diner->fresh());

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant, $id)
    {
        //find one restaurant with their reviews
        $restaurant= Restaurant::find($id);

        return new RestaurantResource($restaurant);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant, $id)
    {
        //update a restaurant
       // $diner = 
       $restaurant = Restaurant::find($id);
        $restaurant->name = $request->input('name');
        $restaurant->about = $request->input('about');
        $restaurant->location = $request->input('location');
        $restaurant->contact = $request->input('contact');
        $restaurant->website_url = $request->input('website_url');
        $restaurant->category = $request->input('category');
        $restaurant->working_hours = $request->input('working_hours');
        // $restaurant->profileimage = Storage::url($this->UploadImage($request));
        // $restaurant->images = explode(' ', $this->multipleUploads($request)) ;

        $restaurant->save();

        return new RestaurantResource($restaurant);

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

    public function averageRatings(Restaurant $restaurant, Review $review, $id){

      

        $restaurant = Restaurant::find($id);

        $restaurantRatings = $restaurant->reviews()->pluck('ratings')->toArray();

        $total = array_sum($restaurantRatings);

        $average = $total/count($restaurantRatings);

        $roundedNum = round($average, 1);

       // return $roundedNum;

        $restaurant->average_ratings = $roundedNum;

        $restaurant->save();


        //return $restaurantRatings;

        return new RestaurantResource($restaurant);

    }


    public function searching(Request $request){
        //get the request the user is passing

        $search = $request->input('search');

        //if you get the request, search in the model 

        $restaurant = Restaurant::
                                        where('name', 'ilike', "%" . $search . "%" )
                                        ->orwhere('location', 'ilike', "%" . $search . "%")
                                        ->get();
        if($restaurant->count() > 0){
            return $restaurant;
        }else{
            return response()->json([
                "message" => "No results found"
            ]);
        }

        
    }
}
