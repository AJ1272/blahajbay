<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UserController;

//Route::get('/', function () {
//    return view('welcome');
//});

//Homepage, must show:
//Latest advertisements
//Link to login, OR link to your userpage and logout button if you are logged in
//Little notification symbol if you have new messages
//Search function with a selector for advertisement categories, price ranges etc
//Link to create a new advertisement
Route::get('/', [AdvertisementController::class, 'index'])->name('advertisements.index');

//Routes for managing your own advertisements
Route::get('/advertisements/filter', [AdvertisementController::class, 'filter'])->name('advertisements.filter'); //Allows filtering of advertisements.
Route::get('/advertisements/create', [AdvertisementController::class, 'create'])->name('advertisements.create');
Route::get('/advertisements/{advertisement}/show', [AdvertisementController::class, 'show'])->name('advertisements.show');
Route::get('/advertisements/{advertisement}/edit', [AdvertisementController::class, 'edit'])->name('advertisements.edit');
Route::post('/advertisements/store', [AdvertisementController::class, 'store'])->name('advertisements.store'); //
Route::delete('/advertisements/{advertisement}', [AdvertisementController::class, 'destroy'])->name('advertisements.destroy');
Route::put('/advertisements/{advertisement}', [AdvertisementController::class, 'update'])->name('advertisements.update');


//User related pages for registering, logging in and reading their own messages.
Route::get('/users/register',[RegisteredUserController::class, 'create'])->name('users.create'); //Page to register a new user
Route::get('/users/account',[RegisteredUserController::class, 'account'])->name('users.account'); //Show the user's OWN account for managing passwords etc
Route::post('/register', [RegisteredUserController::class, 'store'])->name('users.store'); //Actually call the store function to add the new user to the database
Route::get('/users/login',[RegisteredUserController::class, 'login'])->name('users.login'); //Page for the user to give their credentials for logging in
Route::get('/users/logout',[RegisteredUserController::class, 'logout'])->name('users.logout'); //Logs out the currently logged in user
Route::post('/login', [RegisteredUserController::class, 'authenticate'])->name('users.authenticate'); //Authenticate the provided user credentials, logs the user in if the credentials match
Route::delete('/users/{user}', [RegisteredUserController::class, 'destroy'])->name('users.destroy'); //Removes the user if they are authenticated.

//Pages for viewing OTHER users.
Route::get('/users/{user}/show',[UserController::class, 'show'])->name('users.show'); //Show a user's latest advertisements and ratings
