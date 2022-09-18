<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BPPSHOPS</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&family=Merriweather+Sans:wght@400;500;600;700&family=Roboto:wght@300;400;500;700;900&display=swap"
        rel="stylesheet">
</head>
<style>
    * {
        font-family: 'Merriweather Sans', sans-serif;
        margin: 0;
    }

    .mb-3px {
        margin-bottom: 3px !important;
    }

    .mb-10px {
        margin-bottom: 10px !important;
    }

    .text-center {
        text-align: center;
    }

    .fw-bold {
        font-weight: bold;
    }

    .pos-receipt.main {
        width: 80mm;
        /* background-color: rgb(184, 214, 214);        */
    }

    .pos-receipt .header {
        text-align: center;
    }

    .pos-receipt h4,
    .pos-receipt p {
        margin: 0;
    }

    .pos-receipt h4 {
        font-size: 20px;
    }

    .pos-receipt p {
        font-size: 13px;
    }

    .pos-receipt .products th {
        font-size: 14px;
        text-align: left;
    }

    .pos-receipt .products td {
        font-size: 14px;
    }

    .pos-receipt .total td {
        font-size: 15px;
        text-align: right;
    }

    .pos-receipt .total td:first-child {
        width: 100%;
        padding-right: 20px;
    }

    .footer h5 {
        margin-top: 5px;
        font-size: 15px;
    }

    .footer ul {
        /* padding-left: 10px; */
        padding-left: 22px;
        font-size: 14px;
        margin-bottom: 20px;
    }

</style>

<body>

    @php
        $info = App\Models\SiteSetting::get();

    @endphp
    <div class="pos-receipt main align-middle">
        <!-- ----------  Receipt Header ------------- -->
        @foreach ($info as $item)
            <div class="header">
                <h5 class="text-start">{{ $item->company_name }}</h5>
                <p>{{ $item->company_address }}</p>
                <p>{{ $item->phone_one }}</p>
                <p>BIN: {{ $item->phone_two }}</p>
                <p>BIN: {{ $item->email }}</p>
                <p>Mushak-6.3</p>
            </div>
        @endforeach
        @php
            $name = Auth::guard('admin')->user()->name;
        @endphp
        <div class="customer-bill mb-10px ">
            <p>Invoice: {{ $order->invoice_no}}</p>
            <p>Bill Date: {{ date('Y-m-d h:i:s a') }}</p>
            ---------------------------------------------------------
            <p class="text-center" style="font-weight:bold;">Customer  Address</p>
            <p>Customer Name: {{ optional($order->user)->name }}</p>
            <p>ID: {{ optional($order->user)->customer_id }}</p>
            <p>Address:Floor No: {{ $order->floor_no }},Apt No:{{ $order->appartment_no }}, {{ $order->street_address }},<br> {{ optional(optional($order)->postCodes)->postOffice}}</p>

               <p> Mobile: {{ $order->user->mobile}}</p>
            @php
                date_default_timezone_set('Asia/Dhaka');
            @endphp
            <p>Print Time: {{ date('Y-m-d h:i:s a') }}</p>
        </div>

        <!-- ----------  Product Table  ------------- -->
        <div class="table-responsive products">
            <table width="100%" style="background: #F7F7F7;">
                    <tr>
                        <th colspan="2" style="font-size: 10px"><span>Sl.No</span><span style="padding-left: 12px;">Name</span></th>
                    </tr>
                    <tr class="border-top border-left border-right" style="font-size: 6px;">
                        <th style="font-size: 10px; padding-left: 16px;"><br>Color</th>
                        <th style="font-size: 10px;"><br>Size</th>
                        <th style="font-size: 10px"><br>Weight</th>
                        <th style="font-size: 10px"><br>QTY</th>
                        <th style="font-size: 10px"><br>Price</th>
                        <th style="font-size: 10px"><br>Total Price</th>
                    </tr>

                    @foreach ($orderItem as $key => $product)
                        <tr >
                            <td colspan="4"><span style="font-size: 10px"> {{$key+1}}.{{$product->product->product_name}}</span></td>
                        </tr>
                        <tr>
                            @if($product->color == 'null')
                            <td style="font-size: 11px; padding-left:17px;"><br></td>
                            @else
                            <td style="font-size: 11px; padding-left:17px;"><br>{{$product->color}}</td>
                            @endif
                            @if($product->size == 'null')
                            <td style="font-size: 11px"><br></td>
                            @else
                            <td style="font-size: 11px"><br>{{$product->size}}</td>
                            @endif
                            @if($product->product->unit == null)
                            <td style="font-size: 11px"><br></td>
                            @else
                            <td style="font-size: 11px"><br>{{optional($product->product)->unit}}</td>
                            @endif
                            <td><br>{{$product->qty}}</td>
                            <td style="font-size: 12px"><br>
                                @if($product->product->discount_price == 0)
                                {{$product->product->selling_price}}
                                @else
                                {{$product->product->discount_price}}
                                @endif
                            </td>
                            <td style="font-size: 12px"><br>{{$product->price}}TK.</td>
                        </tr>
                    @endforeach
            </table>
            ---------------------------------------------------------
        </div>

        <div class="total">
            <table width="100%">
                <tr>
                    <td>Sub Total:</td>
                    <td>{{$order->amount}}TK.</td>
                </tr>
                <tr>
                    <td>Delivery Charge:</td>
                    <td>{{$order->delivery_charge}}TK.</td>
                </tr>
                <tr class="payableamount">
                    <td>Total: </td>
                    <td>{{$order->amount+$order->delivery_charge}}TK.</td>
                </tr>
            </table>
            ---------------------------------------------------------
        </div>

        <!-- ----------  Return and Footer  ------------- -->
        <div class="footer">
            <h5>Return Policy:</h5>
            <ul>
                <li>Please bring your receipt as proof of purchase for return or exchange within 3 days</li>
                <li>Cash refund is discouraged</li>
            </ul>
            <p class="text-center">*** Thank you for Shopping with us ***</p>
        </div>
    </div>
</body>

</html>

