@extends('admin.admin_master')
@section('main-content')
<!-------------------------------------------------Add Sub Category Banner modal2020----------------------------------->
<div class="add-subcatbanner-modal">
    <div class="modal fade" tabindex="-1" id="add-subcatbanner-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Sub Category Banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="AddSubCatBannerForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <h5 style="color: black"> Ecommerce Name<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="ecom_id" class=" form-select form-control">
                                    <option value="" selected="" disabled="">Select Ecommerce Name
                                    </option>

                                    @foreach($ecom as $ecoms)
                                    <option value="{{ $ecoms->id }}">
                                        {{ $ecoms->ecom_name }}</option>
                                    @endforeach
                                </select>
                                <span id="error_image" class="errorColor"></span>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <h5 style="color: black"> Sub category Banner Image <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="file" name="subcat_banner_image" class="form-control">
                                <span id="error_image" class="errorColor"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary waves-effect waves-light mb-2 me-2"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info waves-effect waves-light mb-2 me-2"> Add
                            Sub Category Banner</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{----------------------------------------------- Edit Sub Category Modal start
20--------------------------------------}}
<div class="modal fade" id="edit-subcatbanner-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="color: black"> Update Sub Category Banner </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="UpdateSubCatForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <ul id="updateform_errList"></ul>
                    <input type="hidden" id="edit_subcatbanner_id">
                    <div class="form-group">
                        <h5 style="color: black"> <span class="text-danger">*</span>Ecommerce Name </h5>
                        <div class="controls">
                            <select name="ecom_id" id="subsubcat_ecommerce_edit_id" class=" form-select form-control ">
                                <option value="" selected="" disabled="">Select Ecommerce Name
                                </option>
                                @foreach($ecom as $ecoms)
                                <option value="{{ $ecoms->id }}">
                                    {{ $ecoms->ecom_name }}</option>
                                @endforeach
                            </select>
                            <span id="error_image" class="errorColor"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <h5 style="color: black"> Sub Category Banner Image </h5>
                        <div class="controls">
                            <input type="file" id="subcat_banner_image_edit" name="subcat_banner_image"
                                class="form-control">
                            <span id="error_image" class="errorColor"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Sub Category Banner</button>
                </div>
            </form>

        </div>
    </div>
