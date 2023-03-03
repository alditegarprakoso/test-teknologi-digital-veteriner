<?php

use App\Http\Controllers\vendingMachine;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [vendingMachine::class, 'index'])->name('vendingMachine.index');
Route::post('/', [vendingMachine::class, 'store'])->name('vendingMachine.store');
