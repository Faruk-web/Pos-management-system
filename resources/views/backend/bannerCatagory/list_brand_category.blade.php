@extends('admin.admin_master')
@section('css')

<style>
        .serach_loader{
        position: fixed;
        width: 100%;
        height: 100%;

        display: none;
        justify-content: center;
        top: 0%;
        left: 0%;
        z-index: 9999;
        background-color: rgba(0,0,0,0.5);

    }
    .serach_loader > .loader{
        margin: auto;
        height: 150px;
        width: 260px;
        background: #fff;
        border-radius: 20px;
        padding: 15px;
        text-align: center;
    }

    .spinner-border {
        width: 6rem;
        height: 6rem;
    }
</style>
@endsection
@section('main-content')

<div class="serach_loader">
    <div class="loader">
        <div class="loaderElement">
            <div class="spinner-border text-danger" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
            <p >Please wait...</p>
        </div>

    </div>
</div>


{{-- Edit Brand Modal start --}}
<div class="modal fade" id="EditBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="color: black"> Update Brand </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="UpdateBrandForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <ul id="updateform_errList"></ul>
                    <input type="hidden" id="edit_brand_id">
                    <div class="form-group">
                        <label for="fname">Ecommerce Name </label>
                        <select name="ecom_id" id="ecommerce_edit_id" class=" form-select form-control ">
                            <option value="" selected="" disabled="">Select Ecommerce Name
                            </option>
                            @foreach($ecoms as $ecom)
                            <option value="{{ $ecom->id }}">
                                {{ $ecom->ecom_name }}</option>
                            @endforeach
                        </select>
                        <span id="error_s_ecom_id" class="errorColor"></span>
                    </div>
                    <div class="form-group">
                        <h5 style="color: black"> <span class="text-danger">*</span> Brand Name </h5>
                        <div class="controls">
                            <input type="text" id="cat" name="brand_name_cats_eye" placeholder="Brand Name"
                                class="form-control">
                            <span id="error_brand_name" class="errorColor"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <h5 style="color: black"> Brand Image </h5>
                        <div class="controls">
                            <input type="file" id="category_image" name="brand_image" class="form-control">
                            <span id="error_image" class="errorColor"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Brand</button>
                </div>
            </form>

        </div>
    </div>
</div>
{{-- Edit Brand Modal end --}}

{{-- Edit Category Modal Start --}}
<div class="modal fade" id="EditCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="color: black"> Update Category </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="UpdateCategoryForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <ul id="updateform_errList"></ul>
                    <input type="hidden" id="edit_category_id">

                    <div class="form-group">
                        <label for="fname">Ecommerce Name </label>
                        <select name="ecom_id" id="cat_ecommerce_edit_id" class=" form-select form-control ">
                            <option value="" selected="" disabled="">Select Ecommerce Name
                            </option>
                            @foreach($ecoms as $ecom)
                            <option value="{{ $ecom->id }}">
                                {{ $ecom->ecom_name }}</option>
                            @endforeach
                        </select>
                        <span id="cat_error_ecom_name" class="errorColor"></span>
                    </div>
                    <div class="form-group">
                        <h5 style="color: black"> <span class="text-danger">*</span> Category Name</h5>
                        <div class="controls">
                            <input type="text" id="category_name" name="category_name" class="form-control">
                            <span id="cat_error_name" class="errorColor"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <h5 style="color: black"> Category Image </h5>
                        <div class="controls">
                            <input type="file" id="category_image" name="category_image" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <h5 style="color: black"> Category Icon </h5>
                        <div class="controls">
                            <input type="file" id="category_icon" name="category_icon" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Update Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Edit Category Modal End --}}

{{-- Edit Subcategory Modal start --}}
<div class="modal fade" id="EditSubCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="color: black"> Edit SubCategory </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="UpdateSubCategoryForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <ul id="updateform_errList"></ul>
                    <input type="hidden" id="edit_subcategory_id">

                    <div class="form-group">
                        <label for="fname">Ecommerce Name </label>
                        <select name="ecom_id" id="subcat_ecommerce_edit_id" class=" form-select form-control ">
                            <option value="" selected="" disabled="">Select Ecommerce Name
                            </option>
                            @foreach($ecoms as $ecom)
                            <option value="{{ $ecom->id }}">
                                {{ $ecom->ecom_name }}</option>
                            @endforeach
                        </select>
                        <span id="subcat_error_ecom_name" class="errorColor"></span>
                    </div>

                    <label style="color: black"> Category Name</label>
                    <select id="category_id" class="form-control" name="category_id">
                        <option selected>Select a category</option>
                        @foreach ($category as $categorys)
                        <option value="{{ $categorys->id }}">{{ $categorys->category_name }}</option>
                        @endforeach
                    </select>
                    <div class="form-group">
                        <h5 style="color: black"> <span class="text-danger">*</span>Sub Category Name</h5>
                        <div class="controls">
                            <input type="text" id="sub_category_name" name="sub_category_name" class="form-control">
                            <span id="subcat_error_name" class="errorColor"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <h5 style="color: black"> Sub Category Image </h5>
                        <div class="controls">
                            <input type="file" id="subcategory_image" name="subcategory_image" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Update Sub Category</button>
                </div>
            </form>

        </div>
    </div>
</div>
{{-- Edit Subcategory Modal end --}}