</div>
{{----------------------------------------- Edit Sub Category Modal End --------------------------}}
<!-------------------------------------------------Add Shop now Banner modal----------------------------------->
<div class="add-shopnowbanner-modal">
    <div class="modal fade" tabindex="-1" id="add-shopnowbanner-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Shop Now Banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="AddShopNowForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <h5 style="color: black"> Ecommerce Name<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="ecom_id" class=" form-select form-control">
                                    <option value="" selected="" disabled="">Select Ecommerce Name
                                    </option>

                                    @foreach($ecom as $ecoms)
                                    <option value="{{ $ecoms->id }}">
                                        {{ $ecoms->ecom_name }}</option>
                                    @endforeach
                                </select>
                                <span id="error_image" class="errorColor"></span>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <h5 style="color: black"> Shop now Banner Image <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="file" id="shopbanner_image_edit" name="shopbanner_image"
                                    class="form-control">
                                <span id="error_image" class="errorColor"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary waves-effect waves-light mb-2 me-2"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info waves-effect waves-light mb-2 me-2"> Add
                            Shop Now Banner</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{----------------------------------------------- Edit Sop Now Banner Modal start
--------------------------------------}}
<div class="modal fade" id="edit-shopnowbanner-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="color: black">Update Shop now Banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="UpdateShopnowForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <ul id="updateform_errList"></ul>
                    <input type="hidden" id="edit_shopnowbanner_id">
                    <div class="form-group">
                        <h5 style="color: black"> <span class="text-danger">*</span>Ecommerce Name </h5>
                        <div class="controls">
                            <select name="ecom_id" id="shopnow_ecommerce_edit_id" class=" form-select form-control ">
                                <option value="" selected="" disabled="">Select Ecommerce Name
                                </option>
                                @foreach($ecom as $ecoms)
                                <option value="{{ $ecoms->id }}">
                                    {{ $ecoms->ecom_name }}</option>
                                @endforeach
                            </select>
                            <span id="error_image" class="errorColor"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <h5 style="color: black"> Sub Category Banner Image </h5>
                        <div class="controls">
                            <input type="file" id="shopnow_banner_image_edit" name="shopbanner_image"
                                class="form-control">
                            <span id="error_image" class="errorColor"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Shop now Banner
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
{{----------------------------------------------- Edit Shop now Banner Modal End--------------------------------------}}
<!-- Begin page -->
<div id="wrapper">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        
                         <div class="add-brand-container d-flex justify-content-between mb-2">
                                <h4 style="font-size: 24px;">Sub Cayegory Banner List</h4>
                                <button data-bs-toggle="modal" data-bs-target="#add-subcatbanner-modal" type="button"
                                    class="btn btn-success waves-effect waves-light mb-2 me-2"><i
                                        class="fas fa-plus pe-2"></i> Add Sub Ctaegory Banner</button>
                            </div>
                        <div class="card-body">
                           


                                <table id="datatable-buttons" style="margin-top: 25px;" class=" datatable-buttons table table-striped nowrap w-100 ">

                                <thead>
                                    <tr>
                                        <th>Ecommerce Name</th>
                                        <th>Sub Category Banner Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($SubCategorybanner as $SubCategorybanners)
                                    <tr>
                                        <td>
                                            {{ $SubCategorybanners->ecommerce->ecom_name }}
                                        </td>

                                        <td>
                                            <img src="{{ asset($SubCategorybanners->subcat_banner_image) }}" alt="..."
                                                height="100" width="100">
                                        </td>
                                        <td>
                                            <button type="button" value="{{ $SubCategorybanners->id }}"
                                                class="btn btn-success edit_subcatbanner_btn btn-sm">
                                                <i class="fa fa-pencil-alt"></i></button>
                                            <a href="{{ route('role.subcategorybanner.delete', [config('fortify.guard'), $SubCategorybanners->id]) }}"
                                                class="btn btn-danger btn-sm" id="delete"><i
                                                    class="fa fa-trash"></i></a>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->

                </div><!-- end col-->
                {{-- ======================================Shop Now Banner======================================== --}}
                <div class="col-12">
                    <div class="card">
                        <div class="add-brand-container d-flex justify-content-between mb-2">
                                <h4 style="font-size: 24px;">Shop now List</h4>
                                <button data-bs-toggle="modal" data-bs-target="#add-shopnowbanner-modal" type="button"
                                    class="btn btn-success waves-effect waves-light mb-2 me-2"><i
                                        class="fas fa-plus pe-2"></i> Add Shop Now BAnner
                                </button>
                            </div>
                        <div class="card-body">
                            

                                <table id="datatable-buttons" style="margin-top: 25px;" class=" datatable-buttons table table-striped nowrap w-100 ">
                                <thead>
                                    <tr>
                                        <th>Ecommerce Name</th>
                                        <th>Shop Now Banner Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($shopNowbanner as $shopNowbanners)
                                    <tr>
                                        <td>{{ $shopNowbanners->ecommerce->ecom_name }}</td>
                                        <td>
                                            <img src="{{ asset($shopNowbanners->shopbanner_image) }}" alt="..."
                                                height="100" width="100">
                                        </td>
                                        <td>
                                            <button type="button" value="{{ $shopNowbanners->id }}"
                                                class="btn btn-success edit_shopnowbanner_btn btn-sm">
                                                <i class="fa fa-pencil-alt"></i></button>
                                            <a href="{{ route('role.ShopNowbanner.delete', [config('fortify.guard'), $shopNowbanners->id]) }}"
                                                class="btn btn-danger btn-sm" id="delete"><i
                                                    class="fa fa-trash"></i></a>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->

                </div><!-- end col-->
            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->
</div>
<!-- END wrapper -->

