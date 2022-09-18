<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\EmployeerController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\AuthenticatedSessionController;
use App\Http\Controllers\Backend\EmployeeSalary;
use App\Http\Controllers\Backend\DepartmentController;

// employeer prefix route
Route::group(['prefix' => 'employeer', 'middleware' => ['employeer:employeer']], function () {
    Route::get('/login', [EmployeerController::class, 'loginForm'])->name('employeer.loginForm');
    Route::post('/login', [EmployeerController::class, 'store'])->name('employeer.login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->middleware(array_filter([
            'guest:employeer'
        ]));
});
Route::prefix('employeer')->middleware('routePermission')->group(function () {
    Route::get('/view', [EmployeeController::class, 'EmployeeView'])->name('employee.view');
    Route::get('/addform', [EmployeeController::class, 'EmployeeAddForm'])->name('employee.addform');
    Route::post('/store', [EmployeeController::class, 'EmployeeStore'])->name('employee.store');
    // Edit Employee
    Route::get('/edit/{id}', [EmployeeController::class, 'EmployeeEdit'])->name('employee.edit');
    // Upadte Employee
    Route::post('/update', [EmployeeController::class, 'EmployeeUpdate'])->name('employee.update');

    //Employee Full View
    Route::get('/details/{id}', [EmployeeController::class, 'EmployeeDetails'])->name('employee.details');

    Route::get('/delete/{id}', [EmployeeController::class, 'EmployeetDelete'])->name('employee.delete');

    //Employee Tracking System
    Route::get('/activity', [EmployeeController::class, 'EmployeeTracking'])->name('empActivity.count');

    // Employee All Multi File route
    // For Multiple Img Update
    Route::post('/update/multiimg', [EmployeeController::class, 'UpdateEmployeeMultiImg'])->name('update_employee_img');
    // for Multipart Deleted
    Route::get('/multiimg/delete/{id}', [EmployeeController::class, 'MultiImageDelete'])->name('employee.multiimg.delete');



    //======================= tracking  employee route start===================
    Route::get('/trackingHistory', [EmployeeController::class, 'trackingHistory'])->name('trackingHistory');
    Route::get('/addTrackingHistory/{id}', [EmployeeController::class, 'addTrackingHistory'])->name('addTrackingHistory');
    Route::get('/updateTrackingHistory/{id}', [EmployeeController::class, 'updateTrackingHistory'])->name('updateTrackingHistory');
    Route::get('/deleteTrackingHistory/{id}', [EmployeeController::class, 'deleteTrackingHistory'])->name('deleteTrackingHistory');
});

Route::middleware(['auth:employeer'])->group(function () {
    // employeer Route
    Route::get('/employeer/dashboard', function () {

        return view('admin.index');
    })->name('employeer.dashboard');

    Route::get('employeer/logout', [AuthenticatedSessionController::class, 'employeerDestroy'])->name('employeer.logout');
});

    // for department employee salary
    Route::prefix('salary')->middleware('routePermission')->group(function () {

        Route::get('/add', [EmployeeSalary::class, 'AddSalary'])->name('salary-add');
        Route::get('/get_employee/{id}', [EmployeeSalary::class, 'getEmployee'])->name('get.employee');
        Route::post('/get_employee', [EmployeeSalary::class, 'find'])->name('employee.find');
        Route::post('/salary_payment', [EmployeeSalary::class, 'getSalary'])->name('payment_salary');
        Route::get('/paid_salary', [EmployeeSalary::class, 'paidSalary'])->name('paid_salary');
    });

    Route::prefix('department')->group(function () {
        Route::get('/view', [DepartmentController::class, 'DepartmentView'])->name('department.view');
        Route::post('/store', [DepartmentController::class, 'DepartmentStore'])->name('department.store');
        Route::post('/edit', [DepartmentController::class, 'DepartmentEdit'])->name('department.edit');
        Route::post('/update', [DepartmentController::class, 'DepartmentUpdate'])->name('department.update');
        Route::delete('/delete/{id}', [DepartmentController::class, 'DepartmentDelete'])->name('department.delete');
    });