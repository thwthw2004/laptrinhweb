<?php
use App\Http\Controllers\ControllerList;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::get('', [CustomAuthController::class, 'index'])->name('home');
Route::get('login', [CustomAuthController::class, 'login'])->name('login');
Route::post('login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('logout', [CustomAuthController::class, 'signOut'])->middleware('auth')->name('logout');

Route::prefix('list')->middleware('auth')->group(function () {
    Route::get('', [ControllerList::class, 'index'])->name('list');
    Route::post('delete/{id}', [ControllerList::class, 'delete'])->name('list.name');
    Route::get('edit/{id}', [ControllerList::class, 'edit'])->name('list.edit');
    Route::post('update/{id}', [ControllerList::class, 'update'])->name('list.update');
    Route::get('view/{id}', [ControllerList::class, 'show'])->name('list.view');
    Route::get('delete/{id}', [ControllerList::class, 'delete'])->name('list.delete');
});
