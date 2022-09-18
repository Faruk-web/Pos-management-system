@extends('admin.admin_master')
@section('css')
<style>
    .employee-view-container .employee-image {
        display: flex;
        justify-content: center;
        width: 100%;
    }

    .employee-view-container .employee-image img {
        width: 250px;
        border-radius: 250px;
        height: 250px;
        border: 8px solid #E1E1E1;
    }

    .employee-view-container .profile-info {
        width: 60%;
        margin-left: 12%;
    }

    .active-btn {
        background: #FFFFFF;
        border: 1px solid #4CAF50;
        border-radius: 4px;
        margin-top: 0px;
        padding: 3px 10px;
        pointer-events: none;
    }

    .reference-inner .title {
        margin-bottom: 40px;
        margin-left: 30px;
    }

    .reference-inner .col-lg-6 {
        position: relative;
    }

    .colon {
        width: 5%;
    }

    .vertical {
        border-left: 2px solid #dee2e6;
        height: 450px;
        position: absolute;
        margin-top: 36px;
        left: 50%;
    }

    @media(max-width: 991px) {
        .vertical {
            height: 900px;
        }

        .reference-inner .title {
            margin-left: 0px;
        }

        .employee-view-container .profile-info {
            width: 100%;
            margin-left: 12%;
        }
    }

    @media(max-width: 1470px) {
        .vertical {
            display: none;
        }
    }
</style>
@endsection

@section('main-content')



