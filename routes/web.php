<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Frontend\IndexController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    $id = Auth::user() -> id;
    $user = User::find($id);
    return view('dashboard', compact('user'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



/* ---------------------------------Backend Admin Route--------------------------------- */

Route::prefix('admin')->group(function () {
    Route::get('/login',[AdminController::class, 'Index'])->name('login_form');
    Route::post('/login',[AdminController::class, 'Login'])->name('admin.login');
    Route::get('/register',[AdminController::class, 'Register'])->name('admin.register');
    Route::post('/register',[AdminController::class, 'RegisterCreate'])->name('admin.register.create');

    Route::middleware('admin')->group(function () {
        Route::get('/dashboard',[AdminController::class, 'Dashboard'])->name('admin.dashboard');
        Route::get('/logout',[AdminController::class, 'Logout'])->name('admin.logout');

        Route::get('/profile',[AdminController::class, 'AdminProfile'])->name('admin.profile');
        Route::post('/profile',[AdminController::class, 'AdminProfileStore'])->name('admin.profile.store'); 
        Route::get('/profile/edit',[AdminController::class, 'AdminProfileEdit'])->name('admin.profile.edit');    

        Route::get('/change/password',[AdminController::class, 'AdminChangePassword'])->name('admin.change.password');    
        Route::post('/change/password',[AdminController::class, 'AdminUpdatePassword'])->name('update.change.password');
    });    
});


//Profile Routes
// Route::controller(AdminProfileController::class) -> group(function(){
//     Route::get('/about/page', 'AboutPage') -> name('about.page');
    
//  });

/* ------------------------------End Backend Admin Route--------------------------------- */


/* ---------------------------------Frontend Admin Route--------------------------------- */
Route::get('/',[IndexController::class, 'Index']) -> name('index'); 
Route::get('/user/logout',[IndexController::class, 'UserLogout']) -> name('user.logout'); 
Route::get('/user/profile',[IndexController::class, 'UserProfile']) -> name('user.profile'); 
Route::post('/user/profile',[IndexController::class, 'UserProfileStore']) -> name('user.profile.store'); 
Route::get('/user/change/password',[IndexController::class, 'UserChangePassword']) -> name('change.password'); 
Route::post('/user/change/password',[IndexController::class, 'UserPasswordUpdate']) -> name('user.password.update'); 
/* ------------------------------End Frontend Admin Route--------------------------------- */