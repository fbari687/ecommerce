<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReturnController;
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

Route::get('/', [PageController::class, 'home'])->name('home');

Route::middleware('auth:member')->group(function () {
    Route::get('/book', [PageController::class, 'book']);
    Route::get('/history', [PageController::class, 'history']);
});

Route::middleware('guest')->group(function () {
    Route::get("/login", [PageController::class, 'login'])->name('login');
    Route::post("/login", [AuthController::class, 'login']);
});
Route::middleware('auth:admin')->group(function () {
    Route::prefix('/dashboard')->group(function () {
        Route::get('/', [PageController::class, 'dashboard']);
        Route::middleware('isAdmin')->group(function () {
            Route::resource('/books', BookController::class);
            Route::resource('/members', MemberController::class);
            Route::get('/members/editpw/{member}', [MemberController::class, 'editPwView']);
            Route::put('/members/editpw/{member}', [MemberController::class, 'editPw']);
            Route::resource('/librarians', AdminController::class)->parameters([
                'librarians' => 'admin'
            ]);
            Route::get('/librarians/editpw/{admin}', [AdminController::class, 'editPwView']);
            Route::put('/librarians/editpw/{admin}', [AdminController::class, 'editPw']);
            Route::resource('/categories', CategoryController::class);
        });
        Route::prefix('/reports')->group(function () {
            Route::get('/', [ReportController::class, 'index']);
            Route::get('/printtopdf', [ReportController::class, 'printToPdfMenu']);
            Route::post('/printtopdf', [ReportController::class, 'cetakPdf']);
            Route::get('/pdftemplate', [ReportController::class, 'pdfTemplate']);
        });
        Route::prefix('/borrows')->group(function () {
            Route::get('/', [BorrowController::class, 'index']);
            Route::post('/', [BorrowController::class, 'borrow']);
        });
        Route::prefix('/returns')->group(function () {
            Route::get('/', [ReturnController::class, 'index']);
            Route::post('/', [ReturnController::class, 'returns']);
            Route::get('/search/{f_idanggota}', [ReturnController::class, 'search']);
        });
    });
});
Route::get("/logout", [AuthController::class, 'logout'])->middleware('login');
