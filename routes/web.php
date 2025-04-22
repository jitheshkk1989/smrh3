<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\MenuPermissionController;
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
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// Permission Menu Routes
Route::prefix('admin')->middleware('auth')->group(function () {
    // ... other admin routes
    Route::get('/menu-permissions', [App\Http\Controllers\Admin\MenuPermissionController::class, 'index'])->name('admin.menu-permissions.index');
    Route::get('/menu-permissions/{user}', [App\Http\Controllers\Admin\MenuPermissionController::class, 'edit'])->name('admin.menu-permissions.edit');
    Route::put('/menu-permissions/{user}', [App\Http\Controllers\Admin\MenuPermissionController::class, 'update'])->name('admin.menu-permissions.update');
});