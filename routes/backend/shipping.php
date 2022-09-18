<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ShippingCountriesController;
use App\Http\Controllers\Backend\ShippingStatesController;
use App\Http\Controllers\Backend\ShippingCitiesController;
use App\Http\Controllers\Backend\ShippingZoneController;
use App\Http\Controllers\Backend\ShippingAreaController;


    // Admin Coupon  Route Group
    Route::prefix('shipping')->group(function () {
        /// ship Division
        Route::get('/division/view', [ShippingAreaController::class, 'DivisionView'])->name('manage.division');
        Route::post('/division/store', [ShippingAreaController::class, 'DivisionStore'])->name('division.store');
        Route::get('/division/edit/{id}', [ShippingAreaController::class, 'DivisionEdit'])->name('division.edit');
        Route::post('/division/update/{id}', [ShippingAreaController::class, 'DivisionUpdate'])->name('division.update');
        Route::get('/division/delete/{id}', [ShippingAreaController::class, 'DivisionDelete'])->name('division.delete');

        /// ship District
        Route::get('/district/view', [ShippingAreaController::class, 'DistrictView'])->name('manage.district');
        /// ship District
        Route::get('/district/view', [ShippingAreaController::class, 'DistrictView'])->name('manage.district');
        Route::post('/district/store', [ShippingAreaController::class, 'DistrictStore'])->name('district.store');
        Route::get('/district/edit/{id}', [ShippingAreaController::class, 'DistrictEdit'])->name('district.edit');
        Route::post('/district/update/{id}', [ShippingAreaController::class, 'DistricUpdate'])->name('district.update');
        Route::get('/district/delete/{id}', [ShippingAreaController::class, 'DistricDelete'])->name('district.delete');
        Route::get('/district/delete/{id}', [ShippingAreaController::class, 'DistricDelete'])->name('district.delete');
        /// Ship State
        Route::get('/state/view', [ShippingAreaController::class, 'StateView'])->name('manage.state');
        Route::post('/state/store', [ShippingAreaController::class, 'StateStore'])->name('state.store');
        Route::get('/state/edit/{id}', [ShippingAreaController::class, 'StateEdit'])->name('state.edit');
        Route::post('/state/update/{id}', [ShippingAreaController::class, 'StateUpdate'])->name('state.update');
        Route::get('/state/delete/{id}', [ShippingAreaController::class, 'StateDelete'])->name('state.delete');
    });

   // Shipping Zone & Shipping Information
   Route::prefix('shipping_zone')->group(function () {
    Route::get('/view', [ShippingZoneController::class, 'ShippingZoneAdd'])->name('shipping_zone.view');
    Route::get('/information_view', [ShippingZoneController::class, 'ShippingZoneInformationAdd'])->name('shipping_zone.information_view');
});
  //  Shipping Countries
  Route::prefix('shipping_countries')->group(function () {
    Route::get('/view', [ShippingCountriesController::class, 'Shipping_CountriesAdd'])->name('shipping_countries.view');
});
//  Shipping States
Route::prefix('shipping_states')->group(function () {
    Route::get('/view', [ShippingStatesController::class, 'Shipping_StatesAdd'])->name('shipping_states.view');
});
   //  Shipping Cities
   Route::prefix('shipping_cities')->group(function () {
    Route::get('/view', [ShippingCitiesController::class, 'ShippingCitiesAdd'])->name('shipping_cities.view');
});