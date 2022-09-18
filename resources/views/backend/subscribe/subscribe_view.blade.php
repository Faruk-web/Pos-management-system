@extends('admin.admin_master')

@section('main-content')


<div class="content">
    <!-- Start Content-->
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-9 m-auto">
                <div class="card">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="pt-3 ps-3 header-title"> Subscriber Email List</div>
                        </div>

                    </div>
                    {{--  <div class="pt-3 ps-3 header-title">Department List</div>  --}}

                    <div class="card-body">
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Subscriber Email</th>

                                </tr>
                            </thead>

                            <tbody>


                                @foreach ($subscribers as $subscriber)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $subscriber->subscription_email }}</td>
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


    {{--  <div class="content">
        <!-- Start Content-->
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Serial no</th>
                                        <th>Subscribtion Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subscribers as $subscriber)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $subscriber->subscription_email }}</td>

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

    </div> <!-- content -->  --}}

@endsection
