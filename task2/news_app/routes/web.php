<?php

use App\Http\Controllers\NewsController;
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

Route::get('/', [NewsController::class, 'ShowMainPage']);

Route::get('/create', [NewsController::class, 'CreateNews']);

Route::get('/delete', [NewsController::class, 'DeleteNews']);

Route::get('/news', [NewsController::class, 'ShowNews']);

// роут для работы с post запросом размещен в api.php