<div class="content">
    <div class="container-fluid  pt-2">
        <div class="employee-view-container">
            <div class="card">
                <div class="employee-title">View Employee</div>
                <div class="card-body">
                    <div class="employee-image">
                        <img class="img-fluid" src="{{ asset($emp->employee_img) }}" alt="">
                    </div>
                    <div class="row justify-content-center align-content-center mt-4">
                        <div class="col-lg-6 justify-content-center profile-info">
                            <div class="row mb-1">
                                <h5 class="d-flex justify-content-center"><label class="col-lg-4 col-4">Employee
                                        Name</label><label class="col-lg-2 col-2 colon">:</label><span
                                        class="col-lg-6 col-6">{{$emp->employee_name}}</span></h5>
                            </div>
                            <div class="row mb-1">
                                <h5 class="d-flex justify-content-center"><label class="col-lg-4 col-4">Father
                                        Name</label><label class="col-lg-2 col-2 colon">:</label><span
                                        class="col-lg-6 col-6">{{$emp->employee_fathers_name}}</span></h5>
                            </div>
                            <div class="row mb-1">
                                <h5 class="d-flex justify-content-center"><label class="col-lg-4 col-4">Mother
                                        Name</label><label class="col-lg-2 col-2 colon">:</label><span
                                        class="col-lg-6 col-6">{{$emp->employee_mother_name}}</span></h5>
                            </div>
                            <div class="row mb-1">
                                <h5 class="d-flex justify-content-center"><label class="col-lg-4 col-4">Date of
                                        Birth</label><label class="col-lg-2 col-2 colon">:</label><span
                                        class="col-lg-6 col-6">{{\Carbon\Carbon::parse($emp->employee_date_of_birth)->format('d-m-Y')}}</span>
                                </h5>
                            </div>
                            <div class="row mb-1">
                                <h5 class="d-flex justify-content-center"><label class="col-lg-4 col-4">Email
                                        Id</label><label class="col-lg-2 col-2 colon">:</label><span
                                        class="col-lg-6 col-6">{{$emp->email_id}}</span></h5>
                            </div>
                            <div class="row mb-1">
                                <h5 class="d-flex justify-content-center"><label class="col-lg-4 col-4">Office
                                        Id</label><label class="col-lg-2 col-2 colon">:</label><span
                                        class="col-lg-6 col-6">{{$emp->employee_office_id}}</span></h5>
                            </div>
                            <div class="row mb-1">
                                <h5 class="d-flex justify-content-center"><label class="col-lg-4 col-4">Mobile
                                        Number</label><label class="col-lg-2 col-2 colon">:</label><span
                                        class="col-lg-6 col-6">{{$emp->employee_phone}}</span></h5>
                            </div>
                            <div class="row mb-1">
                                <h5 class="d-flex justify-content-center"><label
                                        class="col-lg-4 col-4">Department</label><label
                                        class="col-lg-2 col-2 colon">:</label><span
                                        class="col-lg-6 col-6">{{optional($emp->department)->department_name}}</span>
                                </h5>
                            </div>
                            <div class="row mb-1">
                                <h5 class="d-flex justify-content-center"><label class="col-lg-4 col-4">Joining
                                        Date</label><label class="col-lg-2 col-2 colon">:</label><span
                                        class="col-lg-6 col-6">{{\Carbon\Carbon::parse($emp->employee_joing_date)->format('d-m-Y')}}</span>
                                </h5>
                            </div>
                            <div class="row mb-1">
                                <h5 class="d-flex justify-content-center"><label
                                        class="col-lg-4 col-4">Designation</label><label
                                        class="col-lg-2 col-2 colon">:</label><span
                                        class="col-lg-6 col-6">{{$emp->designation}}</span></h5>
                            </div>
                            <div class="row mb-1">
                                <h5 class="d-flex justify-content-center"><label
                                        class="col-lg-4 col-4">Salary</label><label
                                        class="col-lg-2 col-2 colon">:</label><span
                                        class="col-lg-6 col-6">{{$emp->employee_salary}}</span></h5>
                            </div>
                            <div class="row mb-1">
                                <h5 class="d-flex justify-content-center"><label class="col-lg-4 col-4">Order
                                        Status</label><label class="col-lg-2 col-2 colon">:</label><span
                                        class="col-lg-6 col-6">
                                        @if($emp->employee_status == 0)
                                        <button class="btn active-btn">In Active</button>
                                        @else
                                        <button class="btn active-btn"> Active</button>
                                        @endif
                                    </span>
                                </h5>
                            </div>
                            <div class="row mb-1">
                                <h5 class="d-flex justify-content-center"><label class="col-lg-4 col-4">Present
                                        Address</label><label class="col-lg-2 col-2 colon">:</label><span
                                        class="col-lg-6 col-6">{{$emp->employee_present_address}}</span></h5>
                            </div>
                            <div class="row mb-1">
                                <h5 class="d-flex justify-content-center"><label class="col-lg-4 col-4">Permanent
                                        Address</label><label class="col-lg-2 col-2 colon">:</label><span
                                        class="col-lg-6 col-6">{{$emp->employee_permanent_address}}</span></h5>
                            </div>
                        </div>
                    </div>
                    <div class="row reference-inner" style="width: 90%; margin-left: 5%;">
                        <div class="col-lg-6 mt-4">
                            <div class="title">
                                <h4 class="d-flex justify-content-start"># Reference 1</h4>
                            </div>
                            <div class="row mb-1">
                                <h5 class="d-flex justify-content-center"><label class="col-lg-4 col-4">Reference
                                        Name</label><label class="col-lg-2 col-2 colon">:</label><span
                                        class="col-lg-6 col-6">{{$empref->reference_name_one}}</span></h5>
                            </div>
                            <div class="row mb-1">
                                <h5 class="d-flex justify-content-center"><label class="col-lg-4 col-4">Mobile
                                        Number</label><label class="col-lg-2 col-2 colon">:</label><span
                                        class="col-lg-6 col-6">{{$empref->reference_mobile_one}}</span></h5>
                            </div>
                            <div class="row mb-1">
                                <h5 class="d-flex justify-content-center"><label
                                        class="col-lg-4 col-4">Relationship</label><label
                                        class="col-lg-2 col-2 colon">:</label><span
                                        class="col-lg-6 col-6">{{$empref->reference_relationship_one}}</span>
                                </h5>
                            </div>
                            <div class="row mb-1">
                                <h5 class="d-flex justify-content-center"><label
                                        class="col-lg-4 col-4">Address</label><label
                                        class="col-lg-2 col-2 colon">:</label><span
                                        class="col-lg-6 col-6">{{$empref->reference_address_one}}</span></h5>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-4">
                            <div class="title">
                                <h4># Reference 2</h4>
                            </div>
                            <div class="row mb-1">
                                <h5 class="d-flex justify-content-center"><label class="col-lg-4 col-4">Reference
                                        Name</label><label class="col-lg-2 col-2 colon">:</label><span
                                        class="col-lg-6 col-6">{{$empref->reference_name_two}}</span></h5>
                            </div>
                            <div class="row mb-1">
                                <h5 class="d-flex justify-content-center"><label class="col-lg-4 col-4">Mobile
                                        Number</label><label class="col-lg-2 col-2 colon">:</label><span
                                        class="col-lg-6 col-6">{{$empref->reference_mobile_num_two}}</span></h5>
                            </div>
                            <div class="row mb-1">
                                <h5 class="d-flex justify-content-center"><label
                                        class="col-lg-4 col-4">Relationship</label><label
                                        class="col-lg-2 col-2 colon">:</label><span
                                        class="col-lg-6 col-6">{{$empref->reference_relationship_two}}</span>
                                </h5>
                            </div>
                            <div class="row mb-1">
                                <h5 class="d-flex justify-content-center"><label
                                        class="col-lg-4 col-4">Address</label><label
                                        class="col-lg-2 col-2 colon">:</label><span
                                        class="col-lg-6 col-6">{{$empref->reference_address_two}}</span></h5>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-4">
                            <div class="title">
                                <h4># Reference 3</h4>
                            </div>
                            <div class="row mb-1">
                                <h5 class="d-flex justify-content-center"><label class="col-lg-4 col-4">Reference
                                        Name</label><label class="col-lg-2 col-2 colon">:</label><span
                                        class="col-lg-6 col-6">{{optional($empref)->reference_name_3}}</span></h5>
                            </div>
                            <div class="row mb-1">
                                <h5 class="d-flex justify-content-center"><label class="col-lg-4 col-4">Mobile
                                        Number</label><label class="col-lg-2 col-2 colon">:</label><span
                                        class="col-lg-6 col-6">{{optional($empref)->reference_mobile_num_3}}</span></h5>
                            </div>
                            <div class="row mb-1">
                                <h5 class="d-flex justify-content-center"><label
                                        class="col-lg-4 col-4">Relationship</label><label
                                        class="col-lg-2 col-2 colon">:</label><span
                                        class="col-lg-6 col-6">{{optional($empref)->reference_relationship_3}}</span>
                                </h5>
                            </div>
                            <div class="row mb-1">
                                <h5 class="d-flex justify-content-center"><label
                                        class="col-lg-4 col-4">Address</label><label
                                        class="col-lg-2 col-2 colon">:</label><span
                                        class="col-lg-6 col-6">{{optional($empref)->reference_address_3}}</span></h5>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-4">
                            <div class="title">
                                <h4># Reference 4</h4>
                            </div>
                            <div class="row mb-1">
                                <h5 class="d-flex justify-content-center"><label class="col-lg-4 col-4">Reference
                                        Name</label><label class="col-lg-2 col-2 colon">:</label><span
                                        class="col-lg-6 col-6">{{optional($empref)->reference_name_4}}</span></h5>
                            </div>
                            <div class="row mb-1">
                                <h5 class="d-flex justify-content-center"><label class="col-lg-4 col-4">Mobile
                                        Number</label><label class="col-lg-2 col-2 colon">:</label><span
                                        class="col-lg-6 col-6">{{optional($empref)->reference_mobile_num_4}}</span></h5>
                            </div>
                            <div class="row mb-1">
                                <h5 class="d-flex justify-content-center"><label
                                        class="col-lg-4 col-4">Relationship</label><label
                                        class="col-lg-2 col-2 colon">:</label><span
                                        class="col-lg-6 col-6">{{optional($empref)->reference_relationship_4}}</span>
                                </h5>
                            </div>
                            <div class="row mb-1">
                                <h5 class="d-flex justify-content-center"><label
                                        class="col-lg-4 col-4">Address</label><label
                                        class="col-lg-2 col-2 colon">:</label><span
                                        class="col-lg-6 col-6">{{optional($empref)->reference_address_4}}.</span></h5>
                            </div>
                        </div>
                        
                        <div class="vertical"></div>
                        
                         <div class="row">
                            <h4 class="pt-2">Employee Upload file: </h4>
                            <div class="d-flex">

                                @foreach ($multiimgs as $item)
                                    <div class="employee-upload">
                                        <img class="img-fluid" src="{{ asset($item->photo_name) }}"  data-image-zoom-exceed="true" width="300px" alt="">
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        
                        
                   
                        
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container -->
</div> <!-- content -->

<script src="https://cdn.jsdelivr.net/gh/mvoloskov/fast-image-zoom/dist/fast-image-zoom.min.js">
    
    

    
</script>

<script>
        imageZoom({
    selector: `img[alt]:not([alt=""]):not([data-image-zoom-disabled])`,
    cb: () => {},
    exceed: false,
    padding: 20,
})
</script>


@endsection