{{-- Edit Sub sub category MOdal --}}
<div class="modal fade" id="EditSubSubCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="color: black"> Edit Sub Sub Category </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="UpdateSubSubCategoryForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="edit_subsubcategory_id">
                <div class="modal-body p-4 bg-light">
                    <div class="row">
                        <div class="form-group">
                            <label for="fname">Ecommerce Name </label>
                            <select name="ecom_id" id="subsubcat_ecommerce_edit_id" class=" form-select form-control ">
                                <option value="" selected="" disabled="">Select Ecommerce Name
                                </option>
                                @foreach($ecoms as $ecom)
                                <option value="{{ $ecom->id }}">
                                    {{ $ecom->ecom_name }}</option>
                                @endforeach
                            </select>
                            <span id="subcat_error_ecom_name" class="errorColor"></span>
                        </div>
                        <div class="my-2">
                            <label for="fname">Category Name</label>
                            <select name="category_id" id="subsub_category_id" class="form-control">
                                <option selected>Select a category</option>
                                @foreach ($category as $categorys)
                                <option value="{{ $categorys->id }}">{{ $categorys->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="my-2">
                            <label for="fname">Sub Category Name</label>
                            <select name="subcategory_id" id="subcategoryy_id" class="form-control"
                                aria-invalid="false">
                                <option value="" selected="" disabled="">Select Sub Category </option>
                                @foreach ($subcategory as $subcategorys)
                                <option value="{{ $subcategorys->id }}">{{ $subcategorys->sub_category_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="my-2">
                            <label for="fname">Sub Sub Category Name</label>
                            <input type="text" name="subsubcategory_name" id="subsubcategory_name" class="form-control"
                                placeholder="First Name" required>
                            <span id="subsubcate_error_name" class="errorColor"></span>
                        </div>
                        <div class="my-2">
                            <label for="avatar">Sub Category Image</label>
                            <input type="file" name="subsubcategory_image" id="subsubcategory_image"
                                class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Update Sub Sub Category</button>
                </div>
            </form>

        </div>
    </div>
</div>
{{-- Edit Sub sub category MOdal end--}}

<!--Edit Ecoomerce modal-->
<div class="modal fade" id="edit-ecommerce-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-center">Edit Ecommerce Name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="UpdateEcommerceForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="edit_ecom_id">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <h5 style="color: black"> <span class="text-danger">*</span>Ecommerce Name </h5>
                        <div class="controls">
                            <input type="text" name="ecom_name" id="edit_ecom_name" placeholder="Ecommerce Name"
                                class="form-control">
                            <span id="error_name" class="errorColor"></span>

                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-info waves-effect waves-light mb-2 me-2"> Edit
                        Ecommerce Name</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- end modal --}}

<!-- Begin page -->
<div id="wrapper">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="add-brand-container d-flex justify-content-between mb-2">
                                <h4 style="font-size: 24px;">Ecommerce List</h4>
                            </div>

                            <table id="datatable-buttons" class="datatable-buttons table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Ecommerce Name</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ecoms as $ecom)
                                    <tr>
                                        <td>{{ $ecom->ecom_name }}</td>
                                        <td>
                                            @if($employee && isset($employeePermision['permissions']['ecommerce']['edit']))

                                            <button type="button" value="{{ $ecom->id }}"
                                                class="btn btn-success editBtn btn-sm">
                                                <i class="fa fa-pencil-alt"></i></button>

                                            @elseif (!$employee)

                                            <button type="button" value="{{ $ecom->id }}"
                                                class="btn btn-success editBtn btn-sm">
                                                <i class="fa fa-pencil-alt"></i></button>

                                            @endif
                                            @if($employee && isset($employeePermision['permissions']['ecommerce']['delete']))

                                            <a href="{{ route('role.ecommerce.delete', [config('fortify.guard'), $ecom->id]) }}"
                                                class="btn btn-danger btn-sm" id="delete"><i
                                                    class="fa fa-trash"></i></a>

                                            @elseif(!$employee)

                                            <a href="{{ route('role.ecommerce.delete', [config('fortify.guard'), $ecom->id]) }}"
                                                class="btn btn-danger btn-sm" id="delete"><i
                                                    class="fa fa-trash"></i></a>

                                            @endif
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

<!-- Begin page -->
<div id="wrapper">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="add-brand-container d-flex justify-content-between mb-2">
                                <h4 style="font-size: 24px;">Brand List</h4>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 offset-lg-8">
                                    <label style="font-size: 13px; color: red; line-height: 1.2" for="prodictSearchWithAjax">Search By: Brand, Name & E-commerce Name</label>
                                    <input type="text" class="form-control" placeholder="Serach here ( Type and click enter key)..." id="brandSearchByAjax">
                                </div>
                            </div>
                            <div id="brandSerchAfterHideTable">
                                <table id="datatable-buttons" class="datatable-buttons table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>E-commerce_Name</th>
                                            <th>Brand Name</th>
                                            <th>Brand Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="setSerachBrands">
                                        @foreach ($brands as $brand)
                                        <tr>
                                            <td>{{ optional($brand->ecommerce)->ecom_name }}</td>
                                            <td>{{ $brand->brand_name_cats_eye }}</td>
                                            <td>
                                                <img src="{{ asset($brand->brand_image) }}" alt="..." height="100"
                                                    width="100">
                                            </td>
                                            <td>
                                                @if($employee && isset($employeePermision['permissions']['brand']['edit']))
                                                <button type="button" value="{{ $brand->id }}"
                                                    class="btn btn-success edit_brand_btn btn-sm">
                                                    <i class="fa fa-pencil-alt"></i></button>
                                                    @elseif(!$employee)


                                                    <button type="button" value="{{ $brand->id }}"
                                                        class="btn btn-success edit_brand_btn btn-sm">
                                                        <i class="fa fa-pencil-alt"></i></button>

                                                    @endif

                                                    @if($employee && isset($employeePermision['permissions']['brand']['delete']))
                                                        <a href="{{ route('role.brandnew.delete', [config('fortify.guard'), $brand->id]) }}"
                                                            class="btn btn-danger btn-sm" id="delete"><i
                                                            class="fa fa-trash"></i></a>
                                                    @elseif(!$employee)
                                                    <a href="{{ route('role.brandnew.delete', [config('fortify.guard'), $brand->id]) }}"
                                                            class="btn btn-danger btn-sm" id="delete"><i
                                                            class="fa fa-trash"></i></a>
                                                    @endif
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                            <div id="brandPagination">
                                {{ $brands->links() }}
                            </div>
                            <div class="table-responsive" id="BrandSerchBeforeHideTable">
                                <table id="basic-datatables" class="table  table-striped nowrap w-100" id="ajaxDataTableShowHide">
                                    <thead>
                                        <tr>
                                            <th>E-commerce_Name</th>
                                            <th>Brand Name</th>
                                            <th>Brand Image</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>


                                    <tbody id="setSearchDataInDataTable">
                                        <tr>
                                            <th>E-commerce_Name</th>
                                            <th>Brand Name</th>
                                            <th>Brand Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div> <!-- end card body-->

                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->
</div>
<!-- END wrapper -->


<!-- Begin page -->
<div id="wrapper">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="add-brand-container d-flex justify-content-between mb-2">
                                <h4 style="font-size: 24px;">Category List</h4>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 offset-lg-8">
                                    <label style="font-size: 13px; color: red; line-height: 1.2" for="prodictSearchWithAjax">Search By:Category Name</label>
                                    <input type="text" class="form-control" placeholder="Serach here ( Type and click enter key)..." id="categorySearchByAjax">
                                </div>
                            </div>
                            <div id="categorySerchAfterHideTable">
                                <table id="datatable-buttons-category"
                                    class="datatable-buttons table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Ecommerce_Name</th>
                                            <th>Category Name</th>
                                            <th>Category Image</th>
                                            <th>Category Icon</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="setSerachCategories">
                                        @foreach ($category as $categories)
                                        <tr>
                                            <td>{{ optional($categories->ecommerce)->ecom_name }}</td>
                                            <td>{{ $categories->category_name }}</td>
                                            <td>
                                                <img src="{{ asset($categories->category_image) }}" alt="..." height="100"
                                                    width="100">
                                            </td>
                                            <td>
                                                <img src="{{ asset($categories->category_icon) }}" alt="..." height="100"
                                                    width="100">
                                            </td>
                                            <td>

                                                @if($employee && isset($employeePermision['permissions']['category']['edit']))
                                                <button type="button" value="{{ $categories->id }}"
                                                    class="btn btn-warning category_edit_btn btn-sm">
                                                    <i class="fa fa-pencil-alt"></i> </button>







                                                    @elseif(!$employee)

                                                    @if($categories->status == 1)
                                                            <a  href="{{ route('role.category.CatDeactive', [config('fortify.guard'), $categories->id]) }}"
                                                                class="btn btn-success" title="Product Active Now">Active </a>
                                                        @else

                                                            <a href="{{ route('role.category.CatActive', [config('fortify.guard'), $categories->id]) }}"
                                                                class="btn btn-danger" title="Product Active Now">Deactive </a>


                                                        @endif



                                                    <button type="button" value="{{ $categories->id }}"
                                                        class="btn btn-warning category_edit_btn btn-sm">
                                                        <i class="fa fa-pencil-alt"></i></button>
                                                @endif
                                                @if( $employee  && isset(  $employeePermision['permissions']['category']['delete']))
                                                <a href="{{ route('role.category.delete', [config('fortify.guard'), $categories->id]) }}"
                                                    class="btn btn-danger btn-sm" id="delete"><i
                                                        class="fa fa-trash"></i> </a>

                                                @elseif(!$employee)

                                                <a href="{{ route('role.category.delete', [config('fortify.guard'), $categories->id]) }}"
                                                    class="btn btn-danger btn-sm" id="delete"><i
                                                        class="fa fa-trash"></i> </a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div id="categoriesPagination">
                                {{ $category->links() }}
                            </div>
                            <div class="table-responsive" id="categorySerchBeforeHideTable">
                                <table id="basic-datatables1" class="table  table-striped nowrap w-100" id="ajaxDataTableShowHide">
                                    <thead>
                                        <tr>
                                            <th>Ecommerce_Name</th>
                                            <th>Category Name</th>
                                            <th>Category Image</th>
                                            <th>Category Icon</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>


                                    <tbody id="setSearchDataInCategoryDataTable">
                                        <tr>
                                            <th>Ecommerce_Name</th>
                                            <th>Category Name</th>
                                            <th>Category Image</th>
                                            <th>Category Icon</th>
                                            <th>Action</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->
        </div> <!-- container -->
    </div> <!-- content -->
</div>
<!-- END wrapper -->



<!-- Start Content-->
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <h4 class="header-title"> Sub Category List</h4>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 offset-lg-8">
                            <label style="font-size: 13px; color: red; line-height: 1.2" for="prodictSearchWithAjax">Search By:Sub Category Name</label>
                            <input type="text" class="form-control" placeholder="Serach here ( Type and click enter key)..." id="subcategorySearchByAjax">
                        </div>
                    </div>
                    <div id="subcategorySerchAfterHideTable">
                        <table id="datatable-buttons-subcategory" class="datatable-buttons table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>E-commerce Name</th>
                                    <th>Category Name</th>
                                    <td>Sub Category Name</td>
                                    <th>Sub Category Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subcategory as $subcat)
                                <tr>
                                    {{-- <td>{{ $subcat['category']['id'] }}</td> --}}
                                    <td>{{ optional($subcat->ecommerce)->ecom_name }}</td>

                                    <td>
                                        {{ optional($subcat['category'])['category_name'] }}
                                    </td>
                                    <td>{{ $subcat->sub_category_name }}</td>
                                    <td>
                                        <img src="{{ asset($subcat->subcategory_image) }}" alt="..." height="100"
                                            width="100">
                                    </td>

                                    <td>
                                        @if($employee && isset($employeePermision['permissions']['subcategory']['edit']))
                                            <button type="button" value="{{ $subcat->id }}"
                                                class="btn btn-warning subcate_edit_btn btn-sm">
                                            <i class="fa fa-pencil-alt"></i></button>
                                        @elseif(!$employee)
                                            @if($subcat->status == 1)
                                                <button type="button" class="btn btn-info  btn-sm " onclick="activeDeactive(this)" data-name="subcategory-deactive" data-url="{{ route('role.subcategory.subCategoryActiveDeactive',[config('fortify.guard'), $subcat->id]) }}"> Active </button>
                                                @elseif ($subcat->status == 0)
                                                <button type="button" class="btn btn-danger btn-sm " onclick="activeDeactive(this)" data-name="subcategory-active" data-url="{{ route('role.subcategory.subCategoryActiveDeactive',[config('fortify.guard'), $subcat->id])  }}"> Deactive </button>
                                            @endif

                                            <button type="button" value="{{ $subcat->id }}"
                                            class="btn btn-warning subcate_edit_btn btn-sm">
                                            <i class="fa fa-pencil-alt"></i></button>


                                        @endif

                                        @if($employee && isset($employeePermision['permissions']['subcategory']['delete']))
                                            <a href="{{ route('role.subcategory.delete', [config('fortify.guard'), $subcat->id]) }}"
                                            class="btn btn-danger btn-sm" id="delete"><i class="fa fa-trash"></i></a>
                                        @elseif(!$employee)
                                            <a href="{{ route('role.subcategory.delete', [config('fortify.guard'), $subcat->id]) }}"
                                            class="btn btn-danger btn-sm" id="delete"><i class="fa fa-trash"></i></a>
                                        @endif
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div id="subcategoriesPagination">
                        {{ $subcategory->links() }}
                    </div>

                    <div class="table-responsive" id="subcategorySerchBeforeHideTable">
                        <table id="basic-datatables2" class="table  table-striped nowrap w-100" id="ajaxDataTableShowHide">
                            <thead>
                                <tr>
                                    <th>E-commerce Name</th>
                                    <th>Category Name</th>
                                    <td>Sub Category Name</td>
                                    <th>Sub Category Image</th>
                                    <th>Action</th>

                                </tr>
                            </thead>


                            <tbody id="setSearchDataInSubcategoryDataTable">
                                <tr>
                                    <th>E-commerce Name</th>
                                    <th>Category Name</th>
                                    <td>Sub Category Name</td>
                                    <th>Sub Category Image</th>
                                    <th>Action</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->

</div> <!-- container -->


<div class="content">
    <!-- Start Content-->
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <h4 class="header-title"> Sub Sub Category List</h4>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 offset-lg-8">
                                <label style="font-size: 13px; color: red; line-height: 1.2" for="prodictSearchWithAjax">Search By:Sub Sub-Category Name</label>
                                <input type="text" class="form-control" placeholder="Serach here ( Type and click enter key)..." id="subsubcategorySearchByAjax">
                            </div>
                        </div>
                        <div id="subsubcategorySerchAfterHideTable">
                        <table id="datatable-buttons-subsubcategory"
                            class="datatable-buttons table table-striped dt-responsive nowrap w-100">
                            <thead>

                                <tr>
                                    <th>E-commerce Name</th>
                                    <th>Category Name</th>
                                    <th>Sub Category Name </th>
                                    <th>Sub Sub Category Name</th>
                                    <th>Sub Sub Category Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subsubcategory as $subsubcat)
                                <tr>
                                    <td>{{ optional($subsubcat->ecommerce)->ecom_name }}</td>
                                    <td>{{ optional($subsubcat['category'])['category_name'] }}</td>
                                    <td>{{ optional($subsubcat['subcategory'])['sub_category_name'] }}</td>
                                    <td>{{ $subsubcat->subsubcategory_name }}</td>
                                    <td>
                                        <img src="{{ asset($subsubcat->subsubcategory_image) }}" alt="..." height="100"
                                            width="100">
                                    </td>
                                    <td>

                                    @if($employee && isset($employeePermision['permissions']['subsubcategory']['edit']))
                                        <button type="button" value="{{ $subsubcat->id }}"
                                            class="btn btn-warning subsubcate_edit_btn btn-sm">
                                            <i class="fa fa-pencil-alt"></i></button>
                                    @elseif(!$employee)

                                        @if($subsubcat->status == 1)
                                            <button type="button" class="btn btn-info  btn-sm " onclick="activeDeactive(this)" data-name="subsubcategory-deactive" data-url="{{ route('role.subsubcategory.subSubCategoryActiveDeactive',[config('fortify.guard'), $subsubcat->id]) }}"> Active </button>
                                            @elseif ($subsubcat->status == 0)
                                            <button type="button" class="btn btn-danger btn-sm " onclick="activeDeactive(this)" data-name="subsubcategory-active" data-url="{{ route('role.subsubcategory.subSubCategoryActiveDeactive',[config('fortify.guard'), $subsubcat->id])  }}"> Deactive </button>
                                        @endif

                                        <button type="button" value="{{ $subsubcat->id }}"
                                            class="btn btn-warning subsubcate_edit_btn btn-sm">
                                            <i class="fa fa-pencil-alt"></i></button>
                                    @endif

                                    @if($employee && isset($employeePermision['permissions']['subsubcategory']['delete']))
                                        <a href="{{ route('role.subsubcategory.delete', [config('fortify.guard'), $subsubcat->id]) }}"
                                            class="btn btn-danger btn-sm" id="delete"><i class="fa fa-trash"></i></a>
                                    @elseif(!$employee)
                                        <a href="{{ route('role.subsubcategory.delete', [config('fortify.guard'), $subsubcat->id]) }}"
                                            class="btn btn-danger btn-sm" id="delete"><i class="fa fa-trash"></i></a>
                                    @endif

                                    </td>

                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        </div>
                        <div id="subsubcategoriesPagination">
                            {{ $subsubcategory->links() }}
                        </div>
                        <div class="table-responsive" id="subsubcategorySerchBeforeHideTable">
                            <table id="basic-datatables3" class="table  table-striped nowrap w-100" id="ajaxDataTableShowHide">
                                <thead>
                                    <tr>
                                        <th>E-commerce Name</th>
                                        <th>Category Name</th>
                                        <th>Sub Category Name </th>
                                        <th>Sub Sub Category Name</th>
                                        <th>Sub Sub Category Image</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>


                                <tbody id="setSearchDataInSubsubcategoryDataTable">
                                    <tr>
                                        <th>E-commerce Name</th>
                                        <th>Category Name</th>
                                        <th>Sub Category Name </th>
                                        <th>Sub Sub Category Name</th>
                                        <th>Sub Sub Category Image</th>
                                        <th>Action</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

    </div> <!-- container -->
