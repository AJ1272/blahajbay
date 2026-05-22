<?php

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

//Route::get('/', function () {
//    return view('welcome');
//});

//User related pages for registering, logging in and reading their own messages.
Route::get('/users/register',[RegisteredUserController::class, 'create'])->name('users.create'); //Page to register a new user
Route::get('/users/account',[RegisteredUserController::class, 'account'])->name('users.account'); //Show the user's OWN account for managing passwords etc
Route::post('/users/store', [RegisteredUserController::class, 'store'])->name('users.store'); //Actually call the store function to add the new user to the database
Route::get('/users/login',[RegisteredUserController::class, 'login'])->name('users.login'); //Page for the user to give their credentials for logging in
Route::get('/users/logout',[RegisteredUserController::class, 'logout'])->name('users.logout'); //Logs out the currently logged in user
Route::post('users/authenticate', [RegisteredUserController::class, 'authenticate'])->name('users.authenticate'); //Authenticate the provided user credentials, logs the user in if the credentials match
Route::delete('/users/{user}', [RegisteredUserController::class, 'destroy'])->name('users.destroy'); //Removes the user if they are authenticated.

//Email verification routes
Route::get('/email/verify', function(){
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');//Show user a notification that tells them they got a verification email.

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request){
    $request->fulfill();

    return redirect()->route('users.account');
})->middleware(['auth','signed'])->name('verification.verify'); //the link to get verified

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link resent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');//route for resending the verification email

//Password reset routes
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::ResetLinkSent
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:5|confirmed',
    ]);
 
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
        }
    );
 
    return $status === Password::PasswordReset
        ? redirect()->route('users.login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

//Pages for viewing OTHER users.
Route::get('/users/{user}/show',[UserController::class, 'show'])->name('users.show'); //Show a user's latest advertisements and ratings

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
Route::get('/advertisements/{advertisement}/edit', [AdvertisementController::class, 'edit'])->name('advertisements.edit');
Route::post('/advertisements/store', [AdvertisementController::class, 'store'])->name('advertisements.store'); //
Route::delete('/advertisements/{advertisement}', [AdvertisementController::class, 'destroy'])->name('advertisements.destroy');
Route::put('/advertisements/{advertisement}', [AdvertisementController::class, 'update'])->name('advertisements.update');

//Routes for viewing and interacting with advertisements
Route::get('/advertisements/{advertisement}/show', [AdvertisementController::class, 'show'])->name('advertisements.show');