<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\Supplier;
use App\Models\AgentPanel;
use App\Models\ManagerPanel;
use Carbon\Carbon;
use App\Models\Permission;
use Image;
use App\Models\ShopOwner;
use App\Models\Subscriber;
use Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    // Admin User Role
    public function AllAdminRole()
    {
       
        $adminuser = Admin::all();
        
        return view('backend.role.admin_role_all', compact('adminuser'));
    } // end method

    public function SupPermison()
    {
        $supplierPermission = Admin::where('supplier_id','!=',null)->get();
        $supplier = Supplier::whereDoesntHave('admin')->get();
        return view('backend.role.suplier_permision', compact('supplier','supplierPermission'));
    } // end method
    public function ManagerPermission()
    {


        $manage_panel = Supplier::all();
        // dd(  $manage_panel);
        return view('backend.role.manager_panel', compact('manage_panel'));
    }
    public function EmpPermison()
    {
        $employeePermission = Admin::where('employee_id','!=',null)->get();
        $employees = Employee::whereDoesntHave('admin')->get();
        // $employees = Employee::all();
        return view('backend.role.emp_permision', compact('employees','employeePermission'));
    } // end method
    // Admin All User View
    public function AddAdminRole()
    {
        // $employees = Employee::all();
        // $supplier = Supplier::all();

        // return view('backend.role.admin_role_create', compact('employees', 'supplier'));

        $admins = Admin::where([['supplier_id',null],['employee_id',null],['agent_id',null]])->get();
        return view('backend.role.admin_role_create',compact('admins'));
    }


// =================== Supplier Store Add start ==================================>
    public function StoreSupplierRole(Request $request)
    {
        $value = $request->all();
        if (array_key_exists('type', $value)) {
            $emp = Supplier::find($request->type);        
            Admin::insert([
                'name' => $emp->supplyer_name,
                'supplier_id' => $emp->id,
                'email' => $emp->supplyer_email,
                'password' => Hash::make($request->password),
                'phone' => $emp->supplyer_phone,  
                'supplier_dashboard' => $request->supplier_dashboard, 
                'supplier' => $request->supplier,   
                'created_at' => Carbon::now(),
            ]);
        } else {
            $image = $request->file('profile_photo_path');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(225, 225)->save('upload/admin_images/' . $name_gen);
            $save_url = 'upload/admin_images/' . $name_gen;
            Admin::insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,              
                'supplier_dashboard' => $request->supplier_dashboard,             
                'supplier' => $request->supplier,  
                'type' => $request->type,
                'profile_photo_path' => $save_url,
                'created_at' => Carbon::now(),
            ]);
        }
        $notification = array(
            'message' => 'Supplier Role Add Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('role.all.admin.user', config('fortify.guard'))->with($notification);
    }
// =================== Supplier Store Add end ==================================>