</div> <!-- content -->

@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    const userId= {{Auth::user()->id}} ;
    $('#BrandSerchBeforeHideTable').css('display','none');
    $('#categorySerchBeforeHideTable').css('display','none');
    $('#subcategorySerchBeforeHideTable').css('display','none');
    $('#subsubcategorySerchBeforeHideTable').css('display','none');
    //search brand
    let brandsearch = document.getElementById('brandSearchByAjax');
        brandsearch.addEventListener('keyup',function(e){

        let value = brandsearch.value;
        if(e.keyCode === 13){
            	value = value.trim();
            if(value[0] == '#'){
                value = value.substring(1);
            }

            $('.serach_loader').css('display','flex');

            $.ajax({
                url: `/admin/brand/search/ajax/${userId}/${value}`,
                type: "get",
                // data:{ search:val.value}
                dataType: "json",
                success: function(data) {
                    $('#brandSerchAfterHideTable').css('display','none');
                    $('#brandPagination .pagination').css('display','none');
                    $('#BrandSerchBeforeHideTable').css('display','block');

                    $('#setSerachBrands').html('');
                    $('#setSearchDataInDataTable').html('')

                    $.fn.dataTable.ext.errMode = 'none';

                    $('#basic-datatables').on( 'error.dt', function ( e, settings, techNote, message ) {
                    // console.log( 'An error has been reported by DataTables: ', message );
                    } ) .DataTable();

                    var dataTable = $("#basic-datatables").DataTable();
                    dataTable.clear().draw();

                    if(data.brands.length >= 1){



                        $.each(data.brands, function(key, value) {


                            let permissionsEditDelete ='';

                            if(data.employee && data.employeePermision && data.employeePermision.permissions && data.employeePermision.permissions.product && data.employeePermision.permissions.product.edit )  {
                                permissionsEditDelete+= ` <button type="button" value="${ value.id }"
                                                    class="btn btn-success edit_brand_btn btn-sm">
                                                    <i class="fa fa-pencil-alt"></i></button>`;
                            }else if(!data.employee){

                                permissionsEditDelete+=` <button type="button" value="${ value.id }"
                                                    class="btn btn-success edit_brand_btn btn-sm">
                                                    <i class="fa fa-pencil-alt"></i></button> `;
                            }


                            if(data.employee && data.employeePermision && data.employeePermision.permissions && data.employeePermision.permissions.product && data.employeePermision.permissions.product.delete ) {

                                permissionsEditDelete+= `<a href="/admin/category/delete/${value.id}"
                                class="btn btn-danger mx-2" title="Delete Data" id="delete">
                                <i class="fa fa-trash"></i>
                            </a>`;

                            }else if(!data.employee){

                                permissionsEditDelete+=`<a href="/admin/category/delete/${value.id}"
                                class="btn btn-danger mx-2" title="Delete Data" id="delete">
                                <i class="fa fa-trash"></i>
                            </a>`;

                            }
                            permissionsEditDelete+= `<button class="btn btn-blue viewBtn" title="Edit Product" productview_id="${value.id}">
                                                    <i class="fas fa-eye"></i></button>`;

                            let ecomName;
                            let brandImage;



                            $('.serach_loader').css('display','none');
                            dataTable.row.add([
                                value.ecom_name,
                                value.brand_name_cats_eye,
                                "<img src='/"+ value.brand_image +"'  style='width: 60px; height: 50px;'> ",
                                permissionsEditDelete


                        ]).draw();
                    });
                    }else{
                        $('.serach_loader').css('display','none');
                        Swal.fire({
                          icon: 'info',
                          title: 'Oops...',
                          text: 'No Brand Found!',
                        });
                    }


                },
                error: function (error) {
                     $('.serach_loader').css('display','none');
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        });
                }

            });
        }
    });
    //search category

    let categorySearch = document.getElementById('categorySearchByAjax');
    categorySearch.addEventListener('keyup',function(e){
        let value = categorySearch.value;
        if(e.keyCode === 13){
            	value = value.trim();
            if(value[0] == '#'){
                value = value.substring(1);
            }
            $('.serach_loader').css('display','flex');

            $.ajax({
                url: `/admin/category/search/ajax/${userId}/${value}`,
                type: "get",
                // data:{ search:val.value}
                dataType: "json",
                success: function(data) {
                    $('#categorySerchAfterHideTable').css('display','none');
                    $('#categoriesPagination .pagination').css('display','none');
                    $('#categorySerchBeforeHideTable').css('display','block');

                    $('#setSerachCategories').html('');
                    $('#setSearchDataInCategoryDataTable').html('')

                    $.fn.dataTable.ext.errMode = 'none';

                    $('#basic-datatables1').on( 'error.dt', function ( e, settings, techNote, message ) {
                    // console.log( 'An error has been reported by DataTables: ', message );
                    } ) .DataTable();

                    var dataTable = $("#basic-datatables1").DataTable();
                    dataTable.clear().draw();

                    if(data.categories.length >= 1){

                        $.each(data.categories, function(key, value) {



                            let permissionsEditDelete ='';
                            if(value.status == 1)  {
                                permissionsEditDelete+=` <a  href="/admin/category/cat/product/update/Active/all/${value.id}"
                                                                class="btn btn-success" title="Product Active Now">Active </a> `;
                            }else {
                                permissionsEditDelete+= ` <a href="/admin/category/cat/product/update/Deactive/all/${value.id}"
                                                                class="btn btn-danger" title="Product Active Now">Deactive </a> `;
                            }

                            if(data.employee && data.employeePermision && data.employeePermision.permissions && data.employeePermision.permissions.product && data.employeePermision.permissions.product.edit )  {
                                permissionsEditDelete+= ` <button type="button" value="${ value.id }"
                                                        class="btn btn-warning category_edit_btn btn-sm">
                                                        <i class="fa fa-pencil-alt"></i></button> `;
                            }else if(!data.employee){

                                permissionsEditDelete+=` <button type="button" value="${ value.id }"
                                                        class="btn btn-warning category_edit_btn btn-sm">
                                                        <i class="fa fa-pencil-alt"></i></button> `;
                            }

                            if(data.employee && data.employeePermision && data.employeePermision.permissions && data.employeePermision.permissions.product && data.employeePermision.permissions.product.delete ) {

                                permissionsEditDelete+= `<a href="/admin/category/delete/${value.id}"
                                class="btn btn-danger mx-2" title="Delete Data" id="delete">
                                <i class="fa fa-trash"></i>
                            </a>`;

                            }else if(!data.employee){

                                permissionsEditDelete+=`<a href="/admin/category/delete/${value.id}"
                                class="btn btn-danger mx-2" title="Delete Data" id="delete">
                                <i class="fa fa-trash"></i>
                            </a>`;

                            }






                            $('.serach_loader').css('display','none');
                            dataTable.row.add([
                                value.ecom_name,
                                value.category_name,
                                "<img src='/"+ value.category_image +"'  style='width: 60px; height: 50px;'> ",
                                "<img src='/"+ value.category_icon +"'  style='width: 60px; height: 50px;'> ",
                                permissionsEditDelete


                        ]).draw();
                    });
                    }else{
                        $('.serach_loader').css('display','none');
                        Swal.fire({
                          icon: 'info',
                          title: 'Oops...',
                          text: 'No Category Found!',
                        });
                    }


                },
                error: function (error) {
                     $('.serach_loader').css('display','none');
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        });
                }

            });

        }
    })

    // for sub category name search
    let subcategorySearch  = document.getElementById('subcategorySearchByAjax');
    subcategorySearch.addEventListener('keyup',function(e){
        let value = subcategorySearch.value;
        if(e.keyCode === 13){
            	value = value.trim();
            if(value[0] == '#'){
                value = value.substring(1);
            }

            $('.serach_loader').css('display','flex');

            $.ajax({
                url: `/admin/subcategory/search/ajax/${userId}/${value}`,
                type: "get",
                // data:{ search:val.value}
                dataType: "json",
                success: function(data) {
                    $('#subcategorySerchAfterHideTable').css('display','none');
                    $('#subcategoriesPagination .pagination').css('display','none');
                    $('#subcategorySerchBeforeHideTable').css('display','block');

                    $('#setSerachSubcategories').html('');
                    $('#setSearchDataInSubCategoryDataTable').html('')

                    $.fn.dataTable.ext.errMode = 'none';

                    $('#basic-datatables2').on( 'error.dt', function ( e, settings, techNote, message ) {
                    // console.log( 'An error has been reported by DataTables: ', message );
                    } ) .DataTable();

                    var dataTable = $("#basic-datatables2").DataTable();
                    dataTable.clear().draw();

                    if(data.subcategories.length >= 1){

                        $.each(data.subcategories, function(key, value) {



                            let permissionsEditDelete ='';
                            if(value.status == 1)  {
                                permissionsEditDelete+=`
                                <button type="button" class="btn btn-info  btn-sm " onclick="activeDeactive(this)" data-name="subcategory-deactive" data-url="/admin/subcategory/active-deactive-subcategory/${value.id}"> Active </button>
                                 `;
                            }else {
                                permissionsEditDelete+= `
                                <button type="button" class="btn btn-danger btn-sm " onclick="activeDeactive(this)" data-name="subcategory-active" data-url="/admin/subcategory/active-deactive-subcategory/${value.id}"> Deactive </button>
                                 `;
                            }

                            if(data.employee && data.employeePermision && data.employeePermision.permissions && data.employeePermision.permissions.product && data.employeePermision.permissions.product.edit )  {
                                permissionsEditDelete+= ` <button type="button" value="${ value.id }"
                                        class="btn btn-warning subcate_edit_btn btn-sm">
                                        <i class="fa fa-pencil-alt"></i></button> `;
                            }else if(!data.employee){

                                permissionsEditDelete+=` <button type="button" value="${ value.id }"
                                        class="btn btn-warning subcate_edit_btn btn-sm">
                                        <i class="fa fa-pencil-alt"></i></button>`;
                            }

                            if(data.employee && data.employeePermision && data.employeePermision.permissions && data.employeePermision.permissions.product && data.employeePermision.permissions.product.delete ) {

                                permissionsEditDelete+= ` <a href="/admin/subcategory/delete/${value.id}"
                                        class="btn btn-danger btn-sm" id="delete"><i class="fa fa-trash"></i></a> `;

                            }else if(!data.employee){

                                permissionsEditDelete+=` <a href="/admin/subcategory/delete/${value.id}"
                                        class="btn btn-danger btn-sm" id="delete"><i class="fa fa-trash"></i></a>`;

                            }



                            $('.serach_loader').css('display','none');
                            dataTable.row.add([
                                value.ecom_name,
                                value.category_name,
                                value.sub_category_name,
                                "<img src='/"+ value.subcategory_image +"'  style='width: 60px; height: 50px;'> ",
                                permissionsEditDelete


                        ]).draw();
                    });
                    }else{
                        $('.serach_loader').css('display','none');
                        Swal.fire({
                          icon: 'info',
                          title: 'Oops...',
                          text: 'No Subcategory Found!',
                        });
                    }


                },
                error: function (error) {
                     $('.serach_loader').css('display','none');
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        });
                }

            });

        }
    })

    // for sub sub category name search
    let subsubcategorySearch  = document.getElementById('subsubcategorySearchByAjax');
    subsubcategorySearch.addEventListener('keyup',function(e){
        let value = subsubcategorySearch.value;
        if(e.keyCode === 13){
            	value = value.trim();
            if(value[0] == '#'){
                value = value.substring(1);
            }

            $('.serach_loader').css('display','flex');

            $.ajax({
                url: `/admin/subsubcategory/search/ajax/${userId}/${value}`,
                type: "get",
                // data:{ search:val.value}
                dataType: "json",
                success: function(data) {
                    $('#subsubcategorySerchAfterHideTable').css('display','none');
                    $('#subsubcategoriesPagination .pagination').css('display','none');
                    $('#subsubcategorySerchBeforeHideTable').css('display','block');

                    $('#setSerachSubsubcategories').html('');
                    $('#setSearchDataInSubsubCategoryDataTable').html('')

                    $.fn.dataTable.ext.errMode = 'none';

                    $('#basic-datatables3').on( 'error.dt', function ( e, settings, techNote, message ) {
                    // console.log( 'An error has been reported by DataTables: ', message );
                    } ) .DataTable();

                    var dataTable = $("#basic-datatables3").DataTable();
                    dataTable.clear().draw();

                    if(data.subsubcategories.length >= 1){

                        $.each(data.subsubcategories, function(key, value) {



                            let permissionsEditDelete = '';
                            if(value.status == 1)  {
                                permissionsEditDelete+=`
                                <button type="button" class="btn btn-info  btn-sm " onclick="activeDeactive(this)" data-name="subsubcategory-deactive" data-url="/admin/subsubcategory/active-deactive-subsubcategory/${value.id}"> Active </button>
                                 `;
                            }else {
                                permissionsEditDelete+= `
                                <button type="button" class="btn btn-danger btn-sm " onclick="activeDeactive(this)" data-name="subsubcategory-active" data-url="/admin/subsubcategory/active-deactive-subsubcategory/${value.id}"> Deactive </button>
                                 `;
                            }

                            if(data.employee && data.employeePermision && data.employeePermision.permissions && data.employeePermision.permissions.product && data.employeePermision.permissions.product.edit )  {
                                permissionsEditDelete+= `
                                        <button type="button" value="${ value.id }"
                                            class="btn btn-warning subsubcate_edit_btn btn-sm">
                                            <i class="fa fa-pencil-alt"></i></button>`;
                            }else if(!data.employee){

                                permissionsEditDelete+=` <button type="button" value="${ value.id }"
                                            class="btn btn-warning subsubcate_edit_btn btn-sm">
                                            <i class="fa fa-pencil-alt"></i></button>`;
                            }

                            if(data.employee && data.employeePermision && data.employeePermision.permissions && data.employeePermision.permissions.product && data.employeePermision.permissions.product.delete ) {

                                permissionsEditDelete+= ` <a href="/admin/subsubcategory/delete/${value.id}"
                                        class="btn btn-danger btn-sm" id="delete"><i class="fa fa-trash"></i></a> `;

                            }else if(!data.employee){

                                permissionsEditDelete+=` <a href="/admin/subsubcategory/delete/${value.id}"
                                        class="btn btn-danger btn-sm" id="delete"><i class="fa fa-trash"></i></a>`;

                            }



                            $('.serach_loader').css('display','none');
                            dataTable.row.add([
                                value.ecom_name,
                                value.category_name,
                                value.sub_category_name,
                                value.subsubcategory_name,
                                "<img src='/"+ value.subsubcategory_image +"'  style='width: 60px; height: 50px;'> ",
                                permissionsEditDelete


                        ]).draw();
                    });
                    }else{
                        $('.serach_loader').css('display','none');
                        Swal.fire({
                          icon: 'info',
                          title: 'Oops...',
                          text: 'No Sub-subcategory Found!',
                        });
                    }


                },
                error: function (error) {
                     $('.serach_loader').css('display','none');
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        });
                }

            });

        }
    })


</script>


<script>

    function activeDeactive(value){
        let names = value.getAttribute('data-name');
        let text= '';
        let confirmBtn='';
        let  url = value.getAttribute('data-url');
        let status;

            if(names === 'category-deactive'){
                text ="You want to de-active this category! If you deactive this category, all product under this category will be hide from your website. ";
                confirmBtn ='Yes, De-active it!'
                status = 0;
            }else if(names === 'category-active'){
                text = 'You want to active this category!';
                confirmBtn ='Yes, Active it!';
                status = 1;
            }else if(names === 'subcategory-deactive'){
                text ="You want to de-active this subcategory! If you deactive this subcategory, all product under this subcategory will be hide from your website. ";
                confirmBtn ='Yes, De-active it!'
                status = 0;
            }else if(names === 'subcategory-active'){
                text = 'You want to active this category!';
                confirmBtn ='Yes, Active it!';
                status = 1;
            }else if(names === 'subsubcategory-deactive'){
                text ="You want to de-active this sub subcategory! If you deactive this sub subcategory, all product under this subcategory will be hide from your website. ";
                confirmBtn ='Yes, De-active it!'
                status = 0;
            }else if(names === 'subsubcategory-active'){
                text = 'You want to active this category!';
                confirmBtn ='Yes, Active it!';
                status = 1;
            }


            $(document).ready(function(){

                    Swal.fire({
                            title: 'Are you sure?',
                            text: text,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: confirmBtn,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                    url: url,
                                    type: 'POST',
                                    data:{
                                        "_token": "{{ csrf_token() }}",
                                        'status':status
                                    },

                                    dataType : 'json',
                                    success : function(res){
                                        Swal.fire( 'Success!', res.success, 'success')
                                        setTimeout(function(){
                                            window.location.reload(1);
                                        }, 2000);
                                    },
                                    error : function(res){
                                        Swal.fire( 'Failed!', 'Somethung went wrong.', 'error')
                                    },
                            });
                        } else {
                            Swal.fire('Safe Now!','Your imaginary file is safe :)', 'info')
                        }
                    });


            });


    }


