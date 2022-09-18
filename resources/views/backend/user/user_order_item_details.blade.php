@extends('admin.admin_master')
@section('main-content')

<div class="content">
    <!-- Start Content-->
    <div class="container-fluid mt-5">

        <h2 class="text-center"> Order Details </h2>


        <table id="datatable-buttons" class="datatable-buttons table table-striped dt-responsive nowrap w-60">
            @foreach ($product_list->orderItems as $items)
                <tr>
                    <td> <b>Product Image :</b> <br>
                        <img src={{ asset(optional($items->product)->product_thambnail) }}  height="70" width=70/>
                    </td>
                    <td> <b>Product Code :</b> <br> {{ optional($items->product)->product_code }} </td>
                    <td> <b>Product Name :</b> <br> {{ optional($items->product)->product_name }} </td>
                    <td class="text-center"> <b>Product Quantity :</b> <br> {{ optional($items)->qty }}  </td>
                    <td> <b>Product Price :</b> <br>{{optional($items)->price }} TK. </td>
                </tr>
             @endforeach
        </table>

    </div> <!-- end container -->
</div> <!-- content -->


@endsection
