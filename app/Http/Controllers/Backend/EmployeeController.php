<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Employee;
use App\Models\EmployeeReference;
use Image;
use App\Models\EmployeeTecking;
use App\Models\EmployeeDeleteHistory;
use Carbon\Carbon;
use App\Models\Fileimg;
use OwenIt\Auditing\Models\Audit;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\fileExists;

class EmployeeController extends Controller
{




    // employee view
    public function EmployeeView()
    {
        $employees = Employee::all();

        return view('backend.employee.manage_employee', compact('employees'));
    } // end mathod

    // Employee Add form
    public function EmployeeAddForm()
    {
        $departments = Department::all();

        return view('backend.employee.add_employee', compact('departments'));
    } // end method

    // Employee Add
    public function EmployeeStore(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'employee_name' => 'required',
            'department_id' => 'required',
            'employee_office_id' => 'required',
            'employee_photo' => 'image|mimes:webp',
            'email_id' => "required|unique:employees",
            'employee_phone' => 'required|max:11',
            'employee_fathers_name' => 'required',
            'employee_mother_name' => 'required',
            'employee_salary' => 'required',
            'employee_date_of_birth' => 'required',
            'employee_joing_date' => 'required',
            'employee_present_address' => 'required',
            'employee_permanent_address' => 'required',
            'designation' => 'required',
            // 'employee_Upload_file' => 'required|mimes:webp',
            // 'employee_Upload_file.*'=>'required|mimes:webp',
            'reference_name_one' => 'required',
            'reference_mobile_one' => 'required|max:11',
            'reference_relationship_one' => 'required',
            'reference_address_one' => 'required',
            'reference_name_two' => 'required',
            'reference_mobile_num_two' => 'required|max:11',
            'reference_relationship_two' => 'required',
            'reference_address_two' => 'required',
            'reference_mobile_num_3' => 'max:11',
            'reference_mobile_num_4' => 'max:11',



        ]);

        // Banner Img upload and save
        $image = $request->file('employee_photo');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(400, 400)->save('upload/employee/' . $name_gen);
        $save_url = 'upload/employee/' . $name_gen;
         $save_url_multi = array();

       $employee= Employee::create([
            'employee_name' => $request->employee_name,
            'department_id' => $request->department_id,
            'employee_office_id' => $request->employee_office_id,
            'employee_status' => $request->employee_status,
            'employee_img' => $save_url,
            // 'employee_Upload_file' => $array,
            'designation' => $request->designation,
            'email_id' => $request->email_id,
            'zone_id' => $request->zone_id,
            'employee_phone' =>'+88'. $request->employee_phone,
            'employee_fathers_name' => $request->employee_fathers_name,
            'employee_mother_name' => $request->employee_mother_name,
            'employee_salary' => $request->employee_salary,
            'employee_date_of_birth' => $request->employee_date_of_birth,
            'employee_joing_date' => $request->employee_joing_date,
            'employee_present_address' => $request->employee_present_address,
            'employee_permanent_address' => $request->employee_permanent_address,

        ]);
           $reference= EmployeeReference::create([
            'employee_id' => $employee->id,
            'reference_name_one' => $request->reference_name_one,
            'reference_mobile_one' => '+88'. $request->reference_mobile_one,
            'reference_relationship_one' => $request->reference_relationship_one,
            'reference_address_one' => $request->reference_address_one,
            'reference_name_two' => $request->reference_name_two,
            'reference_mobile_num_two' =>'+88'. $request->reference_mobile_num_two,
            'reference_relationship_two' => $request->reference_relationship_two,
            'reference_address_two' => $request->reference_address_two,
            'reference_name_3' => $request->reference_name_3,
            'reference_mobile_num_3' => '+88'.$request->reference_mobile_num_3,
            'reference_relationship_3' => $request->reference_relationship_3,
            'reference_address_3' => $request->reference_address_3,
             'reference_name_4' => $request->reference_name_4,
             'reference_mobile_num_4' =>'+88'. $request->reference_mobile_num_4,
             'reference_relationship_4' => $request->reference_relationship_4,
             'reference_address_4' => $request->reference_address_4,
            ]);



            //  ===================== Employee Multi File Upload Start ================

            if ($request->file('employee_multi_file')) {
                // Multiple img upload start
                $MultiImg = new Fileimg;
                $images = $request->file('employee_multi_file');
                foreach ($images as $loop=>$img) {
            $make_name = $employee->employee_name .$loop. '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(1024, 1024)->save('upload/employee/multifile/' . $make_name);
                    $uploadPath = 'upload/employee/multifile/' . $make_name;

                    $MultiImg= Fileimg::insert([
                        // product_id is all info make single id
                        'employee_id' => $employee->id,
                        'photo_name' => $uploadPath,
                        'created_at' => Carbon::now(),
                    ]);
                } // end loop
            }
        //  ===================== Employee Multi File Upload End ================




        $notification = array(
            'message' => 'Employee Created sucessfully',
            'alert-type' => 'success'
        );

        return redirect()->route('role.employee.view', config('fortify.guard'))->with($notification);
    } // end method




    // employee Edit
    public function EmployeeEdit($role, $id)
    {

        $employee = Employee::find($id);
        // dd($employee);
        $employeereference= EmployeeReference::where('employee_id',$employee->id)->first();
        // dd($employeereference);
        $departments = Department::all();

         $multiimgs = Fileimg::where('employee_id', $id)->get();

        return view('backend.employee.edit_employee', compact('employee', 'departments','employeereference','multiimgs'));
    } // end mathod


    // update employee
    public function EmployeeUpdate(Request $request, $role)
    {

        $request->validate([
            'employee_photo' => 'image|mimes:webp',
            'employee_name' => 'required',
            'department_id' => 'required',
            'employee_office_id' => 'required',
            'email_id' => "required",
            'employee_phone' => 'required|max:11',
            'employee_fathers_name' => 'required',
            'employee_mother_name' => 'required',
            'employee_salary' => 'required',
            'employee_date_of_birth' => 'required',
            'employee_joing_date' => 'required',
            'employee_present_address' => 'required',
            'employee_permanent_address' => 'required',
            'designation' => 'required',
            // 'employee_Upload_file' => 'required|array|mimes:webp',
            'employee_Upload_file.*'=>'image|mimes:webp',
             'reference_name_one' => 'required',
             'reference_mobile_one' => 'required|max:11',
             'reference_relationship_one' => 'required',
             'reference_address_one' => 'required',
             'reference_name_two' => 'required',
             'reference_mobile_num_two' => 'required|max:11',
             'reference_relationship_two' => 'required',
             'reference_address_two' => 'required',
             'reference_mobile_num_3' => 'max:11',
             'reference_mobile_num_4' => 'max:11',

           ]);

        $employee_id = $request->id;
        $old_img  = $request->old_img;
        $old_image = $request->old_image;
        $reference_id = $request->reference_id;

        $employee = Employee::find($employee_id);

        if ($request->file('employee_photo') ) {
            if(file_exists($old_img) && $request->old_img !=null )
            {
                  unlink($old_img);
            }
            $image = $request->file('employee_photo');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(400, 400)->save('upload/employee/' . $name_gen);
            $save_url = 'upload/employee/' . $name_gen;
            $employee->employee_img = $save_url;

        }



            // employee Update
             $employee->employee_name = $request->input('employee_name');

             $employee->department_id = $request->input('department_id');
             $employee->designation = $request->input('designation');
             $employee->employee_office_id = $request->input('employee_office_id');
             $employee->employee_status = $request->input('employee_status');
             $employee->email_id = $request->input('email_id');
             $employee->employee_phone ='+88'. $request->input('employee_phone');
             $employee->employee_fathers_name = $request->input('employee_fathers_name');
             $employee->employee_mother_name = $request->input('employee_mother_name');
             $employee->employee_salary = $request->input('employee_salary');
             $employee->employee_date_of_birth = $request->input('employee_date_of_birth');
             $employee->employee_joing_date = $request->input('employee_joing_date');
             $employee->employee_present_address = $request->input('employee_present_address');
             $employee->employee_permanent_address = $request->input('employee_permanent_address');
             $employee->update();

             $reference= EmployeeReference::findOrFail($reference_id)->update([
             'employee_id' => $employee->id,
             'reference_name_one' => $request->reference_name_one,
             'reference_mobile_one' => '+88'.$request->reference_mobile_one,
             'reference_relationship_one' => $request->reference_relationship_one,
             'reference_address_one' => $request->reference_address_one,
             'reference_name_two' => $request->reference_name_two,
             'reference_mobile_num_two' => '+88'.$request->reference_mobile_num_two,
             'reference_relationship_two' => $request->reference_relationship_two,
             'reference_address_two' => $request->reference_address_two,
             'reference_name_3' => $request->reference_name_3,
             'reference_mobile_num_3' => '+88'.$request->reference_mobile_num_3,
             'reference_relationship_3' => $request->reference_relationship_3,
             'reference_address_3' => $request->reference_address_3,
             'reference_name_4' => $request->reference_name_4,
             'reference_mobile_num_4' => '+88'.$request->reference_mobile_num_4,
             'reference_relationship_4' => $request->reference_relationship_4,
             'reference_address_4' => $request->reference_address_4,
             ]);
            $notification = array(
                'message' =>  'Employee Updated Successfully',
                'alert-type' => 'info'
            );
            return redirect()->route('role.employee.view', config('fortify.guard'))->with($notification);

    } // method end




    // ==================> Product Multiple Image Update Start <==============================================
    public function UpdateEmployeeMultiImg(Request $request)
    {


    // dd($request->all());
         $request->validate([
             'employee_multi_file.*.*' => 'image|mimes:webp',
        ],
    [
         'employee_multi_file.required' => 'Atleast 1 image change is required for update',
    ]);


        $imgs = $request->employee_multi_file;
        foreach ($imgs as $id => $img) {
            if ($id != 'new' && $img!=null) {
                $imgDel = Fileimg::findOrFail($id);
                 $imgcheck = Fileimg::with('employee')->where('id',$id)->first();
                if($imgDel->photo_name && file_exists($imgDel->photo_name))
                {
                    unlink($imgDel->photo_name);
                }
                $make_name = $imgcheck->employee->employee_name.rand(110,1111). '.' . $img->getClientOriginalExtension();
                Image::make($img)->resize(600, 600)->save('upload/employee/multifile/' . $make_name);
                $uploadPath = 'upload/employee/multifile/' . $make_name;
                Fileimg::where('id', $id)->update([
                    'photo_name' => $uploadPath,
                    'updated_at' => Carbon::now(),

                ]);
            }
        } // end foreach


        $employee = Employee::find($request->employee_id);
        if(array_key_exists('new', $imgs))
        {
            foreach ($imgs['new'] as $img) {
                 $make_name = $employee->employee_name.rand(110,1111). '.' . $img->getClientOriginalExtension();
                Image::make($img)->resize(1024, 1024)->save('upload/products/multi-image/' . $make_name);
                $uploadPath = 'upload/products/multi-image/' . $make_name;
                Fileimg::insert([
                    // product_id is all info make single id
                    'employee_id' => $employee->id,
                    'photo_name' => $uploadPath,
                    'created_at' => Carbon::now(),
                ]);
            }

        }


        $notification = array(
            'message' => 'Multi File Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
// ==================> Product Multiple Image Update End <==============================================
// ==================> Product Multiple Image Delete Start <============================================
    public function MultiImageDelete($role, $id)
    {
        $oldimg = Fileimg::findOrFail($id);
        if(file_exists($oldimg->photo_name))
        {
            unlink($oldimg->photo_name);
        }
        Fileimg::findOrFail($id)->delete();
        $notification = array(
            'message' => 'File Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }
// ==================> Product Multiple Image Delete Start <============================================





    // employee All  view
    public function EmployeeDetails($role, $id)
    {
        $emp = Employee::where('id',$id)->with('department')->first();
        // employee multi file show
         $multiimgs = Fileimg::where('employee_id', $id)->get();
        $empref=EmployeeReference::where('employee_id',$emp->id)->first();
        return view('backend.employee.all_view_employee', compact('emp','empref','multiimgs'));
    }
    // end mathod  EmployeetDetails





    public function EmployeetDelete($role, $id)
    {

        $employee1 = Employee::findOrFail($id);

        $reference= EmployeeReference::where('employee_id',$employee1->id)->delete();
        $img = $employee1->employee_img;
        if (file_exists($img) && $img !=null ) {
        unlink($img);

        }
       Employee::findOrFail($id)->delete();




        $notification = array(
            'message' =>  'Employee Delete Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('role.employee.view', config('fortify.guard'))->with($notification);
    }





      public function trackingHistory(){
           $employee_teckings=Employee::with('employeeTacking')->get();


            return view('backend.employee.employee_tracking_history',compact('employee_teckings'));
        }

     public function addTrackingHistory($role, $id){

           $addTrackingHistory=EmployeeTecking::where('employee_id',$id)->where('working_info','productAdd')->with(['productName.ecommerce','productName.category','productName.supplier','productName.subcategory','productName.subsubcategory'])->get();
           $employeeInformation=Employee::where('id',$id)->first();

            return view('backend.employee.employee_add_all_product',compact('addTrackingHistory','employeeInformation'));
        }



    public function updateTrackingHistory($role, $id){

        $updateTrackingHistory=EmployeeTecking::where('employee_id',$id)->where('working_info','productUpdate')->with(['productName.ecommerce','productName.category','productName.supplier','productName.subcategory','productName.subsubcategory'])->get();

         $employeeInformation=Employee::where('id',$id)->first();

            return view('backend.employee.employee_update_all_product',compact('updateTrackingHistory','employeeInformation'));
        }

    public function deleteTrackingHistory($role, $id){

       $deleteTrackingHistory=EmployeeDeleteHistory::where('employee_id',$id)->with(['ecommerce'])->get();

         $employeeInformation=Employee::where('id',$id)->first();

            return view('backend.employee.employee_delete_all_product',compact('deleteTrackingHistory','employeeInformation'));
        }





}
