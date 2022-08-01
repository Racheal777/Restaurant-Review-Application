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
        $this->averageRatings($review);
      
    }

    /**
     * Handle the Review "updated" event.
     *
     * @param  \App\Models\Review  $review
     * @return void
     */
    public function updated(Review $review)
    {
       //once the review get updated, update the average ratings based on the ratings
       $this->averageRatings($review);
       
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
        $this->averageRatings($review);
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

    private function averageRatings(Review $review){

        // find the restaurant being reviewed
        $restaurant = Restaurant::find($review->restaurant_id);
        
        //get the reviews of that restaurant and pluck the ratings and change to an array
        $restaurantRatings = $restaurant->reviews()->pluck('ratings')->toArray();

       // return $restaurantRatings;
        //calculate the sum of the ratings
        $total = array_sum($restaurantRatings);

        //divide the sum by the number of items to fund the average
        $average = $total/count($restaurantRatings);

        //round the total to the neerest decimal
        $roundedNum = round($average, 1);

        //save the roundedNum to the average rating
        $restaurant->average_ratings = $roundedNum;
        $restaurant->save();

       // return new RestaurantResource($restaurant);

    }
}
