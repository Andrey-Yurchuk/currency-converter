<?php

use App\Http\Controllers\CurrencyUpdateController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\CurrencyConversionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

/**
 * The route for the home page
 *
 * @return View
 */
Route::get('/', function () {
    return view('welcome');
});

/**
 * The route for the dashboard, protected by authentication and email verification
 *
 * @return View
 */
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/**
 * Group of routes that require authentication
 */
Route::middleware('auth')->group(function () {
    /**
     * The route for displaying the profile edit form
     *
     * @return View
     */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    /**
     * The route for updating the user's profile
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    /**
     * The route for deleting the user's profile
     *
     * @return RedirectResponse
     */
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /**
     * Group of routes for the admin panel
     */
    Route::prefix('admin/currencies')->group(function () {
        /**
         * The route for displaying the currencies page in the admin panel
         *
         * @return View
         */
        Route::get('/', [CurrencyController::class, 'index'])->name('admin.currencies.index');

        /**
         * The route for updating exchange rates
         *
         * @return RedirectResponse
         */
        Route::get('/update', [CurrencyUpdateController::class, 'updateRates'])->name('admin.currencies.update');

        /**
         * The route for currency exchange rate conversion
         *
         * @param  Request  $request
         * @return JsonResponse
         */
        Route::post('/convert', [CurrencyConversionController::class, 'convert'])->name('admin.currencies.convert');
    });

});

require __DIR__.'/auth.php';
