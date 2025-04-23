<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\MenuPermissionController;
use App\Http\Controllers\ProfileController;
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
Route::get('home', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// Permission Menu Routes
Route::prefix('admin')->middleware('auth')->group(function () {
    // ... other admin routes
    Route::get('/menu-permissions', [App\Http\Controllers\Admin\MenuPermissionController::class, 'index'])->name('admin.menu-permissions.index');
    Route::get('/menu-permissions/{user}', [App\Http\Controllers\Admin\MenuPermissionController::class, 'edit'])->name('admin.menu-permissions.edit');
    Route::put('/menu-permissions/{user}', [App\Http\Controllers\Admin\MenuPermissionController::class, 'update'])->name('admin.menu-permissions.update');
});
//Profile Routes
Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
Route::get('/my-profile', [ProfileController::class, 'show'])->name('my-profile');
// Routes for editing existing details
Route::get('/my-profile/professional/edit', [ProfileController::class, 'editProfessional'])->name('profile.edit-professional');
Route::get('/my-profile/contact/edit', [ProfileController::class, 'editContact'])->name('profile.edit-contact');
Route::get('/my-profile/finance/edit', [ProfileController::class, 'editFinance'])->name('profile.edit-finance');

// Routes for adding new details
Route::get('/my-profile/professional/create', [ProfileController::class, 'createProfessional'])->name('profile.create-professional');
Route::get('/my-profile/contact/create', [ProfileController::class, 'createContact'])->name('profile.create-contact');
Route::get('/my-profile/finance/create', [ProfileController::class, 'createFinance'])->name('profile.create-finance');

// Adjusted update routes (no longer nested under /my-profile)
Route::put('/professional', [ProfileController::class, 'updateProfessionalDetails'])->name('profile.update-professional');
Route::put('/contact', [ProfileController::class, 'updateContactDetails'])->name('profile.update-contact');
Route::put('/finance', [ProfileController::class, 'updateFinanceDetails'])->name('profile.update-finance');
Route::post('/professional', [ProfileController::class, 'storeProfessionalDetails'])->name('profile.store-professional');
Route::post('/contact', [ProfileController::class, 'storeContactDetails'])->name('profile.store-contact');
Route::post('/finance', [ProfileController::class, 'storeFinanceDetails'])->name('profile.store-finance'); 
