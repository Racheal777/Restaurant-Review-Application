<?php

namespace App\Observers;

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
    public function created(Review $review, Restaurant $restaurant, $id)
    {
        //
        $restaurant = Restaurant::find($id);

        $restaurantRatings = $restaurant->reviews()->pluck('ratings')->toArray();

        $total = array_sum($restaurantRatings);

        $average = $total/count($restaurantRatings);

        $roundedNum = round($average, 1);

        //return $roundedNum;

        $restaurant->averageRatings = $roundedNum;

        $restaurant->average_ratings = $roundedNum;
        $restaurant->save();

        return $restaurant;


    }

    /**
     * Handle the Review "updated" event.
     *
     * @param  \App\Models\Review  $review
     * @return void
     */
    public function updated(Review $review)
    {
        //
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
