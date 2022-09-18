<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ManagerController;

  /// ===================================== manager panel route new=============================================
  Route::prefix('manager')->name('manager_panel.')->middleware('routePermission')->group(function () {
    Route::get('/dashboard_manager', [ManagerController::class, 'managerDashboard'])->name('manager_dashboard');
    Route::get('/agent/commission', [ManagerController::class, 'agentCommission'])->name('agent_commission');
    // payment statemnt
    Route::get('/agent/commission/payment/view/data/{id}', [ManagerController::class, 'agentCommissionPaymentViewData'])->name('agent_commission_payment_view_data');
    Route::post('/agent/commission/payment/{id}', [ManagerController::class, 'agentCommissionPayment'])->name('agent_commission_payment');
    Route::get('/agent/commission/payment/view/{id}', [ManagerController::class, 'agentCommissionPaymentview'])->name('agent_commission_payment_view');
    // payment statement end
    Route::get('/agent/order', [ManagerController::class, 'agentOrderHistory'])->name('agent_order_history');
    Route::get('/addManager', [ManagerController::class, 'index'])->name('manager');
    Route::get('/agentManagerEdit/{agent_id}', [ManagerController::class, 'agentManagerEdit']);
    Route::post('/agentManagerUpdate/{agent_id}', [ManagerController::class, 'agentManagerUpdate']);


    Route::get('/Manager/list', [ManagerController::class, 'ManagerView'])->name('ManagerView');
    Route::post('/managerStore', [ManagerController::class, 'managerStore'])->name('managerStore');
    Route::get('/show/customer', [ManagerController::class, 'addShow'])->name('addShow');
    Route::get('/delete/customer/{id}', [ManagerController::class, 'deleteCustomer'])->name('deleteCustomer');


    Route::get('/Manager/customer', [ManagerController::class, 'customerList'])->name('customerList');

    // customer all order list
    Route::get('/agent/all/customer/order/list/{order_id}', [ManagerController::class, 'AgentOrdercustomerList'])->name('all_customer_order');
});