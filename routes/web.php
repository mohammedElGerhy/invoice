<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();
//Auth::routes(['register' => false]);//this code close of register
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('invoices', 'InvoiceController');
Route::resource('sections', 'SectionController');
Route::resource('products', 'ProductsController');
Route::get('/section/{id}', 'InvoiceController@getproducts');
Route::get('/InvoicesDetails/{id}', 'InvoicesDetailsController@edit');
//

Route::resource('InvoiceAttachments', 'InvoiceAttachmentsController');
Route::resource('InvoicesDetails', 'InvoicesDetailsController');
Route::get('download/{invoice_number}/{file_name}', 'InvoicesDetailsController@get_file');

Route::get('View_file/{invoice_number}/{file_name}', 'InvoicesDetailsController@open_file');

Route::post('delete_file', 'InvoicesDetailsController@destroy')->name('delete_file');

Route::get('/edit_invoice/{id}', 'InvoiceController@edit');

Route::get('/Status_show/{id}', 'InvoiceController@show')->name('Status_show');

Route::post('/Status_Update/{id}', 'InvoiceController@Status_Update')->name('Status_Update');
Route::get('Print_invoice/{id}','InvoiceController@Print_invoice');
Route::get('Invoice_Paid','InvoiceController@Invoice_Paid');

Route::get('Invoice_UnPaid','InvoiceController@Invoice_UnPaid');

Route::get('Invoice_Partial','InvoiceController@Invoice_Partial');

Route::resource('Archive', 'InvoiceAchiveController');
Route::get('export_invoices', 'InvoiceController@export');
Route::get('/section/{id}', 'InvoiceController@getproducts');



Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');

});
Route::get('invoices_report', 'Invoices_Report@index');

Route::post('Search_invoices', 'Invoices_Report@Search_invoices')->name("Search_invoices");

Route::get('customers_report', 'Customers_Report@index')->name("customers_report");

Route::post('Search_customers', 'Customers_Report@Search_customers')->name("Search_customers");

Route::get('MarkAsRead_all','InvoiceController@MarkAsRead_all')->name('MarkAsRead_all');

Route::get('unreadNotifications_count', 'InvoicesController@unreadNotifications_count')->name('unreadNotifications_count');

Route::get('unreadNotifications', 'InvoicesController@unreadNotifications')->name('unreadNotifications');
