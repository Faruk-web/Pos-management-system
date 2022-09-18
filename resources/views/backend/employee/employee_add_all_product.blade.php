@extends('admin.admin_master')
@section('main-content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                       
                            
                         <div class="d-lg-flex justify-content-lg-between mb-2">
                <div class="col-lg-6 col-12 paymentInfo">
                  <h4 class="header-title">Add Product List</h4>
                  <p><b> Name:</b> {{$employeeInformation->employee_name}}</p>
                  <p><b> ID:</b> {{$employeeInformation->employee_office_id}}</p>
                  <p><b>Contact No:</b> {{$employeeInformation->employee_phone}}</p>
                  <p><b>Address:</b> {{$employeeInformation->employee_present_address}}</p>
                </div>
                <div class="col-lg-6 col-12 d-lg-flex justify-content-lg-end">
                </div>
              </div>
                        
                         <table id="datatable-buttons" class=" table table-striped nowrap w-100 dataTable no-footer" role="grid"
                                            aria-describedby="datatable-buttons_info">
                            <thead>
                                <tr>
                                     <th>Product Add Date & Time</th>
                                   <th>Image</th>
                                    <th>Ecommerce Name </th>
                                    <th>Product Code </th>
                                     <th>Product Name</th>
                                     <th>Unit Cost Price</th>
                                     <th>Selling Price</th>
                                     <th>Discount Price</th>
                                    <th>Discount Start date</th>
                                    <th>Discount Close Date</th>
                                    <th>Supplier Name </th>
                                    <th>Supplier Code </th>
                                    <th>Category </th>
                                    <th> Sub Category </th>
                                    <th> Sub Sub Category </th>
                                     <th>Size</th>
                                    <th>Color</th>
                                    <th>Purchase Date</th>
                                    <th>Purchase QTY</th>
                                     <th>Stock QTY</th>
                                    <th>Product Expire date</th>
                                    
                                </tr>
                            </thead>
                            <tbody
                            
                               @foreach ($addTrackingHistory as $history)
                                    <tr>
                                
                                    <td>{{optional($history->productName)->employee_date}}</td>
                               
                                      <td> <img src="{{ asset(optional($history->productName)->product_thambnail) }}"style="width: 60px; height: 50px;"> </td>
                                     <td>{{optional(optional($history->productName)->ecommerce)->ecom_name}}</td>
                                      <td>{{optional($history->productName)->product_code}}</td>
                                      <td>{{optional($history->productName)->product_name}}</td>
                                      <td>{{optional($history->productName)->unit_price}}</td>
                                      <td>{{optional($history->productName)->selling_price}}</td>
                                      <td>{{optional($history->productName)->discount_price}}</td>
                                      <td>{{optional($history->productName)->start_date}}</td>
                                      <td>{{optional($history->productName)->end_date}}</td>
                                    <td>{{optional(optional($history->productName)->supplier)->supplyer_name}}</td>
                                    <td>{{optional(optional($history->productName)->supplier)->supplyer_id_code}}</td>
                                    <td>{{optional(optional($history->productName)->category)->category_name}}</td>
                                    <td>{{optional(optional($history->productName)->subcategory)->sub_category_name}}</td>
                                    <td>{{optional(optional($history->productName)->subsubcategory)->subsubcategory_name}}</td>
                                      <td>{{optional($history->productName)->product_size}}</td>
                                      <td>{{optional($history->productName)->product_color}}</td>
                                      <td>{{optional($history->productName)->purchase_date}}</td>
                                      <td>{{optional($history->productName)->purchase_qty}}</td>
                                      <td>{{optional($history->productName)->product_qty}}</td>
                                      <td>{{optional($history->productName)->product_expire_date}}</td>
                                      <td>{{optional($history->productName)->product_expire_date}}</td>

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
    <!-- return product modal -->
    <div class="return-product-modal">
        <div class="modal fade" tabindex="-1" id="return-product-modal">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Submit SKU Code</h5> <button type="button" class="btn-close"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3"> <label for="name" class="form-label">SKU Code</label> <input
                                class="form-control" type="text" id="name"> </div>
                    </div>
                    <div class="modal-footer"> <button type="button"
                            class="btn btn-light waves-effect waves-light mb-2 me-2" data-bs-dismiss="modal">Close</button>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#return-product-submit-modal"><button
                                type="button" class="btn btn-success waves-effect waves-light mb-2 me-2">Submit</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- return product submit modal -->
@endsection
