<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ModulesController;
use App\Http\Controllers\User_PrivsController;
use App\Http\Controllers\ReferensiController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('register', [RegisteredUserController::class, 'store']);
});

Route::prefix('roles')->group(function(){
    Route::get('/data', [RolesController::class, 'index'])->name('dashboardRoles');
    Route::get('/api/data', [RolesController::class, 'getData'])->name('apiDataRoles');
    Route::get('/api/data/{id}', [RolesController::class, 'getRoleById']); 
    Route::post('/store/{id?}', [RolesController::class, 'storeOrUpdate'])->name('storeRoles');
    Route::delete('/{id?}', [RolesController::class, 'destroy'])->name('deleteRoles');
});

Route::prefix('users')->group(function(){
    Route::get('/data', [UsersController::class, 'index'])->name('dashboardUsers');
    Route::get('/api/data', [UsersController::class, 'getData'])->name('apiDataUsers');
    Route::get('/api/data/{id}', [UsersController::class, 'getUserById']); 
    Route::post('/store/{id?}', [UsersController::class, 'storeOrUpdate'])->name('storeUsers');
    Route::delete('/{id?}', [UsersController::class, 'destroy'])->name('deleteUsers');
});

Route::prefix('modules')->group(function(){
    Route::get('/data', [ModulesController::class, 'index'])->name('dashboardModules');
    Route::get('/api/data', [ModulesController::class, 'getData'])->name('apiDataModules');
    Route::get('/api/data/{id}', [ModulesController::class, 'getModuleById']); 
    Route::post('/store/{id?}', [ModulesController::class, 'storeOrUpdate'])->name('storeModules');
    Route::delete('/{id?}', [ModulesController::class, 'destroy'])->name('deleteModules');
});

Route::prefix('user_privs')->group(function(){
    Route::get('/data', [User_PrivsController::class, 'index'])->name('dashboardUser_Privs');
    Route::get('/api/data', [User_PrivsController::class, 'getData'])->name('apiDataUser_Privs');
    Route::get('/api/data/{id}', [User_PrivsController::class, 'getModuleById']); 
    Route::post('/store/{id?}', [User_PrivsController::class, 'storeOrUpdate'])->name('storeUser_Privs');
    Route::delete('/{id?}', [User_PrivsController::class, 'destroy'])->name('deleteUser_Privs');
});


Route::prefix('referensi')->group(function(){
    Route::get('/data', [ReferensiController::class, 'index'])->name('referensi');
});

require __DIR__.'/auth.php';
