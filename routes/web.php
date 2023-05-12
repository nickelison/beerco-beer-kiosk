<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MgmtConsoleController;
use App\Http\Controllers\SearchAnalyticsController;

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

// Home page
Route::get('/', [ProductController::class, 'index']);

// Create product page
Route::get('/create', [ProductController::class, 'create'])
->middleware('auth');

// Store product data (actually create product)
Route::post('/products', [ProductController::class, 'store'])
->middleware('auth'); 

// Product (individual) page
Route::get('/products/{product}', [ProductController::class, 'show']);

// Edit product page
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
->middleware('auth');

// Update product data
Route::put('/products/{product}', [ProductController::class, 'update'])
->middleware('auth');

// Delete product
Route::delete('/products/{product}', [ProductController::class, 'destroy'])
->middleware('auth');

// Update product view count
Route::post('/products/updateViewCount', [ProductController::class, 'updateViewCount']);

// Specials page
Route::get('/specials', [ProductController::class, 'specials']);

// Registration page
Route::get('/register', [UserController::class, 'create'])
->middleware('guest');

// Create user
Route::post('/users', [UserController::class, 'store']);

// Login page
Route::get('/login', [UserController::class, 'login'])
->name('login')
->middleware('guest');

// Logout
Route::post('/logout', [UserController::class, 'logout'])
->middleware('auth');

// Authenticate
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

// Management console index page
Route::get('/console', [MgmtConsoleController::class, 'index'])
->middleware('auth');

// Search reports index page
Route::get('/console/reports', [MgmtConsoleController::class, 'reports'])
->middleware('auth');

// Delete all search report data
Route::post('/reports/deleteall', [SearchAnalyticsController::class, 'deleteAll'])
->middleware('auth');