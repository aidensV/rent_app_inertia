<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::group([
    'namespace' => 'App\Http\Controllers\Admin',
    'prefix' => 'admin',
    'middleware' => ['auth'],
], function () {
    Route::resource('user', 'UserController');
    Route::resource('role', 'RoleController');
    Route::resource('tool-manage', 'ToolManageController');
    Route::resource('form-clearance', 'FormclearanceController');
    Route::resource('lab-manage', 'LabController');
    Route::resource('peminjaman-alat','PeminjamanAlatController');
    Route::resource('peminjaman', 'TransactionController');
    Route::resource('permission', 'PermissionController');
    Route::get('peminjaman/report/{id}', 'TransactionController@reportPdf')->name('peminjaman.report');
    Route::get('peminjaman/closed/{id}', 'TransactionController@closed')->name('peminjaman.closed');
    Route::get('edit-account-info', 'UserController@accountInfo')->name('admin.account.info');
    Route::post('edit-account-info', 'UserController@accountInfoStore')->name('admin.account.info.store');
    Route::post('change-password', 'UserController@changePasswordStore')->name('admin.account.password.store');
    Route::resource('kritik', 'KritikController');
    Route::get('kontak',function()
    {
        return Inertia::render('Admin/Kontak/Index');
    })->name('kontak.index');
});
