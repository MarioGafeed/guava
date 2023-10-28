<?php

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

Route::middleware(\App\Http\Middleware\LangMiddleware::class)->group(function () {

    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
    Route::get('/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/lang/{lang}', [App\Http\Controllers\AdminController::class, 'changeLang'])->name('admin.changeLang');

    // users
    Route::resource('users', 'UsersController');
    Route::post('users/multi_delete', 'UsersController@multi_delete')->name('users.multi_delete');

    // roles and permissions
    Route::resource('roles', 'RoleController');
    Route::post('/roles/multi_delete', 'RoleController@multi_delete')->name('roles.multi_delete');

    Route::resource('permissions', 'PermissionController');
    Route::post('permissions/multi_delete', 'PermissionController@multi_delete')->name('permissions.multi_delete');

    // Routes for guests
    Route::resource('guests', 'GuestController');
    Route::post('/guests/multi_delete', 'GuestController@multi_delete')->name('guests.multi_delete');
    Route::get('/guests/toggle/{id}', 'GuestController@toggle')->name('guests.toggle');

    // Routes for owners
    Route::resource('owners', 'OwnerController');
    Route::post('/owners/multi_delete', 'OwnerController@multi_delete')->name('owners.multi_delete');
    Route::get('/owners/toggle/{id}', 'OwnerController@toggle')->name('owners.toggle');

    // Routes For Location and Property Type..
    Route::resource('locations', 'LocationController');
    Route::post('/locations/multi_delete', 'LocationController@multi_delete')->name('locations.multi_delete');

    // Routes For WorkPlaces..
    Route::resource('workplaces', 'WorkplaceController');
    Route::post('/workplaces/multi_delete', 'WorkplaceController@multi_delete')->name('workplaces.multi_delete');

    // Routes For Places..
    Route::resource('places', 'PlaceController');
    Route::post('/places/multi_delete', 'PlaceController@multi_delete')->name('places.multi_delete');
    Route::get('/places/toggle/{id}', 'PlaceController@toggle')->name('places.toggle');

    // Routes For Appartments..
    Route::resource('appartments', 'AppartmentController');
    Route::post('/appartments/multi_delete', 'AppartmentController@multi_delete')->name('appartments.multi_delete');
    Route::get('/appartments/toggle/{id}', 'AppartmentController@toggle')->name('appartments.toggle');
    Route::get('/appartments/{id}/book', 'AppartmentController@book')->name('appartments.book');

    // Routes For Bookings..
    Route::resource('bookings', 'BookingController');
    Route::post('/bookings/multi_delete', 'BookingController@multi_delete')->name('bookings.multi_delete');
    Route::get('/bookings/toggle/{id}', 'BookingController@toggle')->name('bookings.toggle');
    Route::get('/bookings/{id}/book', 'BookingController@book')->name('bookings.book');
});
