<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MUserController;
use App\Http\Controllers\GroupController;

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
    return view('welcome');
});

// Route::post('login', function () {
//     return view('login');
// });

Route::get('/login', [MuserController::class, 'index'])->name('login');

Route::post('/login/store', [MUserController::class, 'store'])->name('login.store');
// Route::post('/login/store', [MUserController::class, 'store'])->name('login.store');
Route::get('/login/show', [MUserController::class, 'show'])->name('login.show');

Route::get('/test',function(){
    return view('test');
});

Route::get('/group',[GroupController::class,'index'])->name('group');
Route::get('/group/create',[GroupController::class,'create'])->name('group.create');
Route::post('/group/store',[GroupController::class,'store'])->name('group.store');