<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Ecommerce_Name;
use App\Models\PostCode;
use App\Models\Employee;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Image;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{


//================= Supplier Confirmation order  list Start ==============================
    public function orderConfirmationList()
    {
       $orderConfirmationLists = Order::whereHas('orderItems',function($q)
       {
           $q->where('pending_status',NULL)->whereHas('product.supplier',function($subq)
           {
               $subq->where('id',Auth::user()->supplier_id);
           });
       })->get();
    //   dd($orderConfirmationList);
        return view('backend.supplier.order_confirmation_list',compact('orderConfirmationLists'));
    }
//================= Supplier Confirmation order  End ==============================

//================= Supplier Confirmation Items Start ==============================
        public function orderItemsConfirmationList($role, $order_id)
    {

        $order = Order::with(['orderItems'=>function($q)
        {
            $q->whereHas('product',function($subQ)
            {
                $subQ->whereHas('supplier',function($subSubQ)
                {
                    $subSubQ->where('id',Auth::user()->supplier_id);
                });
            });
        }])
        ->withSum('orderItems','pending_status',function($query)
        {
            $query->where('pending_status',1);
        })->withCount('orderItems')->where('status', 'Pending')->find($order_id);

        return view('backend.supplier.confirmation_items_list',compact('order'));
    }


//================= Supplier Confirmation Items  End ==============================


    public function show()
    {
        $suppliers = Supplier::with('ecommerce','zone','acquisiton')->latest()->get();

        // dd($suppliers);
        $ecom = Ecommerce_Name::latest()->get();
        $zone_id =PostCode::orderBy("postOffice", "asc")->get();
        $employee_id = Employee::where('department_id',5)->latest()->get();

        return view('backend.suppliers.suppliers_view', compact('suppliers', 'ecom','zone_id','employee_id'));
    }

   public function supplierAllProductShow($role ,$id)
    {

        $supplierAllProductShows = Product::where('supplier_id',$id)->with('ecommerce','supplier','brand','category','subsubcategory','subcategory','returnHistory','paymentHistory')->get();
        $supplier_id = $id;
        $supplierDetails=Supplier::where('id',$id)->first();

        return view('backend.suppliers.single_supplier_all_product', compact('supplierAllProductShows','supplier_id','supplierDetails'));
    }


     public function acquisitionSupplierShow($role ,$id)

    {



        // $supplierAllProductShows = Product::where('supplier_id',$id)->with('ecommerce','supplier','brand','category','subsubcategory','subcategory','returnHistory','paymentHistory')->get();
         $employee_informition =Employee::where('id',$id)->first();
        $acquisitionsupplierDetails=Supplier::with('zone')->where('aquisition_employee_id',$id)->get();
        $acquisitionsupplierCount=Supplier::with('zone')->where('aquisition_employee_id',$id)->count();




        return view('backend.suppliers.acquisitionSupplierShow', compact('acquisitionsupplierDetails','employee_informition','acquisitionsupplierCount'));
    }



     public function supplierAllProductShowSearch($role,$supplier_id, Request  $request)
    {



        $supplierAllProductShows = Product::where('supplier_id',$supplier_id)->whereBetween('purchase_date', [$request->fromDate, $request->toDate])->with('ecommerce','supplier','brand','category','subsubcategory','subcategory','returnHistory','paymentHistory')->get();
            $supplierDetails=Supplier::where('id',$supplier_id)->first();


        return view('backend.suppliers.single_supplier_all_product', compact('supplierAllProductShows','supplier_id','supplierDetails'));
    }


     public function store($role, Request  $request)
    {



          $validator = Validator::make($request->all(), [
            'ecom_name' => 'required',
            'zone_id' => 'required',
            'employee_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }

         $supplier_code = Supplier::count();
            $supplier = new Supplier();

           $supplier = new Supplier();
        if($supplier_code < 10){
            $supplier->supplyer_id_code = 'SP-100'. $supplier_code;
        }elseif($supplier_code <=100){
            $supplier->supplyer_id_code = 'SP-100'. $supplier_code;
        }
        elseif($supplier_code <=1000){
            $supplier->supplyer_id_code = 'SP-100'. $supplier_code;
        } elseif($supplier_code <=10000){
            $supplier->supplyer_id_code = 'SP-100'. $supplier_code;
        } elseif($supplier_code <=100000){
            $supplier->supplyer_id_code = 'SP-100'. $supplier_code;
        }
        else{
            $supplier->supplyer_id_code = 'SP-100'. $supplier_code;
        }
            // $supplier->supplyer_id_code = '#' . $grn;
            $supplier->ecom_id = $request->ecom_name;
            $supplier->zone_id = $request->zone_id;
            $supplier->aquisition_employee_id = $request->employee_id;
            $supplier->supplyer_name = $request->supplyer_name;
            $supplier->messengerLink = $request->messengerLink;
            $supplier->company_name = $request->company_name;
            $supplier->supplyer_email = $request->supplyer_email;
            $supplier->supplyer_phone ='+88'.$request->supplyer_phone;
            $supplier->supplyer_phone2 ='+88'.$request->supplyer_phone2;
            $supplier->supplyer_bank_info = $request->supplyer_bank_info;
            $supplier->supplyer_mobile_bank_info = $request->supplyer_mobile_bank_info;
            $supplier->supplyer_address = $request->supplyer_address;
            $supplier->supplyer_status = '1';
            $supplier->save();
        $notification = array(
            'message' =>  'Suppliers Add Sucessyfuly',
            'alert-type' => 'success'
        );
        return response([
            'supplier' => $supplier,
            'message' => $notification
        ]);
    }

// ---------------supplier data show all---------------------
public function SupplierDataShowAll(){
    $supplier = Supplier::with('ecommerce')->get();
    return response( $supplier);
}
// -----------------supplier data delete---------------------
public function SupplierDataDeleteAll($role, $id){
    $supplier = Supplier::find($id)->delete();
    return redirect()->back();
}

// ------------------supplier edit----------------
public function SupplierEditAll($role,$id){
    $supplier = Supplier::find($id);
    return response( $supplier);
}
// ---------------------supplier Update-------------------
    public function SupplierUpdateAll(Request $request,$role,$id){
        $supplier =  Supplier::find($id);
        $supplier->ecom_id = $request->ecom_id;
        $supplier->supplyer_name = $request->supplyer_name;
        $supplier->supplyer_id_code = $request->supplyer_id_code;
        $supplier->messengerLink = $request->messengerLink;
        $supplier->company_name = $request->company_name;
        $supplier->supplyer_email = $request->supplyer_email;
        $supplier->supplyer_phone = $request->supplyer_phone;
        $supplier->supplyer_phone2 = $request->supplyer_phone2;
        $supplier->supplyer_bank_info = $request->supplyer_bank_info;
        $supplier->supplyer_mobile_bank_info = $request->supplyer_mobile_bank_info;
        $supplier->supplyer_address = $request->supplyer_address;
        $supplier->update();
        return response( $supplier);
    }

    // ---------------Active-----------------
    public function SupplierActive($role, $id){
         Supplier::findOrFail($id)->update(['supplyer_status' => 1,]);
         $products=Product::where('supplier_id',$id)->update(['status' =>'1']);
        return redirect()->back();
    }
    // -----------------deactive----------------------
    public function SupplierDeactive($role, $id){
       Supplier::findOrFail($id)->update(['supplyer_status' => 0,]);
       $products=Product::where('supplier_id',$id)->update(['status' =>'0']);

        return redirect()->back();

    }
}
