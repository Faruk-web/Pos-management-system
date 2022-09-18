@extends('admin.admin_master')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />

<style>
    .date-selector {
        position: relative;
    }

    content-page .date-selector>input[type=date] {
        text-indent: -500px;
    }
</style>
@endsection

@section('main-content')

<div class="content" id="">

    <!-- Start Content-->
    <div class="container-fluid pt-4">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <h4 class="page-title">Edit Employee</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="employee-container-wrapper">
        <div class="card">
            <div class="card-body">
                <form action="{{route('role.employee.update',config('fortify.guard'))}}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{ $employee->id }}">
                    <input type="hidden" name="old_img" value="{{ $employee->employee_img}}">
                    <input type="hidden" name="reference_id" value="{{ optional($employeereference)->id }}">

                    <div class="employee-container">                       
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="">
                <label for="name" class="form-label">Employee name<b
                        style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                <div class="controls">
                    <input type="text" value="{{$employee->employee_name}}" id="employee_name" name="employee_name"
                        placeholder="Name" class="form-control">
                    @error('employee_name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="">
                <label for="father-name" class="form-label">Employee Father Name <b
                        style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                <div class="controls">
                    <input type="text" value="{{$employee->employee_fathers_name}}" id="employee_fathers_name"
                        placeholder="Fathers Name" name="employee_fathers_name" class="form-control">
                    @error('employee_fathers_name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="">
                <label for="mother-name" class="form-label">Employee Mother Name <b
                        style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                <div class="controls">
                    <input type="text" value="{{$employee->employee_mother_name}}" id="employee_mother_name"
                        placeholder=" Mother Name" name="employee_mother_name" class="form-control">
                    @error('employee_mother_name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="">
                <label for="birth-day" class="form-label">Date Of Birth <b
                        style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                <div class="controls date-selector">

                    <div class="">
                        <input class="form-control " value="{{$employee->employee_date_of_birth}}" type="date"
                            name="employee_date_of_birth" dateformat="dd/mm/yy" />
                    </div>

                    <label for="birth-day" class="form-label">e.g DD/MM/YY</label>

                    @error('employee_date_of_birth')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="">
                <label for="employee-id" class="form-label">Employee Email Id <b
                        style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                <div class="controls">
                    <input type="email" value="{{$employee->email_id}}" id="email_id" placeholder="Email"
                        name="email_id" class="form-control">
                    @error('email_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="">
                <label for="phone" class="form-label">Employee Phone <b
                        style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                @php
                $getdata= $employee->employee_phone;
                $getdata1= $employeereference->reference_mobile_one;
                $getdata2= $employeereference->reference_mobile_num_two;
                $getdata3= $employeereference->reference_mobile_num_3;
                $getdata4= $employeereference->reference_mobile_num_4;
                $trimdata=trim($getdata,"+88");
                $trimdata1=trim($getdata1,"+88");
                $trimdata2=trim($getdata2,"+88");
                $trimdata3=trim($getdata3,"+88");
                $trimdata4=trim($getdata4,"+88");
                @endphp
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" name="defnum" id="basic-addon1">+88</span>
                    </div>
                    <input type="number" value="{{ $trimdata }}" class="form-control" placeholder="01*********"
                        name="employee_phone" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                @error('employee_phone')
                <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="">
                <label for="office-id" class="form-label">Employee Office Id <b
                        style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                <div class="controls">
                    <input type="text" value="{{$employee->employee_office_id}}" id="employee_office_id"
                        placeholder="Office Id" name="employee_office_id" class="form-control">
                    @error('employee_office_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="">
                <label for="dprt-name" class="form-label">Department Name <b
                        style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                <div class="controls">
                    <select id="department_id" name="department_id" class="form-select">
                        <option value=" ">Select Department Name</option>
                        @foreach ($departments as $department)
                        @if ($employee->department_id==$department->id)
                        <option value="{{$department->id}}" selected>
                            {{$department->department_name}}</option>
                        @else
                        <option value="{{$department->id}}">{{$department->department_name}}
                        </option>
                        @endif
                        @endforeach
                    </select>
                    @error('department_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="">
                <label for="image" class="form-label">Employee Profile Image <b
                        style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                <div class="controls">
                    <input type="file" value="{{ asset($employee->employee_img) }}" id="employee_photo"
                        name="employee_photo" class="form-control">
                    @error('employee_photo')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="">
                <label for="humanfd-datepicker" class="form-label">Employee Joining Date <b
                        style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                <div class="controls ">

                    <div class="">
                        <input class="form-control " value="{{$employee->employee_joing_date}}" type="date"
                            name="employee_joing_date" dateformat="dd/mm/yy" />
                    </div>
                    <label for="birth-day" class="form-label">e.g DD/MM/YY</label>
                    @error('employee_joing_date')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="">
                <label for="salary" class="form-label">Employee Salary <b
                        style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                <div class="controls">
                    <input type="number" id="employee_salary" value="{{$employee->employee_salary}}"
                        placeholder="Salary" name="employee_salary" class="form-control">
                    @error('employee_salary')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">

            <div class="">
                <label for="designation" class="form-label">Employee Designation <b
                        style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                <div class="controls">
                    <input type="text" id="designation" value="{{$employee->designation}}" placeholder="Designation"
                        class="form-control" name="designation">
                    @error('designation')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="">
                <label for="dprt-name" class="form-label">Employee Status <b
                        style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                <div class="controls">
                    <select id="employee_status" name="employee_status" class="form-control">
                        <option value="1">Select Employee Stutus</option>
                        <option {{($employee->employee_status==1? 'selected':'') }} value="1">Active
                        </option>
                        <option {{($employee->employee_status==0? 'selected':'') }} value="0">In
                            Active </option>
                    </select>
                    @error('employee_status')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="">
                <label for="p-address" class="form-label">Employee Present Address <b
                        style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                <div class="controls">
                    <textarea id="employee_present_address" class="form-control" name="employee_present_address"
                        rows="4" placeholder="Present Address"
                        cols="70">{{$employee->employee_present_address}}</textarea>
                    @error('employee_present_address')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="">
                <label for="p-address" class="form-label">Employee Permanent Address <b
                        style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                <div class="controls">
                    <textarea id="employee_permanent_address" class="form-control" name="employee_permanent_address"
                        rows="4" placeholder="Permanent Address">{{$employee->employee_permanent_address}}</textarea>

                    @error('employee_permanent_address')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </div>
    </div>
    <div class="employee-reference-wrapper">
        <h4 class="">#Reference 1 </h4>
        <div class="row">
            <div class="col-lg-3">
                <div class="">
                    <label for="name" class="form-label">Reference name<b
                            style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                    <input type="text" class="form-control" name="reference_name_one"
                        value="{{optional($employeereference)->reference_name_one  }}" placeholder="Name" />
                    @error('reference_name_one')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-3">
                <div class="">
                    <label for="name" class="form-label">Reference Mobile Number<b
                            style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" name="defnum" id="basic-addon1">+88</span>
                        </div>
                        <input type="number" class="form-control" placeholder="01*********" value="{{$trimdata1}}"
                            name="reference_mobile_one" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    @error('reference_mobile_one')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-3">
                <div class="">
                    <label for="name" class="form-label">Reference Relationship<b
                            style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                    <input type="text" class="form-control" name="reference_relationship_one"
                        value="{{optional($employeereference)->reference_relationship_one  }}"
                        placeholder="Relationship" />
                    @error('reference_relationship_one')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-3">
                <div class="">
                    <label for="dprt-name" class="form-label">Reference Address<b
                            style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                    <textarea id="p-address" class="form-control" placeholder="Address" name="reference_address_one"
                        rows="4" col="40">{{optional($employeereference)->reference_address_one }}</textarea>
                    @error('reference_address_one')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="employee-reference-wrapper">
        <h4 class="">#Reference 2</h4>
        <div class="row">
            <div class="col-lg-3">
                <div class="">
                    <label for="name" class="form-label">Reference name<b
                            style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                    <input type="text" name="reference_name_two" class="form-control"
                        value="{{optional($employeereference)->reference_name_two  }}" placeholder="Name" />
                    @error('reference_name_two')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-3">
                <div class="">
                    <label for="name" class="form-label">Reference Mobile Number<b
                            style="color:red; font-weight:bold;font-size: 18px">**</b></label>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" name="defnum" id="basic-addon1">+88</span>
                        </div>
                        <input type="number" class="form-control" placeholder="01*********" value="{{$trimdata2}}"
                            name="reference_mobile_num_two" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    @error('reference_mobile_num_two')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-3">
                <div class="">
                    <label for="name" class="form-label">Reference Relationship<b
                            style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                    <input type="text" class="form-control" placeholder="Relationship"
                        value="{{optional($employeereference)->reference_relationship_two  }}"
                        name="reference_relationship_two" />
                    @error('reference_relationship_two')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-3">
                <div class="">
                    <label for="dprt-name" class="form-label">Reference Address<b
                            style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                    <textarea id="p-address" class="form-control" placeholder="Address" name="reference_address_two"
                        rows="4" col="40">{{ optional($employeereference)->reference_address_two }}</textarea>
                    @error('reference_address_two')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>


        </div>
    </div>
    <div class="employee-reference-wrapper">
        <h4 class="">#Reference 3</h4>
        <div class="row">
            <div class="col-lg-3">
                <div class="">
                    <label for="name" class="form-label">Reference name</label>
                    <input type="text" class="form-control" name="reference_name_3"
                        value="{{optional($employeereference)->reference_name_3  }}" placeholder="Name" />
                    <div class="invalid-feedback">
                        please enter your Reference name
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="">
                    <label for="name" class="form-label">Reference Mobile Number</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" name="defnum" id="basic-addon1">+88</span>
                        </div>
                        <input type="number" class="form-control" placeholder="01*********" value="{{$trimdata3}}"
                            name="reference_mobile_num_3" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    @error('reference_mobile_num_3')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-3">
                <div class="">
                    <label for="name" class="form-label">Reference Relationship</label>
                    <input type="text" class="form-control" placeholder="Relationship"
                        value="{{optional($employeereference)->reference_relationship_3  }}"
                        name="reference_relationship_3" />
                    <div class="invalid-feedback">
                        please enter your Reference Relationship
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="">
                    <label for="dprt-name" class="form-label">Reference Address</label>
                    <textarea id="p-address" class="form-control" placeholder="Address" name="reference_address_3"
                        rows="4" col="40">{{ optional($employeereference)->reference_address_3 }}</textarea>
                    <div class="invalid-feedback">
                        please write your Reference address
                    </div>
                </div>
            </div>


        </div>
    </div>
    <div class="employee-reference-wrapper">
        <h4 class="">#Reference 4</h4>
        <div class="row">
            <div class="col-lg-3">
                <div class="">
                    <label for="name" class="form-label">Reference name</label>
                    <input type="text" class="form-control" name="reference_name_4"
                        value="{{optional($employeereference)->reference_name_4  }}" placeholder="Name" />
                    <div class="invalid-feedback">
                        please enter your Reference name
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="">
                    <label for="name" class="form-label">Reference Mobile Number</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" name="defnum" id="basic-addon1">+88</span>
                        </div>
                        <input type="number" class="form-control" placeholder="01*********" value="{{$trimdata4}}"
                            name="reference_mobile_num_4" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    @error('reference_mobile_num_4')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-3">
                <div class="">
                    <label for="name" class="form-label">Reference Relationship</label>
                    <input type="text" class="form-control" placeholder="Relationship"
                        value="{{optional($employeereference)->reference_relationship_4  }}"
                        name="reference_relationship_4" />
                    <div class="invalid-feedback">
                        please enter your Reference Relationship
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="">
                    <label for="dprt-name" class="form-label">Reference Address</label>
                    <textarea class="form-control" placeholder="Address" name="reference_address_4" value="" rows="4"
                        col="40">{{ optional($employeereference)->reference_address_4 }}</textarea>
                    <div class="invalid-feedback">
                        please write your Reference address
                    </div>
                </div>
            </div>
        </div> 
        <!-- row end-->
<button class="btn btn-success" type="submit">Update Employee</button>
</form>



 <div class="row">
            <div class="col-lg-12">
                <div class="box bt-3 border-info">
                    <div class="box-header">
                        <h4 class="box-title text-center" style="color:red">Employee Multiple File <strong>Update</strong></h4>
                    </div>
                    <form method="post" action="{{ route('role.update_employee_img', config('fortify.guard')) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row row-sm m-0 p-0">
                            <div class="col-lg-3 p-0">
                                {{-- <div class="mb-3 row m-0 p-0">
                                    <div class="col-md-10 m-0 p-0"> --}}
                                        <div class="card p-0 cc">
                                            <div class="card-body">
                                                <div class="row m-0 p-0">
                                                    <label class="col-lg-12 col-form-label">
                                                        <h4>Multi File</h4>
                                                    </label>
                                                </div>
                                                <div class="row m-0 p-0">
                                                    <div class="col-lg-12">
                                                        <input type="file" name="employee_multi_file[new][]" multiple=""
                                                            id="MultiImg" class="form-control">
                                                        <p>
                                                        </p>
                                                        <div class="row mb-1" id="preview_img"></div>
                                                         @error('employee_multi_file.*.*')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-9 m-0  p-0" style="margin-left: 25px;">
                                        <div class="row  p-0 allimg">
                                            @foreach ($multiimgs as $img)
                                            <div class="col-lg-2">
                                                <div class="card">

                                                    <div class="img row " style="text-align: center;">
                                                        <div class="col-12">
                                                            <img src="{{ asset($img->photo_name) }}"
                                                                class="card-img-top"
                                                                style="height: 150px; width: 100%;">
                                                        </div>
                                                    </div>

                                                    <div class="row" style="margin-top: 5px">
                                                        <div class="col-8">
                                                            <input class="form-control" type="file" style="width: 100%"
                                                                name="employee_multi_file[{{ $img->id }}]">
                                                        </div>
                                                        <div class="col-4">
                                                            <a href="{{ route('role.employee.multiimg.delete', [config('fortify.guard'), $img->id]) }}"
                                                                style="width: 100%; margin-left :"
                                                                class="btn btn-sm btn-danger" id="#"
                                                                title="Delete Data"><i class="fa fa-trash"></i> </a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            @endforeach
                                        </div>

                                    </div><!--  end col md 3 -->
                                    <input type="text" name="employee_id" hidden value="{{ $employee->id }}">
                                </div>
                                <br>
                                <br>
                                {{-- @endif --}}
                                <div class="text-xs-right text-center"
                                    style="margin-bottom: -60px;margin-top: -50px;margin-left: 10px;">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">
                                </div>
                    </form>
                </div>
            </div>
        </div> <!-- // end row  -->
        
        
    </div>
</div>



</div> <!-- end card-body-->
</div> <!-- end card-->
</div>

</div> <!-- container -->

@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"
    type="text/javascript"></script>
<script type="text/javascript">
    function removeItem(event) { event.parentNode.remove() }
    $(document).ready(function () {
        $("#add_more").click(function (e) {
            $input = $(` <div class="file mb-3" id="main" id="employee_Upload_file" >
                        <div class="controls d-flex">
                            <input type="file" id="employee_Upload_file" name="employee_Upload_file[]" class="form-control flex-grow-1" >
                            <input type="button"  name="submit" onclick='removeItem(this)' class="remove-class btn btn-danger" value="X">
                            @error('employee_Upload_file')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>`).appendTo('#total');   });});
</script>


{{-- ---------------------------Show Multi Image JavaScript Code ------------------------ --}}
<script>
    $(document).ready(function() {
        $('#MultiImg').on('change', function() { //on file input change
            if (window.File && window.FileReader && window.FileList && window
                .Blob) //check File API supported browser
            {
                var data = $(this)[0].files; //this file data
                $.each(data, function(index, file) { //loop though each file
                    if (/(\.|\/)(gif|jpe?g|webp?|png)$/i.test(file
                            .type)) { //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function(file) { //trigger function on successful read
                            return function(e) {
                                var img = $('<img/>').addClass('thumb').attr('src'
                                        , e.target.result).width(80)
                                    .height(60); //create image element
                                $('#preview_img').append(
                                    img); //append image to output element
                            };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });
            } else {
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
        });
    });
</script>

@endsection
@section('script')
@endsection