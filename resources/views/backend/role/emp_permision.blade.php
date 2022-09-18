@extends('admin.admin_master')

@section('main-content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid pt-5">

            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="card">
                        
                        <div class="card-body">
                            <div class=" d-flex justify-content-between">
                                <h4 class="header-title pb-2">Employee Role Permission</h4> 
    
                                <button data-bs-toggle="modal" data-bs-target="#employeePermissionModal" type="button"
                                    class="btn btn-success waves-effect waves-light mb-2 me-2"><i
                                    class="fas fa-plus pe-2"></i> Add Employee Permission</button>
                            </div>

                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>  Image</th>
                                        <th width="200">Employee Name</th>
                                        <td> Email</td>
                                        <td> test</td>
                                        <td> Access</td>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    @foreach ($employeePermission as $item)
                                    <tr>
                                        <td> <img src="{{ asset($item->profile_photo_path) }}"
                                                style="width: 50px; height: 50px;"> </td>
                                        <td> {{ $item->name }} </td>
                                        <td> {{ $item->email }} </td>

                                        <td>


            
                                           @if( isset($item->permission['permissions']['product']))
                                           {{'product'}}
                                           @endif
                                           @if( isset($item->permission['permissions']['employee']))
                                           {{'employee'}}
                                           @endif
                                           @if( isset($item->permission['permissions']['category']))
                                           {{'category'}}
                                           @endif
                                           @if( isset($item->permission['permissions']['subcategory']))
                                           {{'subcategory'}}
                                           @endif
                                           @if( isset($item->permission['permissions']['subsubcategory']))
                                           {{'subsubcategory'}}
                                           @endif
                                            
                                               
                                          
                                        </td>
                                        <td>
                                            @if ($item->brand == 1)
                                            <span class="badge btn-primary">Brand</span>
                                            @else
                                            @endif
                                            @if ($item->category == 1)
                                            <span class="badge btn-secondary">Category</span>
                                            @else
                                            @endif
                                            @if ($item->product == 1)
                                            <span class="badge btn-success">Product</span>
                                            @else
                                            @endif
                                            @if ($item->slider == 1)
                                            <span class="badge btn-danger">Slider</span>
                                            @else
                                            @endif
                                            @if ($item->cupons == 1)
                                            <span class="badge btn-warning">Cupons</span>
                                            @else
                                            @endif
                                            @if ($item->shipping == 1)
                                            <span class="badge btn-info">Shipping</span>
                                            @else
                                            @endif
                                            @if ($item->setting == 1)
                                            <span class="badge btn-dark">Setting</span>
                                            @else
                                            @endif
                                            @if ($item->returnorder == 1)
                                            <span class="badge btn-primary">Return Order</span>
                                            @else
                                            @endif
                                            @if ($item->review == 1)
                                            <span class="badge btn-secondary">Review</span>
                                            @else
                                            @endif
                                            @if ($item->pos == 1)
                                            <span class="badge btn-primary">POS</span>
                                            @else
                                            @endif
                                            
                                            
                                            
                                            @if ($item->orders == 1)
                                            <span class="badge btn-success">Orders</span>
                                            @else
                                            @endif
                                            
                                            
                                   
                                            
                                            
                                            
                                            
                                            @if ($item->stock == 1)
                                            <span class="badge btn-danger">Stock</span>
                                            @else
                                            @endif
                                            @if ($item->reports == 1)
                                            <span class="badge btn-warning">Reports</span>
                                            @else
                                            @endif
                                            @if ($item->alluser == 1)
                                            <span class="badge btn-info">Alluser</span>
                                            @else
                                            @endif
                                            @if ($item->adminuserrole == 1)
                                            <span class="badge btn-dark">Admin user role</span>
                                            @else
                                            @endif
    
                                            @if ($item->shop_owner_dashboard == 1)
                                            <span class="badge btn-danger">Shop Owner Role</span>
                                            @endif
    
                                            @if ($item->shop_owner == 1)
                                            <span class="badge btn-warning">Shop Owner</span>
                                            @endif
    
                                            @if ($item->agent_add == 1)
                                            <span class="badge btn-warning">Agent Add</span>
                                            @endif  
                                            
                                             @if ($item->manage_return_product == 1)
                                            <span class="badge btn-warning">Manage Return Product</span>
                                            @endif 
    
                                        </td>
                                        <td width="25%">
                                            <a href="javaScript:void(0)" onclick="getAdminInformation(this)"
                                                data-url="{{ route('role.edit.employee.user', [config('fortify.guard'), $item->id]) }}" class="action-icon edit-icon" title="Edit Data" data-bs-toggle="modal" data-bs-target="#updateAdminsModal" ><i
                                                class="mdi mdi-square-edit-outline mt-5"></i> </a>
                                                
                                            <a onclick="confirmDelete(this)" data-url="{{ route('role.delete.admin.user', [config('fortify.guard'), $item->id]) }}" href="javascript:void(0);"
                                                class="action-icon delete-icon" title="Delete"><i
                                                    class="far fa-trash-alt"></i> </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            

                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div><!-- end col -->
            </div>
        </div> <!-- container -->

    </div> <!-- content -->
    {{-- // employee permission modal start --}}
<div class="modal fade" id="employeePermissionModal" tabindex="-1" aria-labelledby="exampleModalLabel"
data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-black text-center" id="exampleModalLabel"> Employee Role Permission</h3>
                <button type="button" id="clickData" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form id="addEmployeeForm">

                <div class="modal-body p-4 bg-light ">
                    <div class="row p-2">
                    

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="user-name" class="form-label">Employee Name</label>
                                <div class="controls">
                                    <Select class="form-control" name="type">
                                        @foreach ($employees as $emp)
                                            <option value="{{ $emp->id }}">{{ $emp->employee_name }}
                                            </option>
                                        @endforeach
                                    </Select>
                                </div>
                            </div>
                        </div> <!-- end col -->

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="controls">
                                    <input type="password" id="password" name="password"
                                        class="form-control" placeholder="Password" required>
                                </div>
                            </div>
                        </div> <!-- end col -->
                        <div class="row">
                            <div class="col-12">
                                <h3>Permission Name :</h3>
                            </div>
                        </div>
                        <div class="admin-access-container pt-2">
                             
                                <div class="row">
                                    <div class="col-lg-4  col-md-6">
                                        
                                        <div class="form-check mb-2 form-check-success">
                                            <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                name="list_info" value="1">
                                            <label class="form-check-label" for="customckeck2">Brand & Category List </label>
                                        </div>
    
                                        <div class="form-check mb-2 form-check-warning">
                                            <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_5"
                                                name="slider" value="1">
                                            <label class="form-check-label" for="customckeck4">Slider</label>
                                        </div>
                                        <div class="form-check mb-2 form-check-warning">
                                            <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_17"
                                                name="pos" value="1">
                                            <label class="form-check-label" for="customckeck13">POS</label>
                                        </div>

                                        <div class="form-check mb-2 form-check-danger">
                                            <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_16"
                                                name="expence" value="1">
                                            <label class="form-check-label" for="customckeck12">Expence</label>
                                        </div>
                                        
                                        
                                         <div class="form-check mb-2 form-check-danger">
                                            <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_16"
                                                name="employee_order_processing" value="1">
                                            <label class="form-check-label" for="customckeck12">Employee Processing Orders</label>
                                        </div>
                                        
                                        
                                         <div class="form-check mb-2 form-check-danger">
                                            <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_16"
                                                name="pickup_boy_order" value="1">
                                            <label class="form-check-label" for="customckeck12">Pick-up Boy Processing Orders</label>
                                        </div>
                                        
                                    </div>
    
    
                                    <div class="col-lg-4 col-md-6">
    
                                        <div class="form-check mb-2 form-check-success">
                                            <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_9"
                                                name="setting" value="1">
                                            <label class="form-check-label" for="customckeck11"> Software Setting</label>
                                        </div>
    
                                        <div class="form-check mb-2 form-check-danger">
                                            <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_10"
                                                name="returnorder" value="1">
                                            <label class="form-check-label" for="customckeck12">Return Order</label>
                                        </div>
    
                                        <div class="form-check mb-2 form-check-warning">
                                            <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_11"
                                                name="review" value="1">
                                            <label class="form-check-label" for="customckeck13">Review</label>
                                        </div>
                                        <div class="form-check mb-2 form-check-pink">
                                            <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_6"
                                                name="cupons" value="1">
                                            <label class="form-check-label" for="customckeck5">Coupons</label>
                                        </div>
                                     
                                        
                                        <div class="form-check mb-2 form-check-danger">
                                            <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_16"
                                                name="employee_salary" value="1">
                                            <label class="form-check-label" for="customckeck12">Employee salary</label>
                                        </div>
                                       
                                    </div>
    
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-check mb-2 form-check-primary">
                                            <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_12"
                                                name="orders" value="1">
                                            <label class="form-check-label" for="customckeck10">Orders</label>
                                        </div>
    
                                        <div class="form-check mb-2 form-check-success">
                                            <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_13"
                                                name="stock" value="1">
                                            <label class="form-check-label" for="customckeck11">Stock</label>
                                        </div>
    
                                        <div class="form-check mb-2 form-check-danger">
                                            <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_14"
                                                name="reports" value="1">
                                            <label class="form-check-label" for="customckeck12">Reports</label>
                                        </div>
    
                                        <div class="form-check mb-2 form-check-warning">
                                            <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_15"
                                                name="alluser" value="1">
                                            <label class="form-check-label" for="customckeck13">All user</label>
                                        </div>
    
                                        <div class="form-check mb-2 form-check-danger">
                                            <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_16"
                                                name="adminuserrole" value="1">
                                            <label class="form-check-label" for="customckeck12">Admin user role</label>
                                        </div>
                                       
                                       
    
                                        <div class="form-check mb-2 form-check-danger">
                                            <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_16"
                                                name="websetting" value="1">
                                            <label class="form-check-label" for="customckeck12">Web Settings</label>
                                        </div>
                                        <div class="form-check mb-2 form-check-danger">
                                            <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_16"
                                                name="manage_return_product" value="1">
                                            <label class="form-check-label" for="customckeck12">Manage Return Product </label>
                                        </div>
    
    
    
                                    </div>
                                </div> <!-- end row-->

                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-striped dt-responsive table-bordered nowrap w-100">
                                            <thead>
                                                <tr class="table-primary">
                                                    <th>Permission Name</th>
                                                    <th class="text-center">Add</th>
                                                    <th class="text-center">Edit</th>
                                                    <th class="text-center">View</th>
                                                    <th class="text-center">Delete</th>
                                                </tr>
                                            </thead>

                                            <tr>
                                                <td>Ecommerce</td>
                                                <td>
                                                    <div class="form-check form-check-success d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[ecommerce][add]" value="1">
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check  form-check-warning d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[ecommerce][edit]" value="1">
                                                       
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-primary d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[ecommerce][view]" value="1">
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-danger d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_1dd"
                                                            name="permissions[ecommerce][delete]" value="1">
                                                       
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td>Product</td>
                                                <td>
                                                    <div class="form-check form-check-success d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[product][add]" value="1">
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check  form-check-warning d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[product][edit]" value="1">
                                                       
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-primary d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[product][view]" value="1">
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-danger d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_1dd"
                                                            name="permissions[product][delete]" value="1">
                                                       
                                                    </div>
                                                </td>
                                            </tr>

                                           

                                            <tr>
                                                <td>Brand</td>
                                                <td>
                                                    <div class="form-check form-check-success d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[brand][add]" value="1">
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check  form-check-warning d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[brand][edit]" value="1">
                                                       
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-primary d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[brand][view]" value="1">
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-danger d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_1dd"
                                                            name="permissions[brand][delete]" value="1">
                                                       
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Category</td>
                                                <td>
                                                    <div class="form-check form-check-success d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[category][add]" value="1">
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check  form-check-warning d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[category][edit]" value="1">
                                                       
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-primary d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[category][view]" value="1">
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-danger d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_1dd"
                                                            name="permissions[category][delete]" value="1">
                                                       
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Sub Category</td>
                                                <td>
                                                    <div class="form-check form-check-success d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[subcategory][add]" value="1">
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check  form-check-warning d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[subcategory][edit]" value="1">
                                                       
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-primary d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[subcategory][view]" value="1">
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-danger d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_1dd"
                                                            name="permissions[subcategory][delete]" value="1">
                                                       
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Sub Sub-Category</td>
                                                <td>
                                                    <div class="form-check form-check-success d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[subsubcategory][add]" value="1">
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check  form-check-warning d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[subsubcategory][edit]" value="1">
                                                       
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-primary d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[subsubcategory][view]" value="1">
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-danger d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_1dd"
                                                            name="permissions[subsubcategory][delete]" value="1">
                                                       
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Supplier </td>
                                                <td>
                                                    <div class="form-check form-check-success d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[supplier][add]" value="1">
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check  form-check-warning d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[supplier][edit]" value="1">
                                                       
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-primary d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[supplier][view]" value="1">
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-danger d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_1dd"
                                                            name="permissions[supplier][delete]" value="1">
                                                       
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Agent </td>
                                                <td>
                                                    <div class="form-check form-check-success d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[agent][add]" value="1">
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check  form-check-warning d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[agent][edit]" value="1">
                                                       
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-primary d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[agent][view]" value="1">
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-danger d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_1dd"
                                                            name="permissions[agent][delete]" value="1">
                                                       
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Employee</td>
                                                <td>
                                                    <div class="form-check form-check-success d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[employee][add]" value="1">
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check  form-check-warning d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[employee][edit]" value="1">
                                                       
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-primary d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[employee][view]" value="1">
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-danger d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_1dd"
                                                            name="permissions[employee][delete]" value="1">
                                                       
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" style="padding: 12px;width:90px;"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" style="padding: 12px; width:90px;" class="btn btn-info">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- update employee modal  --}}
<div class="modal fade" id="updateAdminsModal" tabindex="-1" aria-labelledby="exampleModalLabel"
data-bs-backdrop="static" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title text-black text-center" id="exampleModalLabel">Employee Role Permission Update
            </h3>
            <button type="button" id="clickDatassss" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
        <form method="post" action="{{ route('role.employee.user.update', config('fortify.guard')) }}" id="validation" class="updateSubmitForm"
            enctype="multipart/form-data">
            @csrf
           <div class="modal-body p-4 bg-light">
                <div class="admin-input-container  ">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <input type="hidden" name="id" class="adminUpdateID">
                                <label for="user-name" class="form-label">User Name <span
                                        class="text-danger">*</span></label>
                                <div class="controls">
                                    <input type="text" id="user-name" name="name" class=" adminNameUpdate form-control" required disabled
                                        placeholder="User name...">
                                </div>
                            </div>
                        </div>
                        
                      
                        
                      
                        <div class="col-lg-6">
                            <div>
                                <img id="showImage" src="{{ url('upload/no_image.jpg') }}" class="adminImageUpdate"
                                    style="width: 100px; height: 100px;" alt="Image">
                            </div>
                        </div>



                    </div>
                </div>


                <div class="admin-access-container pt-4 updateADminPermissionfield">
                 
                </div>
            </div>
        
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" style="padding: 12px;width:90px;"
                    data-bs-dismiss="modal">Close</button>
                <button type="submit" style="padding: 12px; width:90px;" id="addAdmin" class="btn btn-info">Save </button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
@section('script')
<script>
    function confirmDelete(event){
            console.dir(event)

            let fileUrl = event.dataset.url;

            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085D6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: fileUrl,
                    success: function(response) {
                        Swal.fire('Deleted!','Your file has been deleted.','success');
                        location.reload();
                        
                    },
                });

            }
            });
        
            
    }
        // employee permission 
        $('#addEmployeeForm').on('submit', function(e) {
        e.preventDefault();
        let role = "{{ config('fortify.guard') }}";

            // let formData = new FormData($(this)[0]);
            let formDataCheck = new FormData($('#addEmployeeForm')[0]);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: `/${role}/adminuserrole/employee/permision/store`,
                type: 'POST',
                data: formDataCheck,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#employeePermissionModal').modal('hide');
                    toastr.success("Successfully set permission");
                    location.reload();
                },
                error: function(er) {
                    console.log(er)
                    if (er.status > 399) {
                        $.each(er.responseJSON.errors, function(index, value) {
                            toastr.error(value);
                        });
                       
                    }
                },
                cache: false,
                processData: false,
            });

    });

    // update employee information
    function getAdminInformation(event){
        let getUrl = event.dataset.url; 
        $.ajax({
                type: "GET",
                dataType: "json",
                url: getUrl,
                success: function(response) {
                    console.log(response.permission);
                    // console.log(response.permission.permissions.employee.add);
                    $('.updateSubmitForm')[0].reset();
                    $('.adminUpdateID').val(response.id)
                    $('.adminNameUpdate').val(response.name)
                    $('.adminEmailUpdate').val(response.email)
                    $('.adminPhoneUpdate').val(response.phone)
                    $('.adminImageUpdate').attr('src','/'+response.profile_photo_path)
                    $('.permissionsss').remove();
                    let permissions = `

                    <div class="row permissionsss">
                                <div class="col-lg-4  col-md-6">
                                    

                                    <div class="form-check mb-2 form-check-success">
                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                            name="list_info" value="1" ${response.list_info == 1 ? 'checked' :''}>
                                        <label class="form-check-label" for="customckeck2">Brand & Category List </label>
                                    </div>


                                    <div class="form-check mb-2 form-check-warning">
                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_5"
                                            name="slider" value="1" ${response.slider == 1 ? 'checked' :''}>
                                        <label class="form-check-label" for="customckeck4">Slider</label>
                                    </div>
                                    <div class="form-check mb-2 form-check-warning">
                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_17"
                                            name="pos" value="1" ${response.pos == 1 ? 'checked' : ''}>
                                        <label class="form-check-label" for="customckeck13">POS</label>
                                    </div>

                                 
                                    <div class="form-check mb-2 form-check-danger">
                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_16"
                                            name="expence" value="1" ${response.expence == 1 ? 'checked' : ''}>
                                        <label class="form-check-label" for="customckeck12">Expence</label>
                                    </div>
                                    
                                     <div class="form-check mb-2 form-check-danger">
                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_16"
                                            name="employee_order_processing" value="1" ${response.employee_order_processing == 1 ? 'checked' : ''}>
                                        <label class="form-check-label" for="customckeck12">Employee Order Processing</label>
                                    </div>
                                    
                                    
                                     <div class="form-check mb-2 form-check-danger">
                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_16"
                                            name="pickup_boy_order" value="1" ${response.pickup_boy_order == 1 ? 'checked' : ''}>
                                        <label class="form-check-label" for="customckeck12">Pick-up Boy Order Processing</label>
                                    </div>
                                    
                                      
                                    
                                </div>


                                <div class="col-lg-4 col-md-6">
                                 

                                    <div class="form-check mb-2 form-check-success">
                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_9"
                                            name="setting" value="1" ${response.setting == 1 ? 'checked' : ''}>
                                        <label class="form-check-label" for="customckeck11"> Software Setting</label>
                                    </div>

                                    <div class="form-check mb-2 form-check-danger">
                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_10"
                                            name="returnorder" value="1" ${response.returnorder == 1 ? 'checked' : ''}>
                                        <label class="form-check-label" for="customckeck12">Return Order</label>
                                    </div>

                                    <div class="form-check mb-2 form-check-warning">
                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_11"
                                            name="review" value="1" ${response.review == 1 ? 'checked' : ''}>
                                        <label class="form-check-label" for="customckeck13">Review</label>
                                    </div>
                                    <div class="form-check mb-2 form-check-pink">
                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_6"
                                            name="cupons" value="1" ${response.cupons == 1 ? 'checked' : ''}>
                                        <label class="form-check-label" for="customckeck5">Coupons</label>
                                    </div>
                                
                                    <div class="form-check mb-2 form-check-danger">
                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_16"
                                            name="employee_salary" value="1" ${response.employee_salary == 1 ? 'checked' : ''}>
                                        <label class="form-check-label" for="customckeck12">Employee salary</label>
                                    </div>
                                   
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-check mb-2 form-check-primary">
                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_12"
                                            name="orders" value="1" ${response.orders == 1 ? 'checked' : ''}>
                                        <label class="form-check-label" for="customckeck10">Orders</label>
                                    </div>

                                    <div class="form-check mb-2 form-check-success">
                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_13"
                                            name="stock" value="1" ${response.stock == 1 ? 'checked' : ''}>
                                        <label class="form-check-label" for="customckeck11">Stock</label>
                                    </div>

                                    <div class="form-check mb-2 form-check-danger">
                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_14"
                                            name="reports" value="1" ${response.reports == 1 ? 'checked' : ''}>
                                        <label class="form-check-label" for="customckeck12">Reports</label>
                                    </div>

                                    <div class="form-check mb-2 form-check-warning">
                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_15"
                                            name="alluser" value="1" ${response.alluser == 1 ? 'checked' : ''}>
                                        <label class="form-check-label" for="customckeck13">All user</label>
                                    </div>

                                    <div class="form-check mb-2 form-check-danger">
                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_16"
                                            name="adminuserrole" value="1" ${response.adminuserrole == 1 ? 'checked' : ''}>
                                        <label class="form-check-label" for="customckeck12">Admin user role</label>
                                    </div>
                                 

                                    <div class="form-check mb-2 form-check-danger">
                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_16"
                                            name="websetting" value="1" ${response.websetting == 1 ? 'checked' : ''}>
                                        <label class="form-check-label" for="customckeck12">Web Settings</label>
                                    </div>
                                  


                                    <div class="form-check mb-2 form-check-danger">
                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_16"
                                            name="manage_return_product" value="1" ${response.manage_return_product == 1 ? 'checked' : ''}>
                                        <label class="form-check-label" for="customckeck12">Manage Return Product </label>
                                    </div>



                                </div>





                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-striped dt-responsive table-bordered nowrap w-100">
                                            <thead>
                                                <tr class="table-primary">
                                                    <th>Permission Name</th>
                                                    <th class="text-center">Add</th>
                                                    <th class="text-center">Edit</th>
                                                    <th class="text-center">View</th>
                                                    <th class="text-center">Delete</th>
                                                </tr>
                                            </thead>
                                            <tr>
                                                <td>Ecommerce</td>
                                                <td>
                                                    <div class="form-check form-check-success d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[ecommerce][add]" value="1" ${response.permission.permissions && response.permission.permissions.ecommerce && response.permission.permissions.ecommerce.add ? 'checked' : ''}>
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check  form-check-warning d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[ecommerce][edit]" value="1" ${response.permission.permissions && response.permission.permissions.ecommerce && response.permission.permissions.ecommerce.edit ? 'checked' : ''}>
                                                       
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-primary d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[ecommerce][view]" value="1" ${response.permission.permissions && response.permission.permissions.ecommerce && response.permission.permissions.ecommerce.view ? 'checked' : ''}>
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-danger d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_1dd"
                                                            name="permissions[ecommerce][delete]" value="1" ${response.permission.permissions && response.permission.permissions.ecommerce && response.permission.permissions.ecommerce.delete ? 'checked' : ''}>
                                                       
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Product</td>
                                                <td>
                                                    <div class="form-check form-check-success d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[product][add]" value="1" ${response.permission.permissions && response.permission.permissions.product && response.permission.permissions.product.add ? 'checked' : ''}>
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check  form-check-warning d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[product][edit]" value="1" ${response.permission.permissions && response.permission.permissions.product && response.permission.permissions.product.edit ? 'checked' : ''}>
                                                       
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-primary d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[product][view]" value="1" ${response.permission.permissions && response.permission.permissions.product && response.permission.permissions.product.view ? 'checked' : ''}>
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-danger d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_1dd"
                                                            name="permissions[product][delete]" value="1" ${ response.permission.permissions && response.permission.permissions.product && response.permission.permissions.product.delete ? 'checked' : ''}>
                                                       
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Brand</td>
                                                <td>
                                                    <div class="form-check form-check-success d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[brand][add]" value="1" ${ response.permission.permissions && response.permission.permissions.brand && response.permission.permissions.brand.add ? 'checked' : ''}>
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check  form-check-warning d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[brand][edit]" value="1" ${ response.permission.permissions && response.permission.permissions.brand && response.permission.permissions.brand.edit ? 'checked' : ''}>
                                                       
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-primary d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[brand][view]" value="1" ${ response.permission.permissions && response.permission.permissions.brand && response.permission.permissions.brand.view ? 'checked' : ''}>
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-danger d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_1dd"
                                                            name="permissions[brand][delete]" value="1" ${ response.permission.permissions && response.permission.permissions.brand && response.permission.permissions.brand.delete ? 'checked' : ''}>
                                                       
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Category</td>
                                                <td>
                                                    <div class="form-check form-check-success d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[category][add]" value="1" ${ response.permission.permissions && response.permission.permissions.category && response.permission.permissions.category.add ? 'checked' : ''}>
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check  form-check-warning d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[category][edit]" value="1" ${response.permission.permissions && response.permission.permissions.category && response.permission.permissions.category.edit ? 'checked' : ''}>
                                                       
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-primary d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[category][view]" value="1" ${response.permission.permissions && response.permission.permissions.category && response.permission.permissions.category.view ? 'checked' : ''}>
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-danger d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_1dd"
                                                            name="permissions[category][delete]" value="1" ${response.permission.permissions && response.permission.permissions.category && response.permission.permissions.category.delete ? 'checked' : ''}>
                                                       
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Sub Category</td>
                                                <td>
                                                    <div class="form-check form-check-success d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[subcategory][add]" value="1" ${response.permission.permissions && response.permission.permissions.subcategory && response.permission.permissions.subcategory.add ? 'checked' : ''}>
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check  form-check-warning d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[subcategory][edit]" value="1" ${ response.permission.permissions && response.permission.permissions.subcategory && response.permission.permissions.subcategory.edit ? 'checked' : ''}>
                                                       
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-primary d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[subcategory][view]" value="1" ${response.permission.permissions && response.permission.permissions.subcategory && response.permission.permissions.subcategory.view ? 'checked' : ''}>
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-danger d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_1dd"
                                                            name="permissions[subcategory][delete]" value="1" ${response.permission.permissions && response.permission.permissions.subcategory && response.permission.permissions.subcategory.delete ? 'checked' : ''}>
                                                       
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Sub Sub-Category</td>
                                                <td>
                                                    <div class="form-check form-check-success d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[subsubcategory][add]" value="1" ${response.permission.permissions && response.permission.permissions.subsubcategory && response.permission.permissions.subsubcategory.add ? 'checked' : ''}>
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check  form-check-warning d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[subsubcategory][edit]" value="1" ${response.permission.permissions && response.permission.permissions.subsubcategory && response.permission.permissions.subsubcategory.edit ? 'checked' : ''}>
                                                       
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-primary d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[subsubcategory][view]" value="1" ${response.permission.permissions && response.permission.permissions.subsubcategory && response.permission.permissions.subsubcategory.view ? 'checked' : ''}>
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-danger d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_1dd"
                                                            name="permissions[subsubcategory][delete]" value="1" ${response.permission.permissions && response.permission.permissions.subsubcategory && response.permission.permissions.subsubcategory.delete ? 'checked' : ''}>
                                                       
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Supplier </td>
                                                <td>
                                                    <div class="form-check form-check-success d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[supplier][add]" value="1" ${response.permission.permissions && response.permission.permissions.supplier && response.permission.permissions.supplier.add ? 'checked' : ''}>
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check  form-check-warning d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[supplier][edit]" value="1" ${response.permission.permissions && response.permission.permissions.supplier && response.permission.permissions.supplier.edit ? 'checked' : ''}>
                                                       
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-primary d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[supplier][view]" value="1"  ${response.permission.permissions && response.permission.permissions.supplier && response.permission.permissions.supplier.view ? 'checked' : ''}>
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-danger d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_1dd"
                                                            name="permissions[supplier][delete]" value="1" ${response.permission.permissions && response.permission.permissions.supplier && response.permission.permissions.supplier.delete ? 'checked' : ''}>
                                                       
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Agent </td>
                                                <td>
                                                    <div class="form-check form-check-success d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[agent][add]" value="1" ${response.permission.permissions && response.permission.permissions.agent && response.permission.permissions.agent.add ? 'checked' : ''}>
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check  form-check-warning d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[agent][edit]" value="1" ${response.permission.permissions && response.permission.permissions.agent && response.permission.permissions.agent.edit ? 'checked' : ''}>
                                                       
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-primary d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[agent][view]" value="1" ${response.permission.permissions && response.permission.permissions.agent && response.permission.permissions.agent.view ? 'checked' : ''}>
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-danger d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_1dd"
                                                            name="permissions[agent][delete]" value="1" ${response.permission.permissions && response.permission.permissions.agent && response.permission.permissions.agent.delete ? 'checked' : ''}>
                                                       
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Employee</td>
                                                <td>
                                                    <div class="form-check form-check-success d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[employee][add]" value="1" ${response.permission.permissions && response.permission.permissions.employee && response.permission.permissions.employee.add ? 'checked' : ''}>
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check  form-check-warning d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[employee][edit]" value="1" ${response.permission.permissions && response.permission.permissions.employee && response.permission.permissions.employee.edit ? 'checked' : ''}>
                                                       
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-primary d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                                            name="permissions[employee][view]" value="1" ${response.permission.permissions && response.permission.permissions.employee && response.permission.permissions.employee.view ? 'checked' : ''}>
                                                        
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check form-check-danger d-flex justify-content-center">
                                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_1dd"
                                                            name="permissions[employee][delete]" value="1" ${response.permission.permissions && response.permission.permissions.employee && response.permission.permissions.employee.delete ? 'checked' : ''}>
                                                       
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                    
                    `;
                    $('.updateADminPermissionfield').append(permissions);

                    // Swal.fire('Success!','Your are getting this user inforamtion.','success');
                    
                    
                },
            });
    }
</script>
@endsection
