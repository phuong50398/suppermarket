<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

// /admin


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('wellcome','admin\WellcomeController@index')->name('wellcome');
    Route::resource('categoryGroup', 'admin\CategoryGroupController');
    Route::resource('category', 'admin\CategoryController');
    Route::resource('categoryType', 'admin\CategoryTypeController');
    Route::resource('product', 'admin\ProductController');
    Route::resource('billImport', 'admin\BillImportController');
    Route::resource('billExport', 'admin\BillExportController');
    Route::get('warehouse', 'admin\WarehouseController@index');
    Route::resource('sale', 'admin\SaleController');

    // ajax
    Route::post('ajaxSaveClassify','admin\ProductController@ajaxSaveClassify');
    Route::post('ajaxSaveProvider','admin\BillImportController@ajaxSaveProvider');
});


Route::get('/', 'user\HomeController@index');
Route::get('category/{slug}', 'user\ListProductController@index');



Route::get('/home', 'HomeController@index')->name('home');
Route::get('/{slug}', 'user\ProductController@index');
