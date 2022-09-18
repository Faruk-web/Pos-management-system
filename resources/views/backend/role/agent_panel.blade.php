@extends('admin.admin_master')

@section('main-content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid pt-5">

            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="card">
                        <div class="card-body">
                            <div class=" d-flex justify-content-between">
                                <h4 class="header-title pb-2">Agent Role Permission</h4>
                                
                                <button data-bs-toggle="modal" data-bs-target="#addShopOwnerModal" type="button"
                                        class="btn btn-success waves-effect waves-light mb-2 me-2"><i
                                        class="fas fa-plus pe-2"></i> Add Agent Permission</button>
                            </div>

                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Agent Image</th>
                                        <th>Agent Name</th>
                                        <td>Agent Email</td>
                                        <td>Agent Access</td>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($agentPermission as $item)
                                    <tr>
                                        <td> <img src="{{ asset($item->profile_photo_path) }}"
                                                style="width: 50px; height: 50px;"> </td>
                                        <td> {{ $item->name }} </td>
                                        <td> {{ $item->email }} </td>
                                        <td>
                                            
                                            @if ($item->agent_panel == 1)
                                            <span class="badge btn-secondary">Agent Panel</span>
                                            @else
                                            @endif                                           
    
                                        </td>
                                        <td width="25%">
                                          

                                            <a onclick="confirmDelete(this)" data-url="{{ route('role.delete.admin.user', [config('fortify.guard'), $item->id]) }}" href="javascript:void(0);"
                                                class="action-icon delete-icon" title="Delete"><i
                                                    class="far fa-trash-alt"></i> </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div><!-- end col -->
            </div>
        </div> <!-- container -->

    </div> <!-- content -->
    {{-- // agent  panel permission modal  --}}
<div class="modal fade" id="addShopOwnerModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    data-bs-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-black text-center" id="exampleModalLabel">Create Agent Role and Permission</h3>
                <button type="button" id="clickDatassss" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form id="addShopOwnerForm">

                <div class="modal-body p-4 bg-light ">
                    <div class="row p-2">
                    

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="user-name" class="form-label">Shop Owner Name</label>
                                <div class="controls">
                                    <Select class="form-control" name="type">
                                        @foreach ($agent_panel as $emp)
                                            <option value="{{ $emp->id }}">{{ $emp->name }}
                                            </option>
                                        @endforeach
                                    </Select>
                                </div>
                            </div>
                        </div> <!-- end col -->

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="controls">
                                    <input type="password" id="password" name="password"
                                        class="form-control" placeholder="Password" required>
                                </div>
                            </div>
                        </div> <!-- end col -->
                        
                        <div class="row  mb-2">
                            <div class="col-12">
                                <h3>Permission Name :</h3>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-check mb-2 form-check-primary">
                                    <input type="checkbox" class="form-check-input rounded-circle"
                                        id="checkbox_2" name="agent_panel" value="1"  required>
                                    <label class="form-check-label" for="customckeck1">Agent Dashboard
                                        </label>
                                </div>
                            </div>
                        </div> <!-- end row-->

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" style="padding: 12px;width:90px;"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" style="padding: 12px; width:90px;" class="btn btn-info">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>

    function confirmDelete(event){
           
            let fileUrl = event.dataset.url;

            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085D6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: fileUrl,
                    success: function(response) {
                        Swal.fire('Deleted!','Your file has been deleted.','success');
                        location.reload();
                        
                    },
                });

            }
            });
        
            
    }

    
    // agent permission
    $('#addShopOwnerForm').on('submit', function(e) {
        e.preventDefault();
        let role = "{{ config('fortify.guard') }}";

            // let formData = new FormData($(this)[0]);
            let formDataCheck = new FormData($('#addShopOwnerForm')[0]);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: `/${role}/adminuserrole/agent_panel/store`,
                type: 'POST',
                data: formDataCheck,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#clickDatassss').trigger('click');
                    
                    toastr.success("Successfully set permission");
                    location.reload();
                },
                error: function(er) {
                    console.log(er)
                    if (er.status > 399) {
                        $.each(er.responseJSON.errors, function(index, value) {
                            toastr.error(value);
                        });
                       
                    }
                },
                cache: false,
                processData: false,
            });

        });

    

  
</script>
@endsection
