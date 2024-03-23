<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard')->with('page', 'dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


// pages
Route::get('/home', [App\Http\Controllers\PageController::class, 'home'])->name('home');
Route::get('/details', [App\Http\Controllers\PageController::class, 'details'])->name('details');


// prefix: account

Route::group(['prefix' => 'account'], function () {

    Route::resource('roles', App\Http\Controllers\Account\RoleController::class);

    //Route::resource('permissions', App\Http\Controllers\Account\PermissionController::class);

    Route::resource('terms', App\Http\Controllers\Account\TermController::class);

    Route::resource('cities', App\Http\Controllers\Account\CityController::class);

    Route::resource('streets', App\Http\Controllers\Account\StreetController::class);

    Route::resource('places', App\Http\Controllers\Account\PlaceController::class);

    Route::resource('reservations', App\Http\Controllers\Account\Place\ReservationController::class);

    Route::resource('reviews', App\Http\Controllers\Account\Place\ReviewController::class);

    Route::resource('pings', App\Http\Controllers\Account\Place\PingController::class);

    Route::resource('experiences', App\Http\Controllers\Account\Place\ExperienceController::class);

    Route::resource('menu-categories', App\Http\Controllers\Account\Place\MenuCategoryController::class);

    Route::resource('menu-items', App\Http\Controllers\Account\Place\MenuItemController::class);

    Route::resource('opening-hours', App\Http\Controllers\Account\Place\OpeningHourController::class);

    Route::resource('salles', App\Http\Controllers\Account\Place\SalleController::class);

    Route::resource('tables', App\Http\Controllers\Account\Place\TableController::class);

    Route::resource('favorites', App\Http\Controllers\Account\Place\FavoriteController::class);

    Route::resource('payments', App\Http\Controllers\Account\PaymentController::class);

    Route::resource('contacts', App\Http\Controllers\Account\ContactController::class);

    Route::resource('pages', App\Http\Controllers\Account\PageController::class);

    Route::resource('posts', App\Http\Controllers\Account\PostController::class);

    Route::resource('attachments', App\Http\Controllers\Account\AttachmentController::class);

    Route::resource('demands', App\Http\Controllers\Account\DemandController::class);
})->middleware(['auth', 'verified']);
