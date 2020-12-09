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

//Route::get('/vue/{any}', function () {
//    return view('vue');
//})->where('any', '.*');


// Authentication Routes...
Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Registration Routes...
Route::get('register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

Route::get('/inactive', [App\Http\Controllers\User\UserController::class, 'inactive'])->name('inactive')->middleware('auth');

Route::middleware(['auth', 'inactive'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/admin/employee/create', [App\Http\Controllers\Admin\EmployeeController::class, 'showCreateForm'])->name('create-employee-form');
    Route::post('/admin/employee/create', [App\Http\Controllers\Admin\EmployeeController::class, 'create'])->name('create-employee');

    Route::get('/admin/employee/{index?}', [App\Http\Controllers\Admin\EmployeeController::class, 'index'])->name('show-employees');

    Route::get('/admin/employee/{id}/edit', [App\Http\Controllers\Admin\EmployeeController::class, 'showEditEmployeeForm'])->name('edit-employee-form');
    Route::post('/admin/employee/{id}/edit', [App\Http\Controllers\Admin\EmployeeController::class, 'editEmployee'])->name('edit-employee');

    Route::get('/admin/employee/{id}/edit/address', [App\Http\Controllers\Admin\EmployeeController::class, 'showEditAddressForm'])
        ->name('edit-employee-address-form');
    Route::post('/admin/employee/{id}/edit/address', [App\Http\Controllers\Admin\EmployeeController::class, 'editAddress'])
        ->name('edit-employee-address');

    Route::get('/admin/employee/{id}/edit/contract', [App\Http\Controllers\Admin\EmployeeController::class, 'showEditContract'])
        ->name('edit-employee-contract-form');
    Route::post('/admin/employee/{id}/edit/contract', [App\Http\Controllers\Admin\EmployeeController::class, 'editContract'])
        ->name('edit-employee-contract');

    Route::get('/admin/employee/{id}/attach/manager', [App\Http\Controllers\Admin\EmployeeController::class, 'showAttachManagerForm'])
        ->name('attach-manager-form');
    Route::post('/admin/employee/{id}/attach/manager', [App\Http\Controllers\Admin\EmployeeController::class, 'attachManager'])
        ->name('attach-manager');

    Route::get('/admin/employee/{id}/detach/manager', [App\Http\Controllers\Admin\EmployeeController::class, 'showDetachManagerForm'])
        ->name('detach-manager-form');
    Route::post('/admin/employee/{id}/detach/manager', [App\Http\Controllers\Admin\EmployeeController::class, 'detachManager'])
        ->name('detach-manager');

    Route::post('/employee/contract/download', [App\Http\Controllers\Admin\EmployeeController::class, 'downloadContract'])
        ->name('download-contract');


    Route::get('/admin/manager/{index?}', [App\Http\Controllers\Admin\ManagerController::class, 'index'])->name('admin-show-managers');
    Route::get('/admin/manager/{id}/show', [App\Http\Controllers\Admin\ManagerController::class, 'showManager'])->name('show-manager');

    Route::get('/manager/{index?}', [App\Http\Controllers\Manager\ManagerController::class, 'index'])->name('show-managers');
    Route::post('/manager/contract/download', [App\Http\Controllers\Manager\ManagerController::class, 'showContract'])
        ->name('show-contract');
});

