<?php

use Illuminate\Http\Request;
use App\Product;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('invoice','InvoiceController');
Route::resource('payment_lineitems','PaymentLineItemController');
Route::resource('purchase_lineitems','PurchaseLineItemController');

Route::get('products', function (Request $request) {
	return \App\Product::all()->toArray();
});

Route::post('search', function (Request $request) {
	$Invoices = \App\Invoice::where('invoice_num', 'like', "%" . $request->term . "%")->paginate();
    return $Invoices->toArray();
});

