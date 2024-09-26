<?php

use App\Http\Controllers\CustomController;
use App\Http\Controllers\TableAController;
use App\Http\Controllers\TableBController;
use App\Http\Controllers\TableCController;
use App\Http\Controllers\TableDController;
use Illuminate\Support\Facades\Route;

// Main index page showing data from tables A, B, C, and D
Route::get('/', [CustomController::class, 'index'])->name('index');

// Routes for exporting data
Route::get('/export/excel', [CustomController::class, 'exportExcel'])->name('export.excel');
Route::get('/export/pdf', [CustomController::class, 'exportPDF'])->name('export.pdf');

// Routes for importing data from Excel (common for all tables)
Route::post('/import/excel', [CustomController::class, 'importExcel'])->name('import.excel');

// Routes for Table A
Route::get('/table-a/data', [CustomController::class, 'getTableAData'])->name('table_a.data');
Route::post('/table-a/import', [CustomController::class, 'importTableA'])->name('table_a.import');
Route::get('/table-a/export', [CustomController::class, 'exportTableA'])->name('table_a.export');
Route::delete('table-a/delete/{id}', [CustomController::class, 'deleteTableA'])->name('table_a.delete');
Route::get('/edit-a/{id}', [CustomController::class, 'editA'])->name('edit.a');
Route::put('/table-a/update/{id}', [CustomController::class, 'updateTableA'])->name('table_a.update');
Route::post('/table-a', [CustomController::class, 'insertA'])->name('table_a.store');
Route::get('/tambah-a', [CustomController::class, 'pageTambahA'])->name('tambah.a');
Route::post('/table-a/store-excel', [CustomController::class, 'storeExcelTableA'])->name('table_a.storeExcel');

// Routes for Table B
Route::get('/table-b/data', [CustomController::class, 'getTableBData'])->name('table_b.data');
Route::post('/table-b/import', [CustomController::class, 'importTableB'])->name('table_b.import');
Route::get('/table-b/export', [CustomController::class, 'exportTableB'])->name('table_b.export');
Route::delete('table-b/delete/{id}', [CustomController::class, 'deleteTableB'])->name('table_b.delete');
Route::get('/edit-b/{id}', [CustomController::class, 'editB'])->name('edit.b');
Route::put('/table-b/update/{id}', [CustomController::class, 'updateTableB'])->name('table_b.update');
Route::post('/table-b', [CustomController::class, 'insertB'])->name('table_b.store');
Route::get('/tambah-b', [CustomController::class, 'pageTambahB'])->name('tambah.b');

// Routes for Table C
Route::get('/table-c/data', [CustomController::class, 'getTableCData'])->name('table_c.data');
Route::post('/table-c/import', [CustomController::class, 'importTableC'])->name('table_c.import');
Route::get('/table-c/export', [CustomController::class, 'exportTableC'])->name('table_c.export');
Route::delete('table-c/delete/{id}', [CustomController::class, 'deleteTableC'])->name('table_c.delete');
Route::get('/edit-c/{id}', [CustomController::class, 'editC'])->name('edit.c');
Route::put('/table-c/update/{id}', [CustomController::class, 'updateTableC'])->name('table_c.update');
Route::post('/table-c', [CustomController::class, 'insertC'])->name('table_c.store');
Route::get('/tambah-c', [CustomController::class, 'pageTambahC'])->name('tambah.c');

// Routes for Table D
Route::get('/table-d/data', [CustomController::class, 'getTableDData'])->name('table_d.data');
Route::post('/table-d/import', [CustomController::class, 'importTableD'])->name('table_d.import');
Route::get('/table-d/export', [CustomController::class, 'exportTableD'])->name('table_d.export');
Route::delete('table-d/delete/{id}', [CustomController::class, 'deleteTableD'])->name('table_d.delete');
Route::get('/edit-d/{id}', [CustomController::class, 'editD'])->name('edit.d');
Route::put('/table-d/update/{id}', [CustomController::class, 'updateTableD'])->name('table_d.update');
Route::post('/table-d', [CustomController::class, 'insertD'])->name('table_d.store');
Route::get('/tambah-d', [CustomController::class, 'pageTambahD'])->name('tambah.d');

// Routes for Transaksi
Route::get('/transaksi/data', [CustomController::class, 'getTransaksiData'])->name('transaksi.data');

Route::delete('/delete-a/{id}', [TableAController::class, 'destroy'])->name('table_a.delete');
Route::delete('/delete-b/{id}', [TableBController::class, 'destroy'])->name('table_b.delete');
Route::delete('/delete-c/{id}', [TableCController::class, 'destroy'])->name('table_c.delete');
Route::delete('/delete-d/{id}', [TableDController::class, 'destroy'])->name('table_d.delete');

Route::get('export-a-pdf', 'ExportController@exportAPDF')->name('table_a.export.pdf');
Route::get('export-b-pdf', 'ExportController@exportBPDF')->name('table_b.export.pdf');
Route::get('export-c-pdf', 'ExportController@exportCPDF')->name('table_c.export.pdf');
Route::get('export-d-pdf', 'ExportController@exportDPDF')->name('table_d.export.pdf');
