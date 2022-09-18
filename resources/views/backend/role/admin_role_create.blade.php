@extends('admin.admin_master')

@section('main-content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid pt-5">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class=" d-flex justify-content-between">
                                <h4 class="header-title pb-2">Create Admin</h4>

                                <button data-bs-toggle="modal" data-bs-target="#addAminsModal" type="button"
                                    class="btn btn-success waves-effect waves-light mb-2 me-2"><i
                                        class="fas fa-plus pe-2"></i> Add Admin Permission</button>
                            </div>

                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <td>Email</td>
                                        <td>Access</td>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $item)
                                        <tr>
                                            <td> <img src="{{ asset($item->profile_photo_path) }}"
                                                    style="width: 50px; height: 50px;"> </td>
                                            <td> {{ $item->name }} </td>
                                            <td> {{ $item->email }} </td>
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
                                                {{-- <a href="{{ route('role.edit.admin.user', [config('fortify.guard'), $item->id]) }}"
                                                    class="action-icon edit-icon" title="Edit Data"><i
                                                        class="mdi mdi-square-edit-outline mt-5"></i> </a> --}}

                                                        <a href="javaScript:void(0)" onclick="getAdminInformation(this)"
                                                           data-url="{{ route('role.edit.admin.user', [config('fortify.guard'), $item->id]) }}" class="action-icon edit-icon" title="Edit Data" data-bs-toggle="modal" data-bs-target="#updateAdminsModal" ><i
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

 {{-- // add admin modal   --}}
    <div class="modal fade" id="addAminsModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-black text-center" id="exampleModalLabel">Create Admin Role and Permission
                    </h3>
                    <button type="button" id="clickDatassss" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('role.admin.user.store', config('fortify.guard')) }}" id="validation"
                    enctype="multipart/form-data">
                    @csrf
                   <div class="modal-body p-4 bg-light">
                        <div class="admin-input-container  ">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label for="user-name" class="form-label">User Name <span
                                                class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input type="text" id="user-name" name="name" class="form-control" required
                                                placeholder="User name...">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email <span
                                                class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input type="email" id="email" name="email" class="form-control" required
                                                placeholder="email@bppshops.com">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">User Phone </label>
                                        <div class="controls">
                                            <input type="text" id="phone" name="phone" class="form-control"
                                                placeholder="01XXXXXXXXX">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password <span
                                                class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input type="password" id="password" name="password" required minlength="6"
                                                class="form-control" placeholder="******">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label for="adminUserImage" class="form-label">User Image</label>
                                        <div class="controls">
                                            <input type="file" name="profile_photo_path" class="form-control" required=""
                                                id="image">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div>
                                        <img id="showImage" src="{{ url('upload/no_image.jpg') }}"
                                            style="width: 100px; height: 100px;" alt="Image">
                                    </div>
                                </div>



                            </div>
                        </div>


                        <div class="admin-access-container pt-4">
                            <div class="row">
                                <div class="col-lg-3  col-md-6">
                                    <div class="form-check mb-2 form-check-primary">
                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_2"
                                            name="admin_dashboard" value="1">
                                        <label class="form-check-label" for="customckeck1">Admin Dashboard </label>
                                    </div>
                                    <div class="form-check mb-2 form-check-primary">
                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_2"
                                            name="brand" value="1">
                                        <label class="form-check-label" for="customckeck1">Brand</label>
                                    </div>

                                    <div class="form-check mb-2 form-check-success">
                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                            name="category" value="1">
                                        <label class="form-check-label" for="customckeck2">Category</label>
                                    </div>

                                    
                                    <div class="form-check mb-2 form-check-success">
                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                            name="list_info" value="1">
                                        <label class="form-check-label" for="customckeck2">Brand & Category List </label>
                                    </div>



                             

                                    <div class="form-check mb-2 form-check-danger">
                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_4"
                                            name="product" value="1">
                                        <label class="form-check-label" for="customckeck3">Product</label>
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
                                            name="employee" value="1">
                                        <label class="form-check-label" for="customckeck12">Employee</label>
                                    </div>
                                    <div class="form-check mb-2 form-check-danger">
                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_16"
                                            name="supplier" value="1">
                                        <label class="form-check-label" for="customckeck12">Supplier Panel</label>
                                    </div>
                                    <div class="form-check mb-2 form-check-danger">
                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_16"
                                            name="expence" value="1">
                                        <label class="form-check-label" for="customckeck12">Expence</label>
                                    </div>
                                </div>


                                <div class="col-lg-3 col-md-6">
                                   

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

                                <div class="col-lg-3 col-md-6">
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
                                            name="agent_add" value="1">
                                        <label class="form-check-label" for="customckeck12">Agent Add</label>
                                    </div>


                                    <div class="form-check mb-2 form-check-danger">
                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_16"
                                            name="manage_return_product" value="1">
                                        <label class="form-check-label" for="customckeck12">Manage Return Product </label>
                                    </div>



                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div>
                    {{-- <div class="modal-footer"> 
                        <button type="submit" class="admin-btn mt-3" id="addAdmin" ></button>
                    </div> --}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" style="padding: 12px;width:90px;"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" style="padding: 12px; width:90px;" id="addAdmin" class="btn btn-info">Save </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- update admin modal  --}}
    <div class="modal fade" id="updateAdminsModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-black text-center" id="exampleModalLabel">Create Admin Role and Permission
                    </h3>
                    <button type="button" id="clickDatassss" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('role.admin.user.update', config('fortify.guard')) }}" id="validation" class="updateSubmitForm"
                    enctype="multipart/form-data">
                    @csrf
                   <div class="modal-body p-4 bg-light">
                        <div class="admin-input-container  ">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <input type="hidden" name="id" class="adminUpdateID">
                                        <label for="user-name" class="form-label">User Name <span
                                                class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input type="text" id="user-name" name="name" class=" adminNameUpdate form-control" required
                                                placeholder="User name...">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email <span
                                                class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input type="email" id="email" name="email"  class="adminEmailUpdate form-control" required
                                                placeholder="email@bppshops.com">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">User Phone </label>
                                        <div class="controls">
                                            <input type="text" id="phone" name="phone" class="adminPhoneUpdate form-control"
                                                placeholder="01XXXXXXXXX">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label for="adminUserImage" class="form-label">User Image</label>
                                        <div class="controls">
                                            <input type="file" name="profile_photo_path"  class="form-control" 
                                                id="image">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
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
                    {{-- <div class="modal-footer"> 
                        <button type="submit" class="admin-btn mt-3" id="addAdmin" ></button>
                    </div> --}}
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

    // for confirm and delete admin 
    
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
    
    function getAdminInformation(event){
        let getUrl = event.dataset.url; 
        // let submitURL = ;
        // alert(submitURL)
        $.ajax({
                type: "GET",
                dataType: "json",
                url: getUrl,
                success: function(response) {
                    $('.updateSubmitForm')[0].reset();
                    $('.adminUpdateID').val(response.id)
                    $('.adminNameUpdate').val(response.name)
                    $('.adminEmailUpdate').val(response.email)
                    $('.adminPhoneUpdate').val(response.phone)
                    $('.adminImageUpdate').attr('src','/'+response.profile_photo_path)
                    $('.permissionsss').remove();
                    let permissions = `

                    <div class="row permissionsss">
                                <div class="col-lg-3  col-md-6">
                                    <div class="form-check mb-2 form-check-primary">
                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_2"
                                            name="admin_dashboard" value="1" ${response.admin_dashboard == 1 ? 'checked' :''}>
                                        <label class="form-check-label" for="customckeck1">Admin Dashboard </label>
                                    </div>
                                    <div class="form-check mb-2 form-check-primary">
                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_2"
                                            name="brand" value="1" ${response.brand == 1 ? 'checked' :''}>
                                        <label class="form-check-label" for="customckeck1">Brand</label>
                                    </div>




                                    <div class="form-check mb-2 form-check-success">
                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                            name="list_info" value="1" ${response.list_info == 1 ? 'checked' :''}>
                                        <label class="form-check-label" for="customckeck2">Brand & Category List </label>
                                    </div>



                                    <div class="form-check mb-2 form-check-success">
                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_3"
                                            name="category" value="1" ${response.category == 1 ? 'checked' :''}>
                                        <label class="form-check-label" for="customckeck2">Category</label>
                                    </div>

                                    <div class="form-check mb-2 form-check-danger">
                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_4"
                                            name="product" value="1" ${response.product == 1 ? 'checked' :''}>
                                        <label class="form-check-label" for="customckeck3">Product</label>
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
                                            name="employee" value="1" ${response.employee == 1 ? 'checked' : ''}>
                                        <label class="form-check-label" for="customckeck12" >Employee</label>
                                    </div>
                                    <div class="form-check mb-2 form-check-danger">
                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_16"
                                            name="supplier" value="1" ${response.supplier == 1 ? 'checked' : ''}>
                                        <label class="form-check-label" for="customckeck12">Supplier Panel</label>
                                    </div>
                                    <div class="form-check mb-2 form-check-danger">
                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_16"
                                            name="expence" value="1" ${response.expence == 1 ? 'checked' : ''}>
                                        <label class="form-check-label" for="customckeck12">Expence</label>
                                    </div>
                                </div>


                                <div class="col-lg-3 col-md-6">
                                 

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

                                <div class="col-lg-3 col-md-6">
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
                                            name="agent_add" value="1" ${response.agent_add == 1 ? 'checked' : ''}>
                                        <label class="form-check-label" for="customckeck12">Agent Add</label>
                                    </div>


                                    <div class="form-check mb-2 form-check-danger">
                                        <input type="checkbox" class="form-check-input rounded-circle" id="checkbox_16"
                                            name="manage_return_product" value="1" ${response.manage_return_product == 1 ? 'checked' : ''}>
                                        <label class="form-check-label" for="customckeck12">Manage Return Product </label>
                                    </div>



                                </div>
                            </div>
                    
                    
                    
                    
                    `;
                    $('.updateADminPermissionfield').append(permissions);

                    // Swal.fire('Success!','Your are getting this user inforamtion.','success');
                    
                    
                },
            });
    }
   
        // image preview
        image.onchange = evt => {
            const [file] = image.files
            if (file) {
                showImage.src = URL.createObjectURL(file);
            }
        }

        // form validation
        addAdmin.onclick = evt => {

            let formValidation = document.getElementById('validation');

            formValidation.forEach(val => {

                if (val.attributes.required && val.value == '') {

                    val.classList.add('is-invalid')
                }

                val.onkeyup = evt => {
                    val.classList.remove('is-invalid')
                }
                val.onchange = evt => {
                    val.classList.remove('is-invalid')
                }

            })
        }
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
