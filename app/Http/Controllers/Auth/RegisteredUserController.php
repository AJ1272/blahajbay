<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthenticateRegisteredUserRequest;
use App\Http\Requests\StoreRegisteredUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegisteredUserController extends Controller
{
    //
    public function create()
    {
        return view('auth.register');
    }

    public function store(StoreRegisteredUserRequest $request)
    {
        //dd($request);
        $user = User::create($request->validated());
        Auth::login($user);
        return redirect()->route('users.account');
    }

    public function destroy(User $user)
    {

    }

    public function login()
    {
        
        return view('auth.login');
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
            return redirect()->route('users.account');
        }
        return back()->withErrors();
    }

    public function account()
    {
        if (Auth::check()){
            $user = Auth::user();
            return view('auth.account', compact('user'));
        }
        return redirect()->route('users.login');
    }
}
