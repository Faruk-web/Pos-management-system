@extends('admin.admin_master')
@section('main-content')
    <section class="content">
        <div class="row mt-5">
            <div class="col-lg-4"></div>
             <div class="col-lg-4">
                                <div class="text-center card">
                                    <div class="card-body">
                                        <div class="pt-2 pb-2">
        <img style="height:8rem" class="rounded-circle img-thumbnail avatar-xl" src="{{ (!empty($adminData->profile_photo_path))?url('public/upload/admin_images/'
                               .$adminData->profile_photo_path):url('upload/avatar-4.png') }}" alt="User Avatar">
                                            <h4 class="mt-3"><a href="extras-profile.html" class="text-dark">Name: {{ $adminData->name }}</a></h4>
                                             <p class="mb-0 text-muted text-truncate">Email  {{ $adminData->email }}</p>   
                                               <p class="mb-0 text-muted text-truncate">{{ $adminData->Phone }}</p>
                                                  <p class="mb-0 text-muted text-truncate">{{ $adminData->phone2 }}</p>
                                               <br>
                                             <p class="mb-0 text-muted text-truncate"><a href="{{ route('admin.admin_profile_edit')}}" class="btn btn-success">Update Profile</a></p>
                                             
                                            <div class="row mt-4">
                                              
                                            </div> <!-- end row-->
    
                                        </div> <!-- end .padding -->
                                    </div>
                                </div> <!-- end card-->
                            </div>
          <div class="col-lg-4"></div>
        </div>
    </section>
    <!-- /.content -->
@endsection