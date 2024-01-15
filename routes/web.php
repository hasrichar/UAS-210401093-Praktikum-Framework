<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObatController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
 
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});
 
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::get('/',[ObatController::class,'index']);
Route::get('/search',[ObatController::class,'search']);

Route::get('/obats/create', [ObatController::class, 'create'])->name('obats.create');
Route::get('/obats', [ObatController::class, 'index'])->name('index');
Route::resource('obats', ObatController::class);

Route::get('/obats/{id}/edit', [ObatController::class, 'edit'])->name('obats.edit');
Route::put('/obats/{id}', [ObatController::class, 'update'])->name('obats.update');