</script>


<script>

    // for editing data using ajax
            $(document).on('click', '.editBtn', function() {
                var edit_id = $(this).val();
                $('#edit-ecommerce-modal').modal('show');
                $.ajax({
                    type: "GET",
                    url: `/{{ config('fortify.guard') }}/listbrandCategory/ecommercename/edit/${edit_id}`,
                    success: function(response) {
                        console.log(response);
                        $('#edit_ecom_name').val(response.ecom.ecom_name);
                        $('#edit_ecom_id').val(edit_id);
                    }
                    // }
                })
            });
            // for update
            $(document).on('submit', '#UpdateEcommerceForm', function(e) {
            e.preventDefault();
            var ecom_id = $('#edit_ecom_id').val();
            let EditFormData = new FormData($('#UpdateEcommerceForm')[0]);
            // Axios Update
            axios.post(`/{{ config('fortify.guard') }}/listbrandCategory/ecommercename/update/${ecom_id}`, EditFormData)
            .then(response => {
            if (response.status == 400) {
            // $('#error_name').text(response.errors.brand_name_cats_eye);
            // $('#error_image').text(response.errors.brand_image);

            } else {
            toastr.success(" {{ Session::get('message') }} ");
            location.reload();
            $('#edit-ecommerce-modal').modal('hide');
            }
            })
            }); //update end

        // });

        // Brand Edit
        $(document).on('click', '.edit_brand_btn', function() {
            console.log("okk");
            var brand_id = $(this).val();
            $('#EditBrandModal').modal('show');
            $.ajax({
                type: "GET",
                url: `/{{ config('fortify.guard') }}/brandnew/edit/${brand_id}`,
                success: function(response) {
                console.log(response);
                $('#cat').val(response.brand.brand_name_cats_eye);
                $('#ecommerce_edit_id').val(response.brand.ecom_id);
                $('#edit_brand_id').val(brand_id);
                }

            })
        });
        // Brand update
        $(document).on('submit', '#UpdateBrandForm', function(e) {
            e.preventDefault();
            var brand_id = $('#edit_brand_id').val();
            let EditFormData = new FormData($('#UpdateBrandForm')[0]);
            // Axios Update
            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

            $.ajax({
                type: "POST",
                data:EditFormData,
                url: `/{{ config('fortify.guard') }}/brandnew/update/${brand_id}`,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status == 400) {

                    }
                    else
                    {
                        toastr.success(" {{ Session::get('message') }} ");
                        $('#EditBrandModal').modal('hide');
                    }
                },
                error:function(e)
                {
                    $('#error_brand_name').text(e.responseJSON.errors.brand_name_cats_eye);
                    $('#error_s_ecom_id').text(e.responseJSON.errors.ecom_id);
                    $('#error_image').text(e.responseJSON.errors.brand_image);
                }
            })


        }); //update end

        // Category Edit
        $(document).on('click', '.category_edit_btn', function() {
            console.log("okk");
            var cat_id = $(this).val();
            console.log(cat_id);
            $('#EditCategoryModal').modal('show');
            $.ajax({
                type: "GET",
                url: `/{{ config('fortify.guard') }}/category/edit/${cat_id}`,
                success: function(response) {
                console.log(response);
                $('#category_name').val(response.category.category_name);
                $('#cat_ecommerce_edit_id').val(response.category.ecom_id);
                $('#edit_category_id').val(cat_id);
                }
            })
        });

        // Category Update
        $(document).on('submit', '#UpdateCategoryForm', function(e) {
            e.preventDefault();
            var cat_id = $('#edit_category_id').val();
            let EditFormData = new FormData($('#UpdateCategoryForm')[0]);
            // Axios Update
            axios.post(`/{{ config('fortify.guard') }}/category/update/${cat_id}`, EditFormData)
            .then(response => {
                if (response.status == 400) {
                    $('#cat_error_name').text(response.errors.category_name);
                    $('#cat_error_ecom_name').text(response.errors.ecom_id);
                } else {
                    console.log(response);
                    toastr.success(" {{ Session::get('message') }} ");
                    location.reload();
                    $('#EditCategoryModal').modal('hide');
                }
            })
        }); //update end

        //subcategory edit
        $(document).on('click', '.subcate_edit_btn', function() {
         console.log("okk");
            var cat_id = $(this).val();
            console.log(cat_id);
            $('#EditSubCategoryModal').modal('show');
                $.ajax({
                type: "GET",
                url: `/{{ config('fortify.guard') }}/subcategory/edit/${cat_id}`,
                success: function(response) {
                console.log(response);
                    $('#subcat_ecommerce_edit_id').val(response.subcategory.ecom_id);
                    $('#category_id').val(response.subcategory.category_id);
                    $('#sub_category_name').val(response.subcategory.sub_category_name);
                    // $("#subcategory_image").html(
                    // `<img src="storage/upload/subcategory/${response.subcategory_image}" width="100" class="img-fluid img-thumbnail">`);
                    // $('#category_id').val(response.subcategory.category_id);
                    $('#edit_subcategory_id').val(cat_id);
                    }
                })
        });

        //subcategory Update
        $(document).on('submit', '#UpdateSubCategoryForm', function(e) {
        e.preventDefault();
        var cat_id = $('#edit_subcategory_id').val();
        let EditFormData = new FormData($('#UpdateSubCategoryForm')[0]);
        // Axios Update
        axios.post(`/{{ config('fortify.guard') }}/subcategory/update/${cat_id}`, EditFormData)
        .then(response => {

            if (response.status == 422) {
            $('#subcat_error_ecom_name').text(response.errors.ecom_id);
            $('#subcat_error_name').text(response.errors.sub_category_name);
            } else {
            console.log(response);
            toastr.success(response.message);
            location.reload();
            $('#EditSubCategoryModal').modal('hide');
            }
        // console.log(response);
        // toastr.success(response.message);
        // location.reload();
        //     $('#EditSubCategoryModal').modal('hide');
            })
        }); //update end

        //Sub SUb ccate edit

        $(document).on('click', '.subsubcate_edit_btn', function(e) {
            console.log("okk");
            var cat_id = $(this).val();
            console.log(cat_id);
            $('#EditSubSubCategoryModal').modal('show');
            $.ajax({
            type: "GET",
            url: `/{{ config('fortify.guard') }}/subsubcategory/edit/${cat_id}`,
                success: function(response) {
                    console.log(response);
                    $("#subsubcat_ecommerce_edit_id").val(response.subsubcategory.ecom_id);
                    $("#subsub_category_id").val(response.subsubcategory.category_id);
                    $("#subcategoryy_id").val(response.subsubcategory.subcategory_id);
                    $("#subsubcategory_name").val(response.subsubcategory.subsubcategory_name);
                    $("#edit_subsubcategory_id").val(cat_id);
                }
            });
        });
        // Update
        $(document).on('submit', '#UpdateSubSubCategoryForm', function(e) {
            e.preventDefault();
            var cat_id = $('#edit_subsubcategory_id').val();
            let EditFormData = new FormData($('#UpdateSubSubCategoryForm')[0]);
            // Axios Update
            axios.post(`/{{ config('fortify.guard') }}/subsubcategory/update/${cat_id}`, EditFormData)
            .then(response => {
            console.log(response);
            if (response.status == 400) {
                $('#error_ss_ecom_id').text(response.errors.ecom_id);
                $('#error_sub_category_id').text(response.errors.subcategory_id);
                $('#error_sub_sub_category_name').text(response.errors
                .subsubcategory_name);
                $('#error_sub_sub_category_image').text(response.errors.subsubcategory_image);

            } else {
                $('#EditSubSubCategoryModal').modal('hide');
                toastr.success(response.data.message);
            }
            // // location.reload();
            // $('#EditSubSubCategoryModal').modal('hide');
            // toastr.success(response.data.message);
            })
        }); //update end

</script>




@endsection
