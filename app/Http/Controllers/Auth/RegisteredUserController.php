<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthenticateRegisteredUserRequest;
use App\Http\Requests\StoreRegisteredUserRequest;
use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    //
    public function create()
    {
        return view('auth.register');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function store(StoreRegisteredUserRequest $request)
    {
        //dd($request);
        $user = User::create($request->validated());
        Auth::login($user);
        $request->session()->regenerate();
        event(new Registered($user));
        return redirect()->route('verification.notice');
    }

    public function destroy(User $user)
    {
        if (Auth::check() && $user->id === Auth::user()->id){
            $user->delete();
        }
        return redirect()->route('advertisements.index');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('advertisements.index');
    }

    public function authenticate(AuthenticateRegisteredUserRequest $request)
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('users.dashboard');
        }
        return back()->withErrors([
            'error' => 'Incorrect credentials.',
        ]);
    }

    public function account()
    {
        if (Auth::check()){
            $user = Auth::user();
            return view('auth.account', compact('user'));
        }
        return redirect()->route('users.login');
    }

    public function dashboard()
    {
        if (Auth::check()){
            $user = Auth::user();
            $advertisements = $user->advertisements;
            $bids = $user->bids->unique('advertisement_id');
            return view('auth.dashboard', compact('user', 'advertisements', 'bids'));
        }
        return redirect()->route('users.login');
    }
}
