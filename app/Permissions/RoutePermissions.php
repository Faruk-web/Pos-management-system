<?php
namespace App\Permissions;

use Illuminate\Support\Facades\Auth;

trait RoutePermissions{
    private $authenticate , $admin , $employee , $agent , $supplier;

    public function __construct(){
        $this->authenticate = Auth::guard('admin')->user();

        if($this->authenticate->employee_id != null){
            $this->employee = $this->authenticate->employee_id;
        }elseif($this->authenticate->agent_id != null){
            $this->agent = $this->authenticate->agent_id;
        }elseif($this->authenticate->supplier_id != null){
            $this->supplier = $this->authenticate->supplier_id;
        }else{
            $this->admin = $this->authenticate->id;
        }
    }

    // for checking authenticate person have permission to access admin dashboard
    public function isAdminDashboard($request){
        $permission = $request->is('admin/dashboard') && $this->authenticate->admin_dashboard == 1;
        return $permission;
    }

    // for checking authenticate person have permission to access product prefix routes
    public function isProductPermission($request){

          $permission = $request->is('admin/product/*') && $this->authenticate->product == 1;
          return $permission;
    }
    public function isBrandPermission($request){

    }

    // for checking authenticate person have permission to access listbrandCategory prefix routes
    public function isBrandCategoryListPermission($request){
        $permission = $request->is('admin/listbrandCategory/*') && $this->authenticate->list_info == 1;
        return $permission;
    }

    // for  checking authenticate person have permission to access adminuserrole prefix routes,(role permission set)
    public function isSetRolePermission($request){

        if($this->employee){
            $permission = ($request->is('admin/adminuserrole/*') && !$request->is('admin/adminuserrole/add')) && $this->authenticate->adminuserrole == 1;
            return $permission;
        }else if($this->admin){
            $permission = $request->is('admin/adminuserrole/*') && $this->authenticate->adminuserrole == 1;
            return $permission;
        }

    }

    // for checking authenticate person have permission to access pos route
    public function isPosPermission($request){
        $permission = $request->is('admin/pos/*') && $this->authenticate->pos == 1;
        return $permission;
    }

    // for checking authenticate person have permission to access order prefix route
    public function isOrderPermission($request){
        $permission = $request->is('admin/order/*') && $this->authenticate->orders == 1;
        return $permission;
    }

    // for checking authenticate person have permission to access setting prefix route
    public function isSoftwareSettingsPermission($request){
        $permission = $request->is('admin/setting/*') && $this->authenticate->setting == 1;
        return $permission;
    }

    // for checking authenticate person have permission to access expense prefix route
    public function isExpensePermission($request){
        $permission = $request->is('admin/expense/*') && $this->authenticate->expence == 1;
        return $permission;
    }

    // for checking authenticate person have permission to access emplloyeer prefix routes
    public function isEmployeePermission($request){

        $permission = $request->is('admin/employeer/*') && $this->authenticate->employee == 1;
        return $permission;
    }

    // for checking authenticate person have permission to access  stock prefix routes
    public function isStockPermission($request){

        $permission = $request->is('admin/stock/*') && $this->authenticate->stock == 1;
        return $permission;
    }

    // for checking authenticate person have permission to access manager and agent prefix routes (**agent and manager are same)
    public function isAgentPanelPermissions($request){

        $permission = ( $request->is('admin/manager/*') || $request->is('admin/agent/*') ) && $this->authenticate->agent_add == 1;
        return $permission;
    }

    // for checking authenticate person have permission to access reports  prefix routes
    public function isReportsPermissions($request){

        $permission =  $request->is('admin/reports/*') && $this->authenticate->reports == 1;
        return $permission;
    }

    // for checking authenticate person have permission to access salary prefix routes
    public function isSalaryPermissions($request){

        $permission =  $request->is('admin/salary/*') && $this->authenticate->employee_salary == 1;
        return $permission;
    }

    // for checking authenticate person have permission to access cupons prefix routes
    public function isCouponsPermissions($request){

        $permission =  $request->is('admin/cupons/*') && $this->authenticate->cupons == 1;
        return $permission;
    }

    // for checking authenticate person have permission to access bannerCategory prefix routes
    public function isWebSettingsPermissions($request){

        $permission =  ($request->is('admin/banner/*') || $request->is('admin/bannerCategory/*')) && $this->authenticate->websetting == 1;
        return $permission;
    }

    // for checking authenticate person have permission to access suppliers prefix routes
    public function isSuppliersPanelPermissions($request){

        $permission =  $request->is('admin/suppliers/*') && $this->authenticate->supplier == 1;
        return $permission;
    }

    // for checking authenticate person have permission to access slider prefix routes
    public function isSliderPermissions($request){

        $permission =   $request->is('admin/slider/*')  && $this->authenticate->slider == 1;
        return $permission;
    }

    // for checking authenticate person have permission to access return prefix routes
    public function isCustomerReturnOrdersPermissions($request){

        $permission =   $request->is('admin/return/*')  && $this->authenticate->returnorder == 1;
        return $permission;
    }

    // for checking authenticate person have permission to access alluser route (All customer list)
    public function isCustomerPermissions($request){

        $permission =   $request->is('admin/alluser/*')  && $this->authenticate->alluser == 1;
        return $permission;
    }

}
