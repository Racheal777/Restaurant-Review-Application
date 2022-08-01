<?php

namespace App\Observers;

use App\Http\Resources\RestaurantResource;
use App\Models\Restaurant;
use App\Models\Review;

class ReviewObserver
{
    /**
     * Handle the Review "created" event.
     *
     * @param  \App\Models\Review  $review
     * @return void
     */
    public function created(Review $review)
    {
       // find the restaurant
       $restaurant = Restaurant::find($review->restaurant_id);
        //$restaurant =$review->restaurant_id ;

        //find the reviewed restaurant
       // return ;

       // return $review;
        //get the reviews of that restaurant and pluck the ratings and change to an array
        $restaurantRatings = $restaurant->reviews()->pluck('ratings')->toArray();

       // return $restaurantRatings;
        //calculate the sum of the ratings
        $total = array_sum($restaurantRatings);

        //divide the sum by the number of items to fund the average
        $average = $total/count($restaurantRatings);

        //round the total to the neerest decimal
        $roundedNum = round($average, 1);

        //return $roundedNum;

        //$restaurant->averageRatings = $roundedNum;

        //save the roundedNum to the average rating
        $restaurant->average_ratings = $roundedNum;
        $restaurant->save();

       // return new RestaurantResource($restaurant);


    }

    /**
     * Handle the Review "updated" event.
     *
     * @param  \App\Models\Review  $review
     * @return void
     */
    public function updated(Restaurant $restaurant)
    {
        //
         // find the restaurant
        //$restaurant = Restaurant::find($id);

        //find the reviewed restaurant
       
       
        //get the reviews of that restaurant and pluck the ratings and change to an array
    //     $restaurantRatings = $restaurant->reviews()->pluck('ratings')->toArray();

    //    // return $restaurantRatings;
    //     //calculate the sum of the ratings
    //     $total = array_sum($restaurantRatings);

    //     //divide the sum by the number of items to fund the average
    //     $average = $total/count($restaurantRatings);

    //     //round the total to the neerest decimal
    //     $roundedNum = round($average, 1);

    //     //return $roundedNum;

    //     $restaurant->averageRatings = $roundedNum;

    //     //save the roundedNum to the average rating
    //    $restaurant->average_ratings = $roundedNum;
    //    // $restaurant->save();

       // return new RestaurantResource($restaurant);

    }

    /**
     * Handle the Review "deleted" event.
     *
     * @param  \App\Models\Review  $review
     * @return void
     */
    public function deleted(Review $review)
    {
        //
    }

    /**
     * Handle the Review "restored" event.
     *
     * @param  \App\Models\Review  $review
     * @return void
     */
    public function restored(Review $review)
    {
        //
    }

    /**
     * Handle the Review "force deleted" event.
     *
     * @param  \App\Models\Review  $review
     * @return void
     */
    public function forceDeleted(Review $review)
    {
        //
    }
}
