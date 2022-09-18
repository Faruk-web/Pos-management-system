<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Banner;
use App\Models\Ecommerce_Name;
use Image;
use App\Models\ShopBanner;
use App\Models\SubCategorypBanner;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    // Banner view
    public function BennarView(){
        $ecom=Ecommerce_Name::get();
        $bennars =Banner::with('ecommerce')->get();
        return view('backend.banner.banner_view',compact('bennars','ecom'));

    } // end mathod


   // Banner Store
    public function BennarStore(Request $request){

   $request->validate([
    // 'title' => 'required',
    // 'description' => 'required',
    'bennar_img' => 'required',

   ],[

    'bennar_img.required' => 'Input The Banner Img',
   ]);

   // Banner Img upload and save
   $image = $request->file('bennar_img');
   $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
   Image::make($image)->resize(944,110)->save('upload/banner/'.$name_gen );
   $save_url = 'upload/banner/'.$name_gen;

   Banner::insert([
            'ecom_id' => $request->ecom_id,
            'title' => $request->title,
            'description' => $request->description,

            'bennar_img' => $save_url,
        ]);


        $notification = array(
            'message' =>'Banner Create successfully',
            'alert-type' =>'success'
        );

        return redirect()->back();

          } // end mathod



    // Banner Edit
        public function BennarEdit($admin,$id){
            $ecom=Ecommerce_Name::get();
            $bennars = Banner::with('ecommerce')->findOrFail($id);
            return view('backend.banner.banner_edit', compact('bennars','ecom'));
        } // end mathod

        // Banner Update
        public function BennarUpdate( Request $request){


        $bennar_id = $request->id;
        $old_img = $request->old_img;

        if ( $request->file('bennar_img')) {
            // unlink($old_img);
        $image = $request->file('bennar_img');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(785,225)->save('upload/banner/'.$name_gen );
        $save_url = 'upload/banner/'.$name_gen;

        Banner::findOrFail($bennar_id)->update([
            'ecom_id' => $request->ecom_id,
            'title' => $request->title,
            'description' => $request->description,
            'bennar_img' => $save_url,

        ]);

        $notification = array(
            'message' =>'Banner update successfully',
            'alert-type' =>'success'
        );

        return redirect()->route('role.bennar.manage',config('fortify.guard'))->with($notification);

            }else{
                Banner::findOrFail($bennar_id)->update([
                'ecom_id' => $request->ecom_id,
                'title' => $request->title,
                'description' => $request->description,

            ]);
                $notification = array(
                'message' =>'Bennar update successfully',
                'alert-type' =>'info'
            );
            return redirect()->route('role.bennar.manage',config('fortify.guard'))->with($notification);

            }
         }  // end mathod


    // Banner Delete
        public function BennarDelete($admin,$id){
        $bennar = Banner::findOrFail($id);
        // $img = $bennar->bennar_img;
        // unlink($img);
        Banner::findOrFail($id)->delete();

        $notification = array(
        'message' =>'Banner Delete sucessfully',
        'alert-type' =>'info'
        );
        return redirect()->back()->with($notification);
        } // end method

     // Banner DeActive
     public function BennarDeactive($guard,$id){
        Banner::findOrFail($id)->update([ 'status' => 0, ]);

        // pass the sms
        $notification = array(
            'message' => 'Banner Deactive Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    } // end mathod

       // Active
       public function BennarActive($guard,$id){
        Banner::findOrFail($id)->update([ 'status' => 1, ]);

        // pass the sms
        $notification = array(
            'message' => 'Banner Active Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }// end mathod

// /////////////////////////////////////Sub Category & Shop Now Banner//////////////////////////////////////
public function BannerAllView()
{
    $ecom=Ecommerce_Name::latest()->get();
    $shopNowbanner=ShopBanner::latest()->get();
    $SubCategorybanner=SubCategorypBanner::latest()->get();
    return
    view('backend.bannerCatagory.shop_now_sub_category_banner',compact('shopNowbanner','SubCategorybanner','ecom'));
}
// ==================================Sub Category Banner Store==================================================
public function SubCatBannerStore(Request $request)
{

     $validator = Validator::make($request->all(), [
    //  'ecom_id' => 'required',

     ],[
    //  'ecom_id.required'=>'Ecommerce name required',
     ]);

     if ($validator->fails()) {
     return response()->json([
     'status' => 400,
     'errors' => $validator->messages()
     ]);
     }

     // if ($validator->fails()) {
     // return response()->json(['errors' => $validator->errors()], 422);
     // }
     else {
     $save_url = null;
     if ($request->hasFile('subcat_banner_image') && $request->subcat_banner_image->isValid()) {
     // banner_image upload and save
     $image = $request->file('subcat_banner_image');
     $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
     Image::make($image)->resize(800, 180)->save('upload/banner/subcat_banner' . $name_gen);
     $save_url = 'upload/banner/subcat_banner' . $name_gen;
     }
     $subcatbanner = new SubCategorypBanner;
     $subcatbanner->ecom_id = $request->input('ecom_id');
     $subcatbanner->subcat_banner_image = $save_url;
     $subcatbanner->save();
     return response()->json([
     'message' => 'Sub Category Banner Image Added Successfully'
     ]);
     }

    //   return redirect()->back()->with($notification);
}
// shop now add
// =============================SUb CAtegory Banner Edit=====================================
// Edit Method
public function SubCatBannerEdit($role, $id)
{

$subcatbanner = SubCategorypBanner::with('ecommerce')->find($id);
// dd($subcatbanner );
return response()->json([
'status' => 200,
'subcatbanner' => $subcatbanner,

]);
} // end edit
    //update
    public function SubCatBannerUpdate(Request $request, $role, $id)
    {
    $subcatupdate = SubCategorypBanner::find($id);

    // $validated = $request->validate([
    // 'brand_name_cats_eye' => 'required|unique:posts|max:255',
    // 'ecom_id' => 'required',
    // ],
    // [
    // 'ecom_id.required' => "Ecommerce name required",
    // 'brand_name_cats_eye.required' => "Brand name required",
    // ]);

    $save_url = $subcatupdate->subcat_banner_image;
    if ($request->hasFile('subcat_banner_image') && $request->subcat_banner_image->isValid()) {

    $this->removePreviousImage($subcatupdate->subcat_banner_image);

    // brand_image update and save
    $image = $request->file('subcat_banner_image');
    $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
    Image::make($image)->resize(800, 180)->save('upload/banner/subcat_banner' . $name_gen);
    $save_url = 'upload/banner/subcat_banner' . $name_gen;
    }
    try {
    $subcatupdate->ecom_id = $request->input('ecom_id');
    $subcatupdate->subcat_banner_image = $save_url;
    $subcatupdate->update();
    return response()->json(['message' => 'Sub Category Banner Updated Successfully']);
    } catch (\Exception $e) {
    return response()->json(['error' => $e->getMessage()], 500);
    }

    } //end update
        // function for remove previous image
    private function removePreviousImage($image)
    {
    if (file_exists(public_path($image))) {
    unlink(public_path($image));
    return true;
    }
    return false;
    }
        // handle delete an category ajax request
        public function SubCatBannerDelete($role, $id)
        {
        $subcategorybanner = SubCategorypBanner::find($id);
        $img = $subcategorybanner->subcat_banner_image;
        if ($img) {
        unlink($img);
        }
        $subcategorybanner->delete();
        $notification = array(
        'message' => 'Sub Category Banner Deleted Successfully',
        'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
        }
// ==================================Shop Now Banner Store==================================================
public function ShopNowStore(Request $request)
{

$validator = Validator::make($request->all(), [
// 'ecom_id' => 'required',

],[
// 'ecom_id.required'=>'Ecommerce name required',
]);

if ($validator->fails()) {
return response()->json([
'status' => 400,
'errors' => $validator->messages()
]);
}

else {
$save_url = null;
if ($request->hasFile('shopbanner_image') && $request->shopbanner_image->isValid()) {
// banner_image upload and save
$image = $request->file('shopbanner_image');
$name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
Image::make($image)->resize(444, 545)->save('upload/banner/shopnow_banner' . $name_gen);
$save_url = 'upload/banner/shopnow_banner' . $name_gen;
}
$subcatbanner = new ShopBanner;
$subcatbanner->ecom_id = $request->input('ecom_id');
$subcatbanner->shopbanner_image = $save_url;
$subcatbanner->save();
return response()->json([
'message' => 'Shop Now Banner Image Added Successfully'
]);
}
}
// Edit Method
public function ShopNowEdit($role, $id)
{

$shopnowbanner = ShopBanner::with('ecommerce')->find($id);
// dd($subcatbanner );
return response()->json([
'status' => 200,
'shopnowbanner' => $shopnowbanner,

]);
} // end edit

 public function ShopNowUpdate(Request $request, $role, $id)
 {
    //  dd($request->all());
 $shopnowupdate = ShopBanner::find($id);

 // $validated = $request->validate([
 // 'brand_name_cats_eye' => 'required|unique:posts|max:255',
 // 'ecom_id' => 'required',
 // ],
 // [
 // 'ecom_id.required' => "Ecommerce name required",
 // 'brand_name_cats_eye.required' => "Brand name required",
 // ]);

 $save_url = $shopnowupdate->shopbanner_image;
 if ($request->hasFile('shopbanner_image') && $request->shopbanner_image->isValid()) {

 $this->removePreviousImage($shopnowupdate->shopbanner_image);

 // brand_image update and save
 $image = $request->file('shopbanner_image');
 $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
 Image::make($image)->resize(444, 545)->save('upload/banner/shopnow_banner' . $name_gen);
 $save_url = 'upload/banner/shopnow_banner' . $name_gen;
 }
 try {
 $shopnowupdate->ecom_id = $request->input('ecom_id');
 $shopnowupdate->shopbanner_image = $save_url;
 $shopnowupdate->update();
 return response()->json(['message' => 'Shop Now Banner Updated Successfully']);
 } catch (\Exception $e) {
 return response()->json(['error' => $e->getMessage()], 500);
 }

 } //end update
 // handle delete an category ajax request
 public function ShopNowDelete($role, $id)
 {
 $shopnowbanner = ShopBanner::find($id);
 $img = $shopnowbanner->shopbanner_image;
 if ($img) {
 unlink($img);
 }
 $shopnowbanner->delete();
 $notification = array(
 'message' => 'Shop Now Banner Deleted Successfully',
 'alert-type' => 'info'
 );
 return redirect()->back()->with($notification);
 }
} // main end

