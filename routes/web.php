<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\PermissionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth', 'role:SuperAdmin'])->name('admin.')->prefix('admin')->group(function () {    
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::resource('inventory',InventoryController::class);
    Route::resource('sales',SalesController::class);
    Route::get('getInventoryPrice/{inventoryId}', [SalesController::class,'getInventoryPrice'])->name('getInventoryPrice');
    Route::resource('purchase',PurchaseController::class);
    Route::resource('user',UserController::class);
    Route::resource('role',RoleController::class);
    Route::resource('permission',PermissionController::class);
    Route::get('/role/role-permission/{id}',[RoleController::class,'rolePermission'])->name('role.permission');
    Route::post('/role/givepermission/{role}',[RoleController::class,'givePermission'])->name('role.givepermission');    
    Route::delete('/role/{roles}/revoke-permission/{permission}',[RoleController::class,'revokePermission'])->name('role.revokepermission'); 
    Route::get('export-sales',[SalesController::class,'export'])->name('excel.sales');
    Route::get('export-purchase',[PurchaseController::class,'export'])->name('excel.purchase');
});

Route::middleware(['auth', 'role:Sales'])->name('sales.')->prefix('sales')->group(function () {      
    Route::resource('sales',SalesController::class);     
    Route::get('getInventoryPrice/{inventoryId}', [SalesController::class,'getInventoryPrice'])->name('getInventoryPrice');    
});

Route::middleware(['auth', 'role:Purchase'])->name('purchases.')->prefix('purchases')->group(function () {      
    Route::resource('purchase',PurchaseController::class);     
    Route::get('getInventoryPrice/{inventoryId}', [SalesController::class,'getInventoryPrice'])->name('getInventoryPrice');    
});

Route::middleware(['auth', 'role:Manager'])->name('manager.')->prefix('manager')->group(function () {      
    Route::get('sales',[SalesController::class,'index'])->name('sale.index');
    Route::get('purchase',[PurchaseController::class,'index'])->name('purchase.index');
    Route::get('export-sales',[SalesController::class,'export'])->name('excel.sales');
    Route::get('export-purchase',[PurchaseController::class,'export'])->name('excel.purchase');
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
