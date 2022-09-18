<?php

namespace App\Providers;
use App\Models\review;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class reviewServiceProvider extends ServiceProvider
{
//*************************Start For All Ecom ************************ */

    public static function getTopRatedReview(){
        $toprated = review::where('star', '>=', 4)
        ->select('product_id')
        ->orderBy('star', 'DESC')
        ->limit(4)->get();
         return $toprated;
       }

        //*************************End For  All Ecom ************************ */



    //    ===================================================================================
    //    ================================For API Islamic=======================================
       public static function getApiTopRatedForIslamic(){
        $top_rated = DB::table('reviews')
        ->select('products.*', 'brands.brand_name_cats_eye','products.product_thambnail','products.product_name','products.product_slug_name','products.selling_price')
        ->join('products', 'product_id', 'products.id')
        ->join('brands', 'products.brand_id', 'brands.id')->where('products.ecom_name','1')->distinct('product_id')->where('star', '>', 3)->limit(4)
        ->get();
         return $top_rated;
       }
       public static function getApiTop_ratedForIslamic(){
        $toprated = review::where('star', '>=', 4)
        ->select('product_id')
        ->orderBy('star', 'DESC')
        ->limit(4)->get();
         return $toprated;
       }
       public static function getApiPrevious_ReviewsForIslamic($a){
        $validator = Validator::make($a->all(),[
            'product_id' => 'required',
            ]);
           if ($validator->fails()) {
            return response([
                'errors' => $validator->messages()
            ]);
        }else{
              $review = new Review();
            $review->product_id = $a->product_id;
            // dd($review->product_id);
            // dd($review->product_id);
            $previous_reviews = DB::table('reviews')
                                ->where('product_id',$review->product_id)
                                 ->join('users', 'users.id', '=', 'users.id')
                                //  ->join('reviews.users.id','=','reviews.user_id')
                                ->select('user_name','profile_photo_path','review','quality','price','value')
                                ->get();
                                return $previous_reviews;

       }
    }
    public static function getApiPost_ReviewsForIslamic($a,$b){
        if(!Auth::check()) {
            return redirect()->route('login');
        } else {
            $validated = $a->validate([
                'review' => 'required|max:255'
            ]);


            if ($validated) {
                $review = new review();
                $review->review = $a->review;
                $review->product_id = $b;
                $review->user_id = Auth::id();
                $review->quality = $a->quality;
                $review->price = $a->price;
                $review->value = $a->value;
                $review->save();
                $notification = array(
                    'message' =>  'Thank you for your rating.',
                    'alert-type' => 'success'
                );
                return $notification;
            }
        }
    }
 //    ===================================================================================
    //    ================================For API Grocery=======================================

    public static function getApiTopRatedForGrocery(){
        $top_rated = DB::table('reviews')
        ->select('products.*', 'brands.brand_name_cats_eye')
        ->join('products', 'product_id', 'products.id')
        ->join('brands', 'products.brand_id', 'brands.id')
        ->distinct('product_id')
        ->where('star', '>', 3)
        ->get();
         return $top_rated;
       }
       public static function getApiOnlyReviewForGrocery($id){
        $review = Review::where('product_id', $id)
                    ->get()
                    ->first();
         return $review;
       }
       public static function getApiUserReviewForGrocery($id){
        $users = Review::where('product_id', $id)
                 ->count();
         return $users;
       }
       public static function getApiUserReviewsForGrocery($id){
        $reviews=review::where('product_id', $id)
        ->with('user')
        ->orderBy('id', 'DESC')
        ->get();
         return $reviews;
       }






    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
