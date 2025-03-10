<?php

use App\Http\Controllers\CheckingConditions;
use App\Http\Controllers\Rules\Rules;
use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [Rules::class ,'index'])->name('index');

Route::get('create', [Rules::class ,'create'])->name('create');

Route::post('store', [Rules::class ,'store'])->name('store');

//Route::get('edit/{id}', [Rules::class ,'edit'])->name('edit');

//Route::POST('update/{id}', [Rules::class ,'update'])->name('update');

Route::GET('check/{id}', [CheckingConditions::class ,'check'])->name('check');
