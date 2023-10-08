<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\SalesController;

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
    // Route::resource('user',UserController::class);
    // Route::resource('role',RoleController::class);
    // Route::resource('permission',PermissionController::class);
    // Route::get('/role/role-permission/{id}',[RoleController::class,'rolePermission'])->name('role.permission');
    // Route::post('/role/givepermission/{role}',[RoleController::class,'givePermission'])->name('role.givepermission');    
    // Route::delete('/role/{roles}/revoke-permission/{permission}',[RoleController::class,'revokePermission'])->name('role.revokepermission'); 
});

Route::middleware(['auth', 'role:Sales'])->name('sales.')->prefix('sales')->group(function () {      
    Route::resource('sales',SalesController::class);     
    Route::get('getInventoryPrice/{inventoryId}', [SalesController::class,'getInventoryPrice'])->name('getInventoryPrice');
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
