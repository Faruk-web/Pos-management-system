@extends('admin.admin_master')
@section('main-content')
@php
 $total_confirm_order = App\Models\Order::where('status','confirm')->where('user_id',$show->id)->orderBy('id','DESC')->get();
 $orders_pending = App\Models\Order::where('status','pending')->where('user_id',$show->id)->orderBy('id','DESC')->get();
 $total_picked_order = App\Models\Order::where('status','picked')->where('user_id',$show->id)->orderBy('id','DESC')->get();
 $total_processing_order = App\Models\Order::where('status','processing')->where('user_id',$show->id)->orderBy('id','DESC')->get();
 $total_shipped_order = App\Models\Order::where('status','shipped')->where('user_id',$show->id)->orderBy('id','DESC')->get();
 $total_cancel_order = App\Models\Order::where('status','cancel')->where('user_id',$show->id)->orderBy('id','DESC')->get();
 $total_delivered_order = App\Models\Order::where('status','delivered')->where('user_id',$show->id)->orderBy('id','DESC')->get();
 $asset = App\Models\Asset::all();
@endphp



<div class="row">
    <div class="col-lg-1 col-xl-1"></div>
        <div class="col-lg-4 col-xl-4 mt-3">
            <div class="card text-center">
                <div class="card-body">
                    <img src="{{ asset('backend/assets/images/users/user-1.jpg') }}" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">  

                    <div class="text-start mt-3">
                        <h4 class="font-13 text-uppercase text-danger">Customer ID : {{ $show->customer_id }}</h4>
                       <p class="font-13 text-muted mb-2 font-13 text-uppercase"><strong style="color:black">Full Name :</strong> <span class="ms-2" style="color:black">{{ $show->name }}</span></p>
                    
                        <p class="font-13 text-muted mb-2 font-13 text-uppercase"><strong style="color:black">Mobile :</strong><span class="ms-2" style="color:black">{{ $show->mobile }}</span></p>
                    
                        <p class="font-13 text-muted mb-2 font-13 text-uppercase"><strong style="color:black">Email :</strong> <span class="ms-2" style="color:black">{{ $show->email }}</span></p>                    
                      
                        <p class="font-13 text-muted mb-1 font-13 text-uppercase"><strong style="color:black">Address :</strong> <span class="ms-2" style="color:black">{{ $show->address }}</span></p>
                        <p class="font-13 text-muted mb-1 font-13 text-uppercase"><strong style="color:black">Gender :</strong> <span class="ms-2" style="color:black">{{ $show->gender }}</span></p>
                        <p class="font-13 text-muted mb-1 font-13 text-uppercase"><strong style="color:black">Last Seen :</strong> <span class="ms-2" style="color:black">{{ $show->last_seen }}</span></p>
                    </div>                                    

                    <ul class="social-list list-inline mt-3 mb-0">
                        <li class="list-inline-item">
                            <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                        </li>
                       
                       
                    </ul>   
                </div>                                 
            </div>           
           
        </div>

        <div class="col-lg-1 col-xl-1"></div>         






    <div class="col-lg-6">
        <div class="">
            <div class="">
                <h3 class="">Orders Info</h3>
            </div>

            <table class="table table-striped dt-responsive nowrap w-60">
                <tr style="background-color:darkgreen;">
                    <th style="border: 1px solid black;   font-size: 20px">Details</th>
                    <th style="border: 1px solid black;   font-size: 20px">Total Order</th>
                </tr>
                <tr>
                    <td style="font-size: 15px; color:Green; font-wight:bold; ">Total Pending Order:</td>
                    <td style=" font-size: 15px">{{ count($orders_pending) }}</td>
                </tr>
                <tr>
                    <td style="font-size: 15px; color:Green; font-wight:bold; ">Total Confirm Order:</td>
                    <td style="font-size: 15px">{{ count($total_confirm_order) }}</td>
                </tr>
                <tr>
                    <td style="font-size: 15px; color:Green; font-wight:bold; ">Total Processing Order:</td>
                    <td style="font-size: 15px">{{ count($total_processing_order) }}</td>
                </tr>
                <tr>
                    <td style="font-size: 15px; color:Green; font-wight:bold; ">Total Picked Order:</td>
                    <td style="font-size: 15px">{{ count($total_picked_order) }}</td>
                </tr>
                <tr>
                    <td style="font-size: 15px; color:Green; font-wight:bold; ">Total shipped Order:</td>
                    <td style="font-size: 15px">{{ count($total_shipped_order) }}</td>
                </tr>
                <tr>
                    <td style="font-size: 15px; color:Green; font-wight:bold; ">Total Cancel Order:</td>
                    <td style="font-size: 15px">{{ count($total_cancel_order) }}</td>
                </tr>
                <tr>
                    <td style="font-size: 15px; color:Green; font-wight:bold; ">Total Delivered Order:</td>
                    <td style="font-size: 15px">{{ count($total_delivered_order) }}</td>
                </tr>              
               
            </table>
         </div>
    </div>
</div>


<div class="container-fluid">

    <div class="col-lg-12">

        <div class="">
            <div class="">
                <h3 class="">Order History</h3>
            </div>
            <!-- /.box-header -->
           
                <table id="datatable-buttons" class="datatable-buttons table table-striped dt-responsive nowrap w-100" >
                    <thead >
                        <tr>
                            <th style="width: 20px;">SL. No </th>
                            <th>Invoice ID</th>
                            <th>Total Order Amount</th>
                            <th>Payment Method</th>
                            <th>Order Date & Time </th>
                            <th>Order Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach($order_history as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->invoice_no }}</td>
                            <td>{{ $item->amount }} TK.</td>
                            <td >{{ $item->payment_method }}</td>
                            <td >{{ \Carbon\Carbon::parse($item->order_date)->format('Y-m-d') }}</td>                          
                            <td >{{ $item->status }}</td>
                            <td>
                                <div>
                                    <a  href="{{ route('role.orderitemlist', [config('fortify.guard'), $item->id]) }}" class="btn btn-success"><i>Order Item Details</i></a>
                                    
                                    <a  href="{{route('role.invoicedownload',[config('fortify.guard'), $item->id ])}}" class="btn btn-danger"><i>Download Invoice</i></a>
                              
                                </div>
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div><!-- box end -->
    </div> <!-- col end -->

</div>

@endsection

@section('css')
    <style>
        table,tr,td{
         border:.1px solid rgb(18, 59, 97);
            text-align: center;
            font-size:15px;
            padding: 5px;


        }

    </style>
@endsection
