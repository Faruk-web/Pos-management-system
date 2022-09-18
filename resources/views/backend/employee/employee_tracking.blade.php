@extends('admin.admin_master')

@section('main-content')

<div class="content">
    <!-- Start Content-->
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-9 m-auto">
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
                                    <th style="color: red">Todays Total product Add </th>
                                    <th>Total Product Update</th>
                                    <th style="color: red">Todays Total product Update </th>
                                    <th>Total Product Delete</th>
                                    <th style="color: red">Todays Total product Delete </th>
                                </tr>
                            </thead>
                            
                             @php
                               $count_add = OwenIt\Auditing\Models\Audit::with('admin.employeemail')->whereDate('created_at',Carbon\Carbon::today())->select('audits.*')->selectRaw('count(case when event = "created" then 1 end) as createdTotal')->count();
                             
                             @endphp

                            <tbody>
                               @foreach ($totalActivity as $tracking)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ optional($tracking)->employee_name }}</td>
                                    <td>{{ optional($tracking)->employee_office_id }}</td>
                                    <td>{{ optional($tracking)->designation }}</td>
                                    <td>{{ $tracking->createdTotal }}</td>
                                    <td>{{ $tracking->todaycreatedTotal }}</td>
                                    <td>{{ $tracking->updatedTotal }}</td>
                                    <td>{{ $tracking->todaysupdatedTotal }}</td>
                                    <td>{{ $tracking->deletedTotal }}</td>
                                    <td>{{ $tracking->todaysdeletedTotal }}</td>
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