// =================== Admin  Store Add start ==================================>
    public function StoreAdminRole(Request $request)
    {  
        $value = $request->all();
        if (array_key_exists('type', $value)) {
            $emp = Employee::find($request->type);
            Admin::insert([
                'name' => $emp->employee_name,
                'employee_id'=>$emp->id,
                'email' => $emp->email_id,
                'password' => Hash::make($request->password),
                'phone' => $emp->employee_phone,
                'brand' => $request->brand,
                'category' => $request->category,
                'manage_panel' => $request->manage_panel,
                'brand_caregory' => $request->brand_caregory,
                'product' => $request->product,
                'owner_dashboard' => $request->owner_dashboard,
                'agent_panel' => $request->agent_panel,
                'agent_add' => $request->agent_add,
                'slider' => $request->slider,
                'supplier_dashboard' => $request->supplier_dashboard,
                'cupons' => $request->cupons, 
                'list_info' => $request->list_info, 

                'shipping' => $request->shipping,
                'setting' => $request->setting,
                'returnorder' => $request->returnorder,
                'review' => $request->review,
                'pos' => $request->pos,

                'orders' => $request->orders,
                'stock' => $request->stock,
                'reports' => $request->reports,
                'manage_return_product' => $request->manage_return_product,

                'alluser' => $request->alluser,
                'employee' => $request->employee,
                'supplier' => $request->supplier,
                'department' => $request->department,
                'employee_salary' => $request->employee_salary,
                'purchase' => $request->purchase,
                'websetting' => $request->websetting,
                'expence' => $request->expence,
                'admin_dashboard' => $request->admin_dashboard,
                'banner_caregory' => $request->banner_caregory,
                'adminuserrole' => $request->adminuserrole,
                'type' => $emp->department_id,
                'profile_photo_path' => $emp->employee_img,
                'created_at' => Carbon::now(),
            ]);
        } else {
            $image = $request->file('profile_photo_path');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(225, 225)->save('upload/admin_images/' . $name_gen);
            $save_url = 'upload/admin_images/' . $name_gen;
            Admin::insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'brand' => $request->brand,
                'category' => $request->category,
                'product' => $request->product,
                'slider' => $request->slider,
                'agent_add' => $request->agent_add,
                'manage_panel' => $request->manage_panel,

                'owner_dashboard' => $request->owner_dashboard,
                'agent_panel' => $request->agent_panel,
                'cupons' => $request->cupons,
                'shipping' => $request->shipping,
                'setting' => $request->setting,
                'list_info' => $request->list_info, 
                'returnorder' => $request->returnorder,
                'review' => $request->review,
                'brand_caregory' => $request->brand_caregory,
                'pos' => $request->pos,
                'orders' => $request->orders,
                'stock' => $request->stock,
                'manage_return_product' => $request->manage_return_product,
                'reports' => $request->reports,
                'alluser' => $request->alluser,
                'employee' => $request->employee,
                'supplier_dashboard' => $request->supplier_dashboard,
                'supplier' => $request->supplier,
                'department' => $request->department,
                'admin_dashboard' => $request->admin_dashboard,
                'employee_salary' => $request->employee_salary,
                'purchase' => $request->purchase,

                'expence' => $request->expence,
                'websetting' => $request->websetting,
                'banner' => $request->banner,
                'banner_caregory' => $request->banner_caregory,
                'adminuserrole' => $request->adminuserrole,
                'type' => $request->type,
                'profile_photo_path' => $save_url,
                'created_at' => Carbon::now(),
            ]);
        }
        $notification = array(
            'message' => 'Admin Role Add Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('role.all.admin.user', config('fortify.guard'))->with($notification);
    } // end method
// =================== Admin Store Add start ==================================>

// =================== Admin Edite  start ==================================>
    public function EditAdminRole($adminrole, $id)
    {
        $adminuser = Admin::findOrFail($id);
        // return view('backend.role.admin_role_edit', compact('adminuser'));
        return response()->json($adminuser);
    } // end method