@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
{{-- 2020 --}}
<script>
    $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //Add Submit
            $(document).on('submit', '#AddSubCatBannerForm', function(e) {
                e.preventDefault();
                console.log("good");
                let formData = new FormData($('#AddSubCatBannerForm')[0]);
                $.ajax({
                    type: "POST",

                     url: `/{{ config('fortify.guard') }}/banner/subcategorybanner/store`,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status == 400) {
                            // $('#error_name').text(response.errors.brand_name_cats_eye);
                            // $('#error_image').text(response.errors.brand_image);
                        } else {
                            toastr.success(response.message);
                            location.reload();
                            $('#add-subcatbanner-modal').modal('hide');
                        }
                    }
                });
            });
            $(document).on('submit', '#UpdateSubCatForm', function(e) {
                e.preventDefault();
                var brand_id = $('#edit_subcatbanner_id').val();
                let EditFormData = new FormData($('#UpdateSubCatForm')[0]);
                // Axios Update
                axios.post(`/{{ config('fortify.guard') }}/banner/subcategorybanner/update/${brand_id}`, EditFormData)
                    .then(response => {
                        if (response.status == 400) {
                            // $('#error_name').text(response.errors.brand_name_cats_eye);
                            // $('#error_image').text(response.errors.brand_image);

                        } else {
                            toastr.success(" {{ Session::get('message') }} ");
                            location.reload();
                            $('#edit-subcatbanner-modal').modal('hide');
                        }
                    })
            }); //update end
            // for editing data using ajax
            $(document).on('click', '.edit_subcatbanner_btn', function() {
                console.log("okk");
                var brand_id = $(this).val();
                $('#edit-subcatbanner-modal').modal('show');
                $.ajax({
                    type: "GET",
                    url: `/{{ config('fortify.guard') }}/banner/subcategorybanner/edit/${brand_id}`,
                    success: function(response) {
                        console.log(response);
                        $('#subsubcat_ecommerce_edit_id').val(response.subcatbanner.ecom_id);
                        $('#edit_subcatbanner_id').val(brand_id);
                    }
                    // }
                })
            });
        });
</script>
{{-- ============================For Shop Now Banner==================================== --}}
<script>
    $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //Add Submit
            $(document).on('submit', '#AddShopNowForm', function(e) {
                e.preventDefault();
                console.log("good");
                let formData = new FormData($('#AddShopNowForm')[0]);
                $.ajax({
                    type: "POST",
                     url: `/{{ config('fortify.guard') }}/banner/shopnowbanner/store`,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status == 400) {
                            // $('#error_name').text(response.errors.brand_name_cats_eye);
                            // $('#error_image').text(response.errors.brand_image);
                        } else {
                            toastr.success(response.message);
                            location.reload();
                            $('#add-shopnowbanner-modal').modal('hide');
                        }
                    }
                });
            });
            $(document).on('submit', '#UpdateShopnowForm', function(e) {
                e.preventDefault();
                var brand_id = $('#edit_shopnowbanner_id').val();
                console.log(brand_id);
                let EditFormData = new FormData($('#UpdateShopnowForm')[0]);
                console.log(EditFormData);
                // Axios Update
                axios.post(`/{{ config('fortify.guard') }}/banner/shopnowbanner/update/${brand_id}`, EditFormData)
                    .then(response => {
                        if (response.status == 400) {
                            // $('#error_name').text(response.errors.brand_name_cats_eye);
                            // $('#error_image').text(response.errors.brand_image);

                        } else {
                            toastr.success(" {{ Session::get('message') }} ");
                            location.reload();
                            $('#edit-shopnowbanner-modal').modal('hide');
                        }
                    })
            }); //update end
            // for editing data using ajax
          $(document).on('click', '.edit_shopnowbanner_btn', function() {
        console.log("okk");
        var brand_id = $(this).val();
        $('#edit-shopnowbanner-modal').modal('show');
        $.ajax({
        type: "GET",
        url: `/{{ config('fortify.guard') }}/banner/shopnowbanner/edit/${brand_id}`,
        success: function(response) {
        $('#shopnow_ecommerce_edit_id').val(response.shopnowbanner.ecom_id);
        $('#edit_shopnowbanner_id').val(brand_id);
        }
        // }
        })
        });
        });
</script>


@endsection
