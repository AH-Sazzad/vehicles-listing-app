<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SingelCarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MassageController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MyCarController;

Route::get('/vehicle/{slug}', [SingelCarController::class, 'index'])->name('singelCar');


Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/my_cars', [MyCarController::class, 'index'])->name('my_cars');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/massages', [MassageController::class, 'index'])->name('massages');
    Route::get('/massages/{user}', [MassageController::class, 'show'])->name('massages.show');
    Route::post('/massages/send', [MassageController::class, 'send'])->name('massages.send');
    Route::get('/favorite', [FavoriteController::class, 'index'])->name('favorite');
    Route::post('/favorite', [FavoriteController::class, 'store'])->name('favorite.store');
    Route::delete('/favorite/{id}', [FavoriteController::class, 'remove'])->name('favorite.remove');
    Route::post('/vehicles', [HomeController::class, 'store'])->name('vehicles.store');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    

});



require __DIR__.'/auth.php';
