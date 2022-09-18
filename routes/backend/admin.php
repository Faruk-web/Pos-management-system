<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminUserController;
use App\Http\Controllers\Backend\AuthenticatedSessionController;





Route::get('/get/donut', [AdminController::class, 'DoughnutChartOne']);

//for BarChart
Route::get('/get/bar', [AdminController::class, 'barChart']);

// for morris donut chart
Route::get('/get/morris', [AdminController::class, 'morrisChart']);

//for pie chart
Route::get('/get/pie', [AdminController::class, 'pieChart']);


Route::prefix('/admin')->name('admin.')->group(function () {
    // admin profile route
    Route::get('/profile', [AdminProfileController::class, 'AdminProfile'])->name('admin_profile_view');
    Route::get('/agent/profile', [AdminProfileController::class, 'AgentProfile'])->name('agent_profile_view');
    // admin profile Edit route
    Route::get('/profile/edit', [AdminProfileController::class, 'AdminProfileEdit'])->name('admin_profile_edit');
    ////Admin Profile edit store route
    Route::post('/profile/store', [AdminProfileController::class, 'AdminProfileStore'])->name('profile.store');
    ////Admin password change
    Route::get('/change/password', [AdminProfileController::class, 'AdminChangePassword'])->name('admin_change_password');
    ////Admin update password
    Route::post('/update/change/password', [AdminProfileController::class, 'AdminUpdateChangePassword'])->name('update.change.password');
    ////Admin update password
    // Route::post('/update/change/password', [AdminProfileController::class, 'AdminUpdateChangePassword'])->name('update.change.password');
});

//Admin All user role###########################################################################
    Route::prefix('adminuserrole')->middleware('routePermission')->group(function () {
        Route::get('/all', [AdminUserController::class, 'AllAdminRole'])->name('all.admin.user');
        Route::get('/add', [AdminUserController::class, 'AddAdminRole'])->name('add.admin');
        Route::get('/emp.permision', [AdminUserController::class, 'EmpPermison'])->name('emp.permision');
        Route::get('/sup.permision', [AdminUserController::class, 'SupPermison'])->name('sup.permision');
        Route::post('/store', [AdminUserController::class, 'StoreAdminRole'])->name('admin.user.store');
        Route::post('/employee/permision/store', [AdminUserController::class, 'employeePermissionSotre'])->name('emp.permision.store');

        Route::get('/shopOwner_permision', [AdminUserController::class, 'shopOwnerPermission'])->name('shopOwner.permision');
        Route::post('/shopOwner_permision/store', [AdminUserController::class, 'shopOwnerPermissionStore'])->name('shopOwner.permision.store');


        Route::get('/agent_panel', [AdminUserController::class, 'AgentPermission'])->name('agent_panel.permision');
        Route::post('/agent_panel/store', [AdminUserController::class, 'AgentPermissionStore'])->name('agent_panel.permision.store');

        Route::get('/manager_panel', [AdminUserController::class, 'ManagerPermission'])->name('manager_panel.permision');
        Route::post('/manager_panel/store', [AdminUserController::class, 'ManagerPermissionStore'])->name('manager_panel.permision.store');

        Route::post('/supplier/store', [AdminUserController::class, 'StoreSupplierRole'])->name('admin.supplier.store');
        Route::get('/edit/{id}', [AdminUserController::class, 'EditAdminRole'])->name('edit.admin.user');
        Route::post('/update', [AdminUserController::class, 'UpdateAdminRole'])->name('admin.user.update');
        Route::get('/employee/edit/{id}', [AdminUserController::class, 'EditEmployeeRole'])->name('edit.employee.user');

        Route::post('/employee/update', [AdminUserController::class, 'updateEmployeePermission'])->name('employee.user.update');
        Route::get('/delete/{id}', [AdminUserController::class, 'DeleteAdminRole'])->name('delete.admin.user');
    }); // All user role