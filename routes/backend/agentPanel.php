<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AgentPanelController;

    //======================================= Agent All Route Group List start ==================================//
    Route::prefix('agent')->middleware('routePermission')->name('agent_panel.')->group(function () {
        // Laboni Route==

        Route::get('/order/single/view/{id}', [AgentPanelController::class, 'singleHistoryOrder'])->name('single_history_order');
        Route::get('/order/pos/view/{id}', [AgentPanelController::class, 'OrderPosView'])->name('pos_order_view');
        //  Route::get('/single_orders/history/{id}', [AgentPanelController::class, 'singleOrderHistory'])->name('single_order_history');
        Route::get('/view', [AgentPanelController::class, 'view'])->name('view');
        Route::get('/getAll', [AgentPanelController::class, 'getAll'])->name('getAll');
        Route::post('/store', [AgentPanelController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AgentPanelController::class, 'edit'])->name('edit');
        Route::post('/update', [AgentPanelController::class, 'update'])->name('update');
        Route::post('/destroy/{id}', [AgentPanelController::class, 'destroy'])->name('destroy');

        Route::get('/dashboard', [AgentPanelController::class, 'dashboard'])->name('dashboard');
        Route::get('/add/customer', [AgentPanelController::class, 'addCustomer'])->name('add_customer');
        Route::post('/store/customer', [AgentPanelController::class, 'storeCustomer'])->name('store_customer');
        Route::get('/view/customer', [AgentPanelController::class, 'ViewCustomer'])->name('view_customer');
        Route::get('/order/history', [AgentPanelController::class, 'orderHistory'])->name('order_history');
        Route::get('/single_order/history/next/ajax/{order_id}', [AgentPanelController::class, 'singleOrderHistoryAjax2'])->name('single_order_history_ajax2');


        Route::get('/single_order/history/ajax/{id}', [AgentPanelController::class, 'singleOrderHistoryAjas'])->name('single_order_history_ajax');
        Route::get('/my/commission', [AgentPanelController::class, 'myCommision'])->name('my_commission');
        // end Laboni Route

        // new route start for apge panel
        Route::get('/shopping/start_shopping_agent', [AgentPanelController::class, 'startShoppingAgent'])->name('start_shopping_agent');
        // new route start for apge panel
        //   for shopping view
        Route::get('/order/details/{id}', [AgentPanelController::class, 'OrderDetails'])->name('order_details');
    });
    //======================================= Agent All Route Group List End ==================================//

 // search preoducd for agent panel
Route::get('admin/product/search/agent-search/{value}', [AgentPanelController::class, 'searchProductWithAjax']);