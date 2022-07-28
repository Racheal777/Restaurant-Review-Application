<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReviewResource;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {

        //check if user is logged in, then save the review
        //$loggedinUser = auth('api')->user();

       

        // $users = Auth::check();
        // $user = Auth::user();

        //$userz = auth('api')->user();

        // if($userz){
        //  return "user is authenticated";   
        // }else{
        //     return "user not authenticated";
        // }

        //return $users;

       // if($loggedinUser){
//look for the authenticated user and grab thier id to insert at the user id column
//if
            $user = Auth::user();
            $review = new Review();
            $review->comment = $request->input('comment');
            $review->ratings = $request->input('ratings');
            $review->restaurant_id = $request->input('restaurant_id');
            $review->user_id = $user->id;

            $review->save();

            return new ReviewResource($review);
    
        // }else{
        //     return response()->json([
        //         'message' => "You must be logged in to review"
        //     ]);
        // }
       

        
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
    public function destroy($id)
    {
        //
    }
}
