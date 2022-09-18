<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\NewOrderController;




  // Admin Orders  Route Group
    Route::prefix('orders')->middleware('routePermission')->group(function () {

        // pending order view
        Route::get('/pending/orders', [OrderController::class, 'PendingOrder'])->name('pending.orders');
        // Pending Orders Details
        Route::get('/pending/orders/details/{order_id}', [OrderController::class, 'PendingOrdersDetails'])->name('pending.orders.details');

        //pending delivery code generate
        Route::get('/get/deliverycode/{id}/{print_quantity}', [OrderController::class, 'DeliveryCode'])->name('Get.deliverycode');

        // Confirmed Orders
        Route::get('/confirmed/orders', [OrderController::class, 'ConfirmedOrders'])->name('confirmed-orders');
        Route::get('/processing/orders', [OrderController::class, 'ProcessingOrders'])->name('confirm-processing');
        Route::get('/picked/orders', [OrderController::class, 'PickedOrders'])->name('picked-orders');

        Route::get('/shipped/orders', [OrderController::class, 'ShippedOrders'])->name('shipped-orders');

        Route::get('/delivered/orders', [OrderController::class, 'DeliveredOrders'])->name('delivered-orders');

        Route::get('/cancel/orders', [OrderController::class, 'CancelOrders'])->name('cancel-orders');

        Route::get('/invoice/print/{order}', [OrderController::class, 'InvoicePrintBpp'])->name('inv_print');


        // update route all
        //for confirm
        Route::get('/pending/confirm/{order_id}', [OrderController::class, 'PendingToConfirm'])->name('pending-confirm');
        // fro processing
        Route::get('/confirm/processing/{order_id}', [OrderController::class, 'ConfirmToProcessing'])->name('confirm.processing');
        // for  picdate
        Route::get('/processing/picked/{order_id}', [OrderController::class, 'ProcessingToPicked'])->name('processing.picked');
        // for shiped
        Route::get('/picked/shipped/{order_id}', [OrderController::class, 'PickedToShipped'])->name('picked.shipped');

        // for delevery
        Route::get('/shipped/delivered/{order_id}', [OrderController::class, 'ShippedToDelivered_20'])->name('shipped.delivered');
        // for cancel
        Route::get('/delivered/cancel/{order_id}', [OrderController::class, 'DeliveredToCancel'])->name('delivered.cancel');
        // Order Invoice Download
        Route::get('/invoice/download/{order_id}', [OrderController::class, 'AdminInvoiceDownload'])->name('invoice.download');
    }); // end coupon prefix

     // =========================== New Order Panel Start =============================================

     Route::prefix('order')->middleware('routePermission')->name('order.')->group(function () {
        Route::get('/allOrdersList', [NewOrderController::class, 'allOrderList'])->name('getAllOrderList');
        Route::get('/pendingOrdersList', [NewOrderController::class, 'pendingOrderList'])->name('pendingOrdersList');
        Route::get('/confirmedOrdersList', [NewOrderController::class, 'confirmedOrdersList'])->name('confirmedOrdersList');
        Route::get('/processingOrdersList', [NewOrderController::class, 'processingOrdersList'])->name('processingOrdersList');
        Route::get('/pickedOrdersList', [NewOrderController::class, 'pickedOrdersList'])->name('pickedOrdersList');
        Route::get('/pickedOrdersProcessingList', [NewOrderController::class, 'pickedOrdersProcessingList'])->name('pickedOrdersProcessingList');
        Route::get('/pickedOrdersCompleteList', [NewOrderController::class, 'pickedOrdersCompleteList'])->name('pickedOrdersCompleteList');
        Route::get('/readyToShipList', [NewOrderController::class, 'readyToShipList'])->name('readyToShipList');
        Route::get('/cancelOrderList', [NewOrderController::class, 'cancelOrderList'])->name('cancelOrderList');


        Route::get('/allOrdersDetails/{order_id}', [NewOrderController::class, 'allOrdersDetails'])->name('allOrdersDetails');
        Route::get('/pendingOrdersDetails/{order_id}', [NewOrderController::class, 'pendingOrdersDetails'])->name('pendingOrdersDetails');
        Route::get('/confirmOrdersDetails/{order_id}', [NewOrderController::class, 'confirmOrdersDetails'])->name('confirmOrdersDetails');
        Route::get('/processingOrdersDetails/{order_id}', [NewOrderController::class, 'processingOrdersDetails'])->name('processingOrdersDetails');
        Route::get('/cancelOrdersDetails/{order_id}', [NewOrderController::class, 'cancelOrdersDetails'])->name('cancelOrdersDetails');




        Route::get('/setStatusToConfirm/{order_id}', [NewOrderController::class, 'setStatusToConfirm'])->name('setStatusToConfirm');
        Route::get('/setStatusToCancel/{order_id}', [NewOrderController::class, 'setStatusToCancel'])->name('setStatusToCancel');
        Route::get('/setStatusToProcessing/{order_id}', [NewOrderController::class, 'setStatusToProcessing'])->name('setStatusToProcessing');
        Route::get('/setStatusToPicked/{order_id}', [NewOrderController::class, 'setStatusToPicked'])->name('setStatusToPicked');



        Route::POST('/setOrderItemStatus', [NewOrderController::class, 'setOrderItemStatus'])->name('setOrderItemStatus');
        Route::POST('/setEmployeeToConfirmOrderProcessing', [NewOrderController::class, 'setEmployeeToConfirmOrderProcessing'])->name('setEmployeeToConfirmOrderProcessing');
        Route::POST('/setEmployeeToPickedOrder', [NewOrderController::class, 'setEmployeeToPickedOrder'])->name('setEmployeeToPickedOrder');
        Route::POST('/setStatusToPickedComplete/', [NewOrderController::class, 'setStatusToPickedComplete'])->name('setStatusToPickedComplete');
        Route::POST('/setEmployeeToCheckedItems/', [NewOrderController::class, 'setEmployeeToCheckedItems'])->name('setEmployeeToCheckedItems');
        Route::POST('/setReadyToShippedStatus/', [NewOrderController::class, 'setReadyToShippedStatus'])->name('setReadyToShippedStatus');


        //get the number of employee assigned to item
        Route::get('/checkEmployeeAssignedToAllItem/{order_id}', [NewOrderController::class, 'checkEmployeeAssignedToAllItem'])->name('checkEmployeeAssignedToAllItem');
        Route::get('/checkPickBoyAssignedToAllItem/{order_id}', [NewOrderController::class, 'checkPickBoyAssignedToAllItem'])->name('checkPickBoyAssignedToAllItem');


        // employee order processing route

        Route::get('/employeeOrderProcessingList', [NewOrderController::class, 'employeeOrderProcessingList'])->name('employeeOrderProcessing');
        Route::get('/employeeOrderProcessingDetails/{order_id}', [NewOrderController::class, 'employeeOrderProcessingDetails'])->name('employeeOrderProcessingDetails');
        Route::POST('/employeeOrderProcessingStatusSet', [NewOrderController::class, 'employeeOrderProcessingStatusSet'])->name('employeeOrderProcessingStatusSet');

        Route::get('/pickUpBoyOrderProcessing', [NewOrderController::class, 'pickUpBoyOrderProcessing'])->name('pickUpBoyOrderProcessing');
        Route::get('/pickUpBoyOrderProcessingDetails/{order_id}', [NewOrderController::class, 'pickUpBoyOrderProcessingDetails'])->name('pickUpBoyOrderProcessingDetails');
        Route::POST('/pickUpBoyOrderProcessingStatusSet', [NewOrderController::class, 'pickUpBoyOrderProcessingStatusSet'])->name('pickUpBoyOrderProcessingStatusSet');

        Route::get('/singleSupplierInvoice/{employee_id}', [NewOrderController::class, 'singleSupplierInvoice'])->name('singleSupplierInvoice');

        Route::get('/pickedSupplierItemDetails/{supplier_id}/{employee_id}', [NewOrderController::class, 'pickedSupplierItemDetails'])->name('pickedSupplierItemDetails');

        Route::get('/allSupplierInvoice/{pickerBoy_id}', [NewOrderController::class, 'allSupplierInvoice'])->name('allSupplierInvoice');



        // single product items for bar code route
        Route::get('/bppshopsbarcodeprint/{product_id}/{invoice_no}', [NewOrderController::class, 'BppShopsProductBarCode'])->name('bppshopsbarcodeProductBarCode');
        // supplier barcode print
        Route::get('/generateProductBarCode/{product_id}/{invoice_no}', [NewOrderController::class, 'SupplierProductBarCode'])->name('supplier_ProductBarCode');


        // main Order product items for bar code route
        Route::get('/generateOrderBarCode/{product_id}', [NewOrderController::class, 'generateOrderBarCode'])->name('generateOrderBarCode');
        Route::get('/backToPickedOrderProcessList/', [NewOrderController::class, 'backToPickedOrderProcessList'])->name('backToPickedOrderProcessList');
        Route::post('/processDone', [NewOrderController::class, 'processDone'])->name('processDone');


        // customer invoice
        Route::get('/customerall/invoice/print/{order}', [NewOrderController::class, 'CustomerInvoicePrintBpp'])->name('customer_invoice');
    });

    // ========================== New Order Panel End ===============================================