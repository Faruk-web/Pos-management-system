@extends('admin.admin_master')


@section('main-content')

<div class="content">

    <!-- Start Content-->
    <div class="container-fluid pt-4">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <h4 class="page-title">Add Employee</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="employee-container-wrapper">
        <div class="card">
            <div class="card-body">
                <form action="{{route('role.employee.store',config('fortify.guard'))}}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="employee-container">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="">
                                    <label for="name" class="form-label">Employee name<b
                                            style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                                    <div class="controls">
                                        <input type="text" id="employee_name" name="employee_name" placeholder="Name"
                                            class="form-control">
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
                                        <input type="text" id="employee_fathers_name" placeholder="Fathers Name"
                                            name="employee_fathers_name" class="form-control">
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
                                        <input type="text" id="employee_mother_name" placeholder=" Mother Name"
                                            name="employee_mother_name" class="form-control">
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
                                            <input class="form-control " type="date" name="employee_date_of_birth"
                                                dateformat="dd/mm/yy" />
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
                                        <input type="email" id="email_id" placeholder="Email" name="email_id"
                                            class="form-control">
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
                                    <div class="controls">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" name="defnum"
                                                    id="basic-addon1">+88</span>
                                            </div>
                                            <input type="number" class="form-control" placeholder="01*********"
                                                name="employee_phone" aria-label="Username"
                                                aria-describedby="basic-addon1">
                                        </div>
                                        @error('employee_phone')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="">
                                    <label for="office-id" class="form-label">Employee Office Id <b
                                            style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                                    <div class="controls">
                                        <input type="text" id="employee_office_id" placeholder="Office Id"
                                            name="employee_office_id" class="form-control">
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
                                            <option value="{{$department->id}}">{{$department->department_name}}
                                            </option>
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
                                        <input type="file" id="employee_photo" name="employee_photo"
                                            class="form-control">
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
                                            <input class="form-control " type="date" name="employee_joing_date"
                                                dateformat="dd/mm/yy" />
                                        </div>
                                        <label for="birth-day" class="form-label">e.g DD/MM/YY</label>
                                        @error('employee_date_of_birth')
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
                                        <input type="number" id="employee_salary" placeholder="Salary"
                                            name="employee_salary" class="form-control">
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
                                        <input type="text" id="designation" placeholder="Designation"
                                            class="form-control" name="designation">
                                        @error('designation')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="">
                                    <label for="dprt-name" class="form-label">Employee Status <b
                                            style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                                    <div class="controls">
                                        <select id="employee_status" name="employee_status" class="form-control">
                                            <option value="1">Select Employee Stutus</option>
                                            <option value="1">Active</option>
                                            <option value="0">In Active </option>
                                        </select>
                                        @error('employee_status')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="">
                                    <label for="p-address" class="form-label">Employee Present Address <b
                                            style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                                    <div class="controls">
                                        <textarea id="employee_present_address" class="form-control"
                                            name="employee_present_address" rows="4" placeholder="Present Address"
                                            cols="70"></textarea>
                                        @error('employee_present_address')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="">
                                    <label for="p-address" class="form-label">Employee Permanent Address <b
                                            style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                                    <div class="controls">
                                        <textarea id="employee_permanent_address" class="form-control"
                                            name="employee_permanent_address" rows="4"
                                            placeholder="Permanent Address"></textarea>

                                        @error('employee_permanent_address')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                             <div class="col-lg-3 col-md-6 col-sm-12">


                                @php

                                    $all_zone = App\Models\PostCode::all();

                                @endphp

                                <div class="controls" id="zone_id_div">
                                    <label for="zone_id" class="form-label">Zone</label>


                                    <select id="zone_id" name="zone_id" class="form-select">
                                        <option value=" ">Select Zone Name</option>

                                        @foreach ($all_zone as $zone_employee)
                                            <option value="{{ $zone_employee->id }}">
                                                {{ $zone_employee->postOffice }}</option>
                                        @endforeach


                                    </select>


                                    @error('zone_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="employee-reference-wrapper">
                            <h4 class="">#Reference 1</h4>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="">
                                        <label for="name" class="form-label">Reference name <b
                                                style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                                        <input type="text" class="form-control" name="reference_name_one"
                                            placeholder="Name" />
                                        @error('reference_name_one')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="">
                                        <label for="name" class="form-label">Reference Mobile Number <b
                                                style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" name="defnum"
                                                    id="basic-addon1">+88</span>
                                            </div>
                                            <input type="number" class="form-control" placeholder="01*********"
                                                name="reference_mobile_one" aria-label="Username"
                                                aria-describedby="basic-addon1">
                                        </div>
                                        @error('reference_mobile_one')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="">
                                        <label for="name" class="form-label">Reference Relationship <b
                                                style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                                        <input type="text" class="form-control" name="reference_relationship_one"
                                            placeholder="Relationship" />
                                        @error('reference_relationship_one')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="">
                                        <label for="dprt-name" class="form-label">Reference Address <b
                                                style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                                        <textarea id="p-address" class="form-control" placeholder="Address"
                                            name="reference_address_one" rows="4" cols="50"></textarea>
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
                                        <label for="name" class="form-label">Reference name <b
                                                style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                                        <input type="text" name="reference_name_two" class="form-control"
                                            placeholder="Name" />
                                        @error('reference_name_two')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="">
                                        <label for="name" class="form-label">Reference Mobile Number <b
                                                style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" name="defnum"
                                                    id="basic-addon1">+88</span>
                                            </div>
                                            <input type="number" class="form-control" placeholder="01*********"
                                                name="reference_mobile_num_two" aria-label="Username"
                                                aria-describedby="basic-addon1">

                                        </div>
                                        @error('reference_mobile_num_two')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="">
                                        <label for="name" class="form-label">Reference Relationship <b
                                                style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                                        <input type="text" class="form-control" placeholder="Relationship"
                                            name="reference_relationship_two" />
                                        @error('reference_relationship_two')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="">
                                        <label for="dprt-name" class="form-label">Reference Address <b
                                                style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                                        <textarea id="p-address" class="form-control" placeholder="Address"
                                            name="reference_address_two" rows="4" cols="40"></textarea>
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
                                            placeholder="Name" />
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
                                                <span class="input-group-text" name="defnum"
                                                    id="basic-addon1">+88</span>
                                            </div>
                                            <input type="number" class="form-control" placeholder="01*********"
                                                name="reference_mobile_num_3" aria-label="Username"
                                                aria-describedby="basic-addon1">
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
                                            name="reference_relationship_3" />
                                        <div class="invalid-feedback">
                                            please enter your Reference Relationship
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="">
                                        <label for="dprt-name" class="form-label">Reference Address</label>
                                        <textarea id="p-address" class="form-control" placeholder="Address"
                                            name="reference_address_3" rows="4" cols="40"></textarea>
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
                                            placeholder="Name" />
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
                                                <span class="input-group-text" name="defnum"
                                                    id="basic-addon1">+88</span>
                                            </div>
                                            <input type="number" class="form-control" placeholder="01*********"
                                                name="reference_mobile_num_4" aria-label="Username"
                                                aria-describedby="basic-addon1">
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
                                            name="reference_relationship_4" />
                                        <div class="invalid-feedback">
                                            please enter your Reference Relationship
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="">
                                        <label for="dprt-name" class="form-label">Reference Address</label>
                                        <textarea class="form-control" placeholder="Address" name="reference_address_4"
                                            rows="4" cols="40"></textarea>
                                        <div class="invalid-feedback">
                                            please write your Reference address
                                        </div>
                                    </div>
                                </div>


                            </div>


                            <div class="row">
                                  <!-- ================================ Employee Multi File Uploda Start ===================== -->
                                <div class="col-lg-4 col-md-4 col-sm-12" >
                                    <label for="fname" class="mb-2" style="font-size: 13px">Employee Multiple File Add <span
                                            style="color:red; font-weight:bold; font-size: 16">(1024px * 1024px)</span> </label>
                                    <input type="file" data-plugins="dropify" name="employee_multi_file[]" multiple="" id="MultiImg"
                                        class="form-control">
                                        @error('employee_multi_file.*')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <label for="fname">View Employee Multiple File </label>
                                    <div class="row" id="preview_img"></div>
                                </div>
                                <!-- ================================ Employee Multi File Uploda End ===================== -->
                            </div>







                        </div>
                    </div>
                    <br>
                    <br>
                    <button class="btn btn-success" type="submit">Add Employee</button>
                </form>

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div>

</div> <!-- container -->


@endsection
@section('script')
<script type="text/javascript">
    function removeItem(event){
        event.parentNode.remove()
    }


    $(document).ready(function(){

        $("#add_more").click(function(e) {

            $input = $(` <div class="file mb-3" id="main" id="employee_Upload_file" >

                        <div class="controls d-flex">
                            <input type="file" id="employee_Upload_file" name="employee_Upload_file[]" class="form-control flex-grow-1" >
                            <input type="button"  name="submit" onclick='removeItem(this)' class="remove-class btn btn-danger" value="X">
                            @error('employee_Upload_file')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>`).appendTo('#total');

    });

    });
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
                                            , e.target.result).width(150)
                                        .height(150); //create image element
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
