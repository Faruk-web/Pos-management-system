@extends('admin.admin_master')
@section('main-content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid mt-5">
            <div class="row">              
            <div class="col-12">
                <h2 class="text-center">All Role And Permission </h2>
            </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-2">
                                <h4 class="text-center header-title"></h4>
                            </div>
                            <div class="admin-btns">

                                <button class="admin-btn">
                                    <a href="{{ route('role.add.admin', config('fortify.guard')) }}">Admin Role Create</a>
                                </button>
                                

                            </div>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->


                <div class="col-3">
                    <div class="card">
                        <div class="card-body">

                            <div class="admin-btns">
                            <button class="employee-btn">
                                <a href="{{ route('role.emp.permision', config('fortify.guard')) }}"> Employee Role Create</a>
                            </button>
                            
                        </div>
                        </div>
                    </div>




                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="admin-btns">
                            <button class="employee-btn">
                                <a href="{{ route('role.agent_panel.permision', config('fortify.guard')) }}">Agent Role Create</a>
                            </button>

                           
                        </div>
                        </div>
                    </div>


                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body">

                            <div class="admin-btns">
                            <button class="employee-btn">
                                <a href="{{ route('role.sup.permision', config('fortify.guard')) }}">Supplier Role Create</a>

                            </button>

                            
                        </div>
                        </div>
                    </div>
                </div>


            </div>
            <!-- end row-->
        </div> <!-- container -->
    </div> <!-- content -->









@endsection


