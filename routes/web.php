<?php

use App\Http\Controllers\WhatshappController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth'])->group( function() {
    Route::get('/index', function() {
        return view('main');
    })->name('main');
    Route::resource('/whatshapp', WhatshappController::class);
    Route::get('contact', [WhatshappController::class, 'contact'])->name('contact');
    Route::get('list-contact', [WhatshappController::class, 'listContact'])->name('listContact');
    Route::get('/selectUserId/{id}', [WhatshappController::class, 'selectUserId']);
});

require __DIR__.'/auth.php';
