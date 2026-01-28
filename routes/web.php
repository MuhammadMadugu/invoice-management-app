<?php

use Illuminate\Support\Facades\Route;
use App\HTTP\Controllers\invoiceController;
use App\Http\Controllers\InvoiceFileController;

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
    return view('welcome');
});


Route::get('/invoice', [InvoiceController::class, 'index'])->name('invoices.index');
Route::get('/invoice/add', [invoiceController::class,'create'])->name('invoices.create');
Route::get('/invoice/edit/{id}', [invoiceController::class,'modify']);
Route::get('/invoice/show/{id}', [invoiceController::class,'show']);

Route::post('/invoice/store', [invoiceController::class,'store']);

Route::put('/invoice/update/{id}', [InvoiceController::class, 'update'])->name('invoices.update');

Route::put('/invoice/updateStatus/{id}', [InvoiceController::class, 'update_status'])->name('invoices.update_status');


Route::delete('/invoice/{id}', [InvoiceController::class, 'destroy']);


Route::post('/invoice/{invoice}/files', [InvoiceController::class, 'uploadFile'])
    ->name('invoices.files.upload');

Route::delete('/invoice/files/{file}', [InvoiceController::class, 'deleteFile'])
    ->name('invoices.files.delete');


    // Delete a file
Route::delete('/invoices/files/{id}', [InvoiceFileController::class, 'destroy'])
     ->name('invoices.files.delete');
 