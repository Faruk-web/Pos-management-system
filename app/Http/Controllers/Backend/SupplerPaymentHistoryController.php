<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\SupplierReturnProduct;
use App\Models\supplerPaymentHistory;
use App\Models\SupplerPaymentReport;
use Carbon\Carbon;


class SupplerPaymentHistoryController extends Controller
{
     public function paymentHistory($role,$id)
    {
          $supplierProducts= Product::where('supplier_id',$id)->with(['returnHistory','paymentHistory'])->orderby('id', 'DESC')->get();

        
        $supplierProductReports = SupplerPaymentReport::where('supplier_id',$id)->get();
        
        
        
        
        

          $supplierInformation =Supplier::where('id',$id)->first();
          return view('backend.supplier.all_supplier_list',compact('supplierProducts','supplierInformation','supplierProductReports'));
    }
      public function singleSupplierProductShow($role,$id)
    {
        $supplierProductsSingle = supplerPaymentHistory::where('product_id',$id)->with('supplier','products')->first();
        
       
   
        return response()->json($supplierProductsSingle);
        
    }
       public function singleSupplierProductInsert($role, Request $request)
       
    {

  
  $supplier_return_product_id = SupplierReturnProduct::where('product_id',$request->product_id)->first();
  


  
            $supplierProductsSingleInsert= supplerPaymentHistory::find($request->suppler_payment_histories_id);
            $supplierProductsSingleInsert->supplier_return_product_id = $supplier_return_product_id->id ?? null ;
            $supplierProductsSingleInsert->withdrawal_amount = $request->withdrowAmount;
            $supplierProductsSingleInsert->due_amount = $request->totalPrice;
            $supplierProductsSingleInsert->total_withdrow_amount = $request->total_products_purchase_price;
            $supplierProductsSingleInsert->update();
            
            
            $SupplerPaymentReportInsert = new SupplerPaymentReport();
            $SupplerPaymentReportInsert->date = Carbon::now();
            $SupplerPaymentReportInsert->product_id =$request->product_id;
            $SupplerPaymentReportInsert->supplier_id =$request->supplier_id;
            $SupplerPaymentReportInsert->supplier_return_product_id =$supplier_return_product_id->id;
            $SupplerPaymentReportInsert->suppler_payment_historie_id =$request->suppler_payment_histories_id;
            
            $SupplerPaymentReportInsert->current_product_amount =$request->purchase_price;
            
            $SupplerPaymentReportInsert->supplier_return_product_amount =$supplier_return_product_id->return_amount;
            $SupplerPaymentReportInsert->withdrawal_amount =$request->withdrowAmount;
            $SupplerPaymentReportInsert->due_amount =$request->totalPrice;
             $SupplerPaymentReportInsert->save();
    
   
          return response()->json($supplierProductsSingleInsert);
    }
    
}
