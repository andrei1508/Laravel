<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

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
    return view('welcome2');
});

Route::get('/login', function () {
    return view('users/login');
})->name('login');

Route::post('/users/login',[LoginController::class, 'login'])->name('users.login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/users/create', function () {
        return view('users/create_user');
    })->name('users.create');
    Route::get('/users', [UserController::class, 'viewIndex'])->name('users.index');

    Route::post('/users', [UserController::class, 'viewStore'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'viewShow'])->name('users.show');
    Route::put('/users/{user}', [UserController::class, 'viewUpdate'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'viewDestroy'])->name('users.destroy');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

    Route::get('/users/search', [UserController::class, 'searchBy'])->name('users.search');

});
