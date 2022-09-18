<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\SubSubCategory;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
class SubCategoryController extends Controller
{
    //  Sub categoary view
    public function SubCategoryView()
    {
        $categorys = Category::orderBy('category_name', 'ASC')->get();
        $subcategory = SubCategory::latest()->get();
        return view('backend.category.subcategory_all', compact('subcategory', 'categorys'));
    }  // end mathod
    // handle fetch all eamployees ajax request
    public function fetchAll()
    {
        $emps = SubCategory::all();
        $output = '';
        if ($emps->count() > 0) {
            $output .= '<table class="table table-striped table-sm text-center align-middle">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>category_id</th>
                        <th>sub_category_name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                        <td style="color: black;">' . $emp->id . '</td>
                        <td style="color:black;">' . $emp->category_id . '</td>
                        <td style="color: black;">' . $emp->sub_category_name . '</td>
                        <td>
                        <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editEmployeeModal"><i class="bi-pencil-square h4"></i></a>
                        <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
                        </td>
                    </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }
    // handle insert a new employee ajax request
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ecom_id'=>'required',
            'category_id' => 'required',
            'sub_category_name' => 'required|unique:sub_categories',
            'subcategory_image' => 'required|image',
        ],[
            'ecom_id.required'=>'Ecommerce name is required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            $save_url = null;
            if ($request->hasFile('subcategory_image') && $request->subcategory_image->isValid()) {
                // brand_image upload and save
                $image = $request->file('subcategory_image');
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(400, 400)->save('upload/subcategory/' . $name_gen);
                $save_url = 'upload/subcategory/' . $name_gen;
                $subcategory = new SubCategory;
                $subcategory->ecom_id = $request->input('ecom_id');
                $subcategory->sub_category_name = $request->input('sub_category_name');
                $subcategory->sub_category_slug_name = strtolower(str_replace(' ', '-', $request->sub_category_name));
                $subcategory->category_id = $request->input('category_id');
                $subcategory->subcategory_image  = $save_url;
                $subcategory->save();
                   return response()->json(
                [
                    'message' => 'SubCategory Added Successfully',
                    'subcategory' => $subcategory
                    ]
            );
            } else {
                $subcategory = new SubCategory;
                 $subcategory->ecom_id = $request->input('ecom_id');
                $subcategory->sub_category_name = $request->input('sub_category_name');
                $subcategory->sub_category_slug_name = strtolower(str_replace(' ', '-', $request->sub_category_name));
                $subcategory->category_id = $request->input('category_id');
                $subcategory->save();
                   return response()->json(
                [
                    'message' => 'SubCategory Added Successfully',
                    'subcategory' => $subcategory
                ]
            );

            }
        }
    }
    // handle edit an employee ajax request
    public function edit($role, $id)
    {
        $subcategory = SubCategory::find($id);
        return response()->json([
            'status' => 200,
            'subcategory' => $subcategory,
        ]);
    }
    // handle update an employee ajax request
    public function update(Request $request, $role, $id)
    {
        $subcat = SubCategory::find($id);
        if (!$subcat) {
            return response()->json(['message' => ' Not Found'], 404);
        }
        $validator = Validator::make($request->all(), [
            'ecom_id' => 'required',
            'sub_category_name'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $save_url = $subcat->subcategory_image;
        if ($request->hasFile('subcategory_image') && $request->subcategory_image->isValid()) {
            $this->removePreviousImage($subcat->subcategory_image);
            // subcat_image update and save
            $image = $request->file('subcategory_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(400, 400)->save('upload/subcategory/' . $name_gen);
            $save_url = 'upload/subcategory/' . $name_gen;
        }
        try {
             $subcat->ecom_id = $request->input('ecom_id');
            $subcat->sub_category_name = $request->input('sub_category_name');
            $subcat->sub_category_slug_name = strtolower(str_replace(' ', '-', $request->sub_category_name));
            $subcat->category_id = $request->input('category_id');
            $subcat->subcategory_image  = $save_url;
            $subcat->update();
            return response()->json(['message' => 'Sub Category Updated Successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    // function for remove previous image
    private function removePreviousImage($image)
    {
        if (file_exists(public_path($image))) {
            unlink(public_path($image));
            return true;
        }
        return false;
    }
    // handle delete an employee ajax request
    public function delete($role, $id)
    {
        $subcategory = SubCategory::find($id);
        $img = $subcategory->subcategory_image;
        if ($img) {
            unlink($img);
        }
        $subcategory->delete();
        $notification = array(
            'message' =>  'Sub Category Deleted Sucessfully',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }

    // API Start
      public function SubCategoryViewApi()
    {
        $categorys = Category::orderBy('category_name', 'ASC')->get();
        $subcategory = SubCategory::latest()->get();
        return response([
            'category' => $categorys,
            'subcategory' => $subcategory,
        ]);
    }
    // API End

     public function activeDeactiveSubCategory($role, $id,Request $request){
        // dd($request->all());
        $subcategory = SubCategory::find($id);
        // dd($subcategory);
        $success = $subcategory->update([
            'status'=>$request->status,
        ]);

        if($success ){
            return response()->json(['success'=>'Successfully Save Data',200]);
        }else{
            return response()->json(['error'=>'Something went wrong']);
        }

    }

      // for search sub category by  ajax
      public function searchSubcategoryByAjax($adminId, $value){
        $admin = Admin::where('id',$adminId)->first();
        $employeePermision = json_decode($admin->permission,true);
        $employee=$admin->employee_id;

        $categories = SubCategory::select(['sub_categories.*','ecommerce__names.ecom_name', 'categories.category_name'])
                                ->join('ecommerce__names','sub_categories.ecom_id','ecommerce__names.id')
                                ->join('categories','sub_categories.category_id','categories.id')
                                ->where('sub_category_name', 'LIKE', "$value%")
                                ->get();
            return response()->json(['subcategories'=>$categories,'employeePermision'=>$employeePermision,'employee'=>$employee]) ;
    }



}