// =================== Admin Edit end ==================================>


 // =================== Admin Update start ==================================>  
    public function UpdateAdminRole(Request $request)
    {
        
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required',
        //     'password' => 'required|min:6|max:12',
        //     'phone' => 'required',
        //     'image' => 'required',
        // ]);
        $admin_id = $request->id;
        $old_img = $request->old_image;
        if ($request->file('profile_photo_path')) {
            unlink($old_img);
            $image = $request->file('profile_photo_path');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(225, 225)->save('upload/admin_images/' . $name_gen);
            $save_url = 'upload/admin_images/' . $name_gen;
            Admin::findOrFail($admin_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'brand' => $request->brand,
                'category' => $request->category,
                'brand_caregory' => $request->brand_caregory,
                'product' => $request->product,
                'slider' => $request->slider,
                'manage_panel' => $request->manage_panel,
                'agent_add' => $request->agent_add,
                'cupons' => $request->cupons,
                'shipping' => $request->shipping,
                'setting' => $request->setting,
                'returnorder' => $request->returnorder,
                'list_info' => $request->list_info, 
                'review' => $request->review,
                'admin_dashboard' => $request->admin_dashboard,
                'manage_return_product' => $request->manage_return_product,
                'pos' => $request->pos,
                'orders' => $request->orders,
                'supplier' => $request->supplier,
                'stock' => $request->stock,

                'reports' => $request->reports,
                'owner_dashboard' => $request->owner_dashboard,
                'agent_panel' => $request->agent_panel,
                'alluser' => $request->alluser,
                'department' => $request->department,
                'employee_salary' => $request->employee_salary,
                'employee' => $request->employee,                
                'purchase' => $request->purchase,
                'expence' => $request->expence,
                'banner' => $request->banner,
                'banner_caregory' => $request->banner_caregory,
                'supplier_dashboard' => $request->supplier_dashboard,
                'websetting' => $request->websetting,
                'adminuserrole' => $request->adminuserrole,
                'type' => $emp->department_id,
                // 'profile_photo_path' => $emp->employee_img,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Admin Role Update Successfully',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        } else {
            Admin::findOrFail($admin_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'brand' => $request->brand,
                'category' => $request->category,
                'product' => $request->product,
                'slider' => $request->slider,
                'cupons' => $request->cupons,
                'manage_panel' => $request->manage_panel,
                'shipping' => $request->shipping,
                'setting' => $request->setting,
                'returnorder' => $request->returnorder,
                'brand_caregory' => $request->brand_caregory,
                'review' => $request->review,
                'agent_add' => $request->agent_add,
                'manage_return_product' => $request->manage_return_product,                
                'pos' => $request->pos,
                'list_info' => $request->list_info, 
                'websetting' => $request->websetting,
                'owner_dashboard' => $request->owner_dashboard,
                'agent_panel' => $request->agent_panel,
                'orders' => $request->orders,
                'supplier' => $request->supplier,
                'stock' => $request->stock,
                'employee' => $request->employee,    
                'reports' => $request->reports,
                'alluser' => $request->alluser,
                'department' => $request->department,

                'employee_salary' => $request->employee_salary,
                'purchase' => $request->purchase,
                'admin_dashboard' => $request->admin_dashboard,
                'expence' => $request->expence,
                'supplier_dashboard' => $request->supplier_dashboard,
                'banner' => $request->banner,
                'banner_caregory' => $request->banner_caregory,
                'adminuserrole' => $request->adminuserrole,
                'type' => 2,
                // 'profile_photo_path' => $emp->employee_img,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Admin Role Updated Successfully',
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        } // end else
    } // end method
  // =================== Admin Update End ==================================>  

  // =================== Admin Delete start ==================================>  
    public function DeleteAdminRole($adminrole, $id)
    {
        $adminimg = Admin::findOrFail($id);


        Admin::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Admin Role Deleted Successfully',
            'alert-type' => 'info'
        );
        return response()->json($notification);
    } // end method
  // =================== Admin Delete end ==================================


  // =================== shopOwnerPermission start ==================================
    public function shopOwnerPermission()
    {
        $shopOwners = ShopOwner::all();
        return view('backend.role.shop_owner', compact('shopOwners'));
    }
  // =================== shopOwnerPermission End ==================================


 // =================== Agent Permission start ==================================
    public function AgentPermission()
    {
        $agentPermission = Admin::where('agent_id','!=',null)->get();
        $agent_panel = AgentPanel::whereDoesntHave('admin')->get();
        return view('backend.role.agent_panel', compact('agent_panel','agentPermission'));
    }
 // =================== Agent Permission End ==================================



// =================== Agent Permission Store  start ==================================
    public function AgentPermissionStore(Request $request)

    {   
        // dd($request->all());
        $shopOwner = AgentPanel::findOrFail($request->type);        
        Admin::insert([
            'agent_id' => $request->type,
            'name' => $shopOwner->name,
            'email' => $shopOwner->email,
            'password' => Hash::make($request->password),
            'phone' => $shopOwner->phone,                 
            'agent_panel' => $request->agent_panel ,   
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Agent Role Add Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('role.all.admin.user', config('fortify.guard'))->with($notification);
    }
   // =================== Agent Permission Store  End ==================================
 




    public function subscribeView($role)
    {
        $subscribers = Subscriber::all();
        return view('backend.subscribe.subscribe_view', compact('subscribers'));
    }





// ========================= Employee Permations ================================= 

   
    public function employeePermissionSotre($role, Request $request){

        $emp = Employee::find($request->type);
   

        $permissionData=[
            'name' => $emp->employee_name,
            'employee_id'=>$emp->id,
            'email' => $emp->email_id,
            'password' => Hash::make($request->password),
            'phone' => $emp->employee_phone,
            
            'manage_panel' => $request->manage_panel,
            'brand_caregory' => $request->brand_caregory,
            'owner_dashboard' => $request->owner_dashboard,
            'slider' => $request->slider,
            'supplier_dashboard' => $request->supplier_dashboard,
            'cupons' => $request->cupons, 
            'list_info' => $request->list_info,   
           'employee_order_processing' => $request->employee_order_processing,   

            'shipping' => $request->shipping,
            'setting' => $request->setting,
            'returnorder' => $request->returnorder,
            'review' => $request->review,
            'pos' => $request->pos,
             'pickup_boy_order' => $request->pickup_boy_order,

            'orders' => $request->orders,
            'stock' => $request->stock,
            'reports' => $request->reports,
            'manage_return_product' => $request->manage_return_product,

            'alluser' => $request->alluser,
            'department' => $request->department,
            'employee_salary' => $request->employee_salary,
            'purchase' => $request->purchase,
            'websetting' => $request->websetting,
            'expence' => $request->expence,
            'admin_dashboard' => $request->admin_dashboard,
            'banner_caregory' => $request->banner_caregory,
            'adminuserrole' => $request->adminuserrole,
            'type' => $emp->department_id,
            'profile_photo_path' => $emp->employee_img,
        ];
        if(isset($request->permissions['product'])){
             
            $permissionData['product'] = 1;
        }
        if(isset($request->permissions['brand'])){
             
            $permissionData['brand'] = 1;
        }
        if(isset($request->permissions['employee'])){
            $permissionData['employee'] = 1;
        }

        if(isset($request->permissions['category'])){
            $permissionData['category'] = 1;
        }
        
        if(isset($request->permissions['supplier'])){
            $permissionData['supplier'] = 1;
        }
        if(isset($request->permissions['agent'])){
            $permissionData['agent_add'] = 1;
        }

        // dd( $permissionData);
            $admin= Admin::create($permissionData);

            $arraytt =$request->permissions;

            Permission::create([
               'admin_id'=>$admin->id,
               'permissions'=>$arraytt
           ]);
    }
   
   
    public function EditEmployeeRole($adminrole, $id)
    {
        $adminuser = Admin::where('id',$id)->with('permission')->first();
        // return view('backend.role.admin_role_edit', compact('adminuser'));
        return response()->json($adminuser);
    }

    public function updateEmployeePermission(Request $request){
        $employeeAdmin = Admin::find($request->id);
        $permissionData=[
            
            'manage_panel' => $request->manage_panel,
            'brand_caregory' => $request->brand_caregory,
            'owner_dashboard' => $request->owner_dashboard,
            'slider' => $request->slider,
            'supplier_dashboard' => $request->supplier_dashboard,
            'cupons' => $request->cupons, 
            'list_info' => $request->list_info, 
            'shipping' => $request->shipping,
            'setting' => $request->setting,
            'returnorder' => $request->returnorder,
            'review' => $request->review,
            'pos' => $request->pos,
            'pickup_boy_order' => $request->pickup_boy_order,
            'orders' => $request->orders,
             'employee_order_processing' => $request->employee_order_processing,  
            'stock' => $request->stock,
            'reports' => $request->reports,
            'manage_return_product' => $request->manage_return_product,
            'alluser' => $request->alluser,
            'department' => $request->department,
            'employee_salary' => $request->employee_salary,
            'purchase' => $request->purchase,
            'websetting' => $request->websetting,
            'expence' => $request->expence,
            'admin_dashboard' => $request->admin_dashboard,
            'banner_caregory' => $request->banner_caregory,
            'adminuserrole' => $request->adminuserrole,
            
        ];
        if(isset($request->permissions['product'])){
             
            $permissionData['product'] = 1;
        }else{
            $permissionData['product'] = null;
        }
        if(isset($request->permissions['brand'])){
             
            $permissionData['brand'] = 1;
        }else{
            $permissionData['brand'] = null;
        }
        if(isset($request->permissions['employee'])){
            $permissionData['employee'] = 1;
        }else{
            $permissionData['employee'] = null;
        }
        
        if(isset($request->permissions['category'])){
            $permissionData['category'] = 1;
        }else{
            $permissionData['agent_add'] = null;
        }
        if(isset($request->permissions['employee'])){
            $permissionData['category'] = 1;
        }else{
            $permissionData['category'] = null;
        }
        if(isset($request->permissions['supplier'])){
            $permissionData['supplier'] = 1;
        }else{
            $permissionData['supplier'] = null;
        }
        if(isset($request->permissions['agent'])){
            $permissionData['agent_add'] = 1;
        }else{
            $permissionData['agent_add'] = null;
        }

        $employeeAdmin->update($permissionData);

        Permission::where('admin_id',$employeeAdmin->id)->update([
            'permissions'=>$request->permissions
        ]);

        $notification = array(
            'message' => 'Admin Role Update Successfully'
        );
        return redirect()->back()->with($notification);
    }
//==========================employee permations end ================================





}  // main end
