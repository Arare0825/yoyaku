<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MUserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\TimeController;

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

//ログイン処理
Route::get('/login', [MuserController::class, 'index'])->name('login');
Route::post('/login/store', [MUserController::class, 'store'])->name('login.store');
Route::get('/login/show', [MUserController::class, 'show'])->name('login.show');

Route::get('/test',function(){
    return view('test');
});

// Route::get('/group',[GroupController::class,'index'])->name('group');
// Route::get('/group/create',[GroupController::class,'create'])->name('group.create');
// Route::post('/group/store',[GroupController::class,'store'])->name('group.store');

//グループ作成
Route::group(['middleware' => 'auth'], function () {
    Route::get('/group',[GroupController::class,'index'])->name('group');
    Route::get('/group/create',[GroupController::class,'create'])->name('group.create');
    Route::post('/group/store',[GroupController::class,'store'])->name('group.store');
    Route::get('/group/{id}/edit',[GroupController::class,'edit'])->name('group.edit');
    Route::post('/group/update',[GroupController::class,'update'])->name('group.update');
    Route::post('/group/{id}',[GroupController::class,'destroy'])->name('group.destroy');
});

//施設作成
Route::group(['middleware'=> 'auth'],
function(){
    Route::get('/facility',[FacilityController::class,'index'])->name('facility');
    Route::post('/facility/store',[FacilityController::class,'store'])->name('facility.store');
    Route::get('/facility/{id}/edit',[FacilityController::class,'edit'])->name('facility.edit');
    Route::post('/facility/update',[FacilityController::class,'update'])->name('facility.update');
    Route::post('/facility/{id}',[FacilityController::class,'destroy'])->name('facility.destroy');
});

//予約枠作成
Route::group(['middleware'=> 'auth'],
function(){
    Route::get('/time',[TimeController::class,'index'])->name('time');
    Route::post('/time/store',[TimeController::class,'store'])->name('time.store');
    Route::get('/time/{id}/edit',[TimeController::class,'edit'])->name('time.edit');
    Route::post('/time/update',[TimeController::class,'update'])->name('time.update');
    Route::post('/time/{id}',[TimeController::class,'destroy'])->name('time.destory');
});