<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\HomeController;

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
    return view('login');
});
Route::group(['middleware' => ['auth']], function() {
    // your routes
    Route::resource('companies',CompanyController::class);
    Route::resource('employees',EmployeeController::class);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/employeerecycle', [EmployeeController::class, 'recycledata'])->name('employeerecycle');
    Route::get('/employee/active/{id}', [EmployeeController::class, 'active'])->name('employees.active');

    Route::get('/companyrecycle', [CompanyController::class, 'recycledata'])->name('companyrecycle');
    Route::get('/company/active/{id}', [CompanyController::class, 'active'])->name('companies.active');
    Route::get('/logout', [LogoutController::class,'perform'])->name('logout');
});

Auth::routes(['register'=>false]);


