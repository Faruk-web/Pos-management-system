@extends('admin.admin_master')

@section('main-content')

<div class="content">
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 m-auto">
                <div class="card">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="pt-3 ps-3 header-title">Employee Product Tracking Record</div>
                        </div>
                        <div class="col-lg-6">

                        </div>
                    </div>


                    <div class="card-body">
                        <table id="datatable-buttons" class="datatable-buttons table table-striped ">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Employee Name</th>
                                    <th>Employee ID</th>
                                    <th>Employee Designation</th>
                                    <th>Total Product Add</th>
                                    <th class="text-success" >Todays Total product Add </th>
                                    <th>Total Product Update</th>
                                    <th class="text-warning">Todays Total product Update </th>
                                    <th>Total Product Delete</th>
                                    <th class="text-danger">Todays Total product Delete </th>
                                    
                                    <th>Action</th>
                                    
                                </tr>
                            </thead>
                           

                            <tbody>
                                 @foreach ($employee_teckings as $employee_tecking)

                                <tr>
                                    
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ optional($employee_tecking)->employee_name }}</td>
                                    
                                    <td>{{ optional($employee_tecking)->employee_office_id }}</td>
                                    <td>{{ optional($employee_tecking)->designation }}</td>
                                    
                                    <td>
                                        @php
                                        $totalProductAdd=App\Models\EmployeeTecking::select('id')->where('employee_id',$employee_tecking->id)->where('working_info','productAdd')->count();
                                   
                                        @endphp
                                        {{$totalProductAdd?$totalProductAdd:"0"}}
                                    </td>
                                 <td>
                                        @php
                                        $todayTotalProductAdd=App\Models\EmployeeTecking::select('id')->where('employee_id',$employee_tecking->id)->where('working_info','productAdd')->where('today_date',date("Y-m-d"))->count();
                                   
                                        @endphp
                                        {{$todayTotalProductAdd?$totalProductAdd:"0"}}
                                    </td>
                                  
                                        <td>
                                        @php
                                        $totalProductUpdate=App\Models\EmployeeTecking::select('id')->where('employee_id',$employee_tecking->id)->where('working_info','productUpdate')->count();
                                   
                                        @endphp
                                        {{$totalProductUpdate?$totalProductUpdate:"0"}}
                                    </td>
                                 <td>
                                        @php
                                        $todayTotalProductUpdate=App\Models\EmployeeTecking::select('id')->where('employee_id',$employee_tecking->id)->where('working_info','productUpdate')->where('today_date',date("Y-m-d"))->count();
                                   
                                        @endphp
                                        {{$todayTotalProductUpdate?$todayTotalProductUpdate:"0"}}
                                    </td>
                                    
                                       <td>
                                        @php
                                        $totalProductDelete=App\Models\EmployeeTecking::select('id')->where('employee_id',$employee_tecking->id)->where('working_info','productDelete')->count();
                                   
                                        @endphp
                                        {{$totalProductDelete?$totalProductDelete:"0"}}
                                    </td>
                                 <td>
                                        @php
                                        $todayTotalProductDelete=App\Models\EmployeeTecking::select('id')->where('employee_id',$employee_tecking->id)->where('working_info','productDelete')->where('today_date',date("Y-m-d"))->count();
                                   
                                        @endphp
                                        {{$todayTotalProductDelete?$todayTotalProductDelete:"0"}}
                                    </td>
                                    
                                    
                                <td>
                                    <a href="{{route('role.addTrackingHistory', [config('fortify.guard'),$employee_tecking->id])}}" ><i class="fas fa-eye btn btn-info" title="View All Add"></i></a>
                                    <a href="{{route('role.updateTrackingHistory', [config('fortify.guard'),$employee_tecking->id])}}" > <i class="fas fa-eye btn btn-success" title="View All Update"></i> </a>
                                    <a href="{{route('role.deleteTrackingHistory', [config('fortify.guard'),$employee_tecking->id])}}" > <i class="fas fa-eye btn btn-danger" title="View All Delete"></i>  </a>
                                </td>
                                
                                
                                    
                                </tr>
                                
                                    
                                @endforeach

                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div><!-- end card -->
            </div><!-- end col-->

        </div>
        <!-- end row-->




    </div> <!-- container -->
</div>

@endsection
