<?php

    use App\Http\Controllers\AdminController;
    use App\Http\Controllers\BookController;

    use App\Http\Controllers\IndexController;
    use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name(
    'home'
);


Route::get('/get-dates', [BookController::class, 'getDates'])->name(
    'get-dates'
);

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showAdminLoginForm'])->name(
        'admin.login'
    );

    Route::post('/login', [AdminController::class, 'login'])->name(
        'admin.login_admin_process'
    );

    Route::post('/add-book', [BookController::class, 'addBook'])->name('add-book');
    Route::post('/delete-book', [BookController::class, 'deleteBook'])->name('admin.delete-book');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::post('/change-book', [BookController::class, 'changeBook'])->name('admin.change-book');
    });
});
