@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    @if (Auth::check() && Auth::user()->id == $user->id)    
        <h1>{{$user->name}}</h1>
        <p>your awesome profile picture here</p>
    
        

        <h2>Email verification.</h2>
        @if (is_null(Auth::user()->email_verified_at))
            <p>Your email address ({{$user->email}}) has not yet been verified. Please check your email for our verification email. If you cannot find your verification email, you can send you a new one.</p>
            <form action="{{ route('verification.send')}}" method="post">
                <input type ="submit" value="resend verification email"/>
            </form>
        @else
            <p>Your email address ({{$user->email}}) has been verified at {{$user->email_verified_at}}</p>
        @endif

        <h2>Password stuff.</h2>

        <h2>Account deletion.</h2>
        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit"  onclick="return confirm('This will delete your account and all advertisements and pictures from our servers. Are you sure?')">Delete My Account</button>
            <p>Deleting your account will delete all you advertisements and pictures also. We store no backups, so make sure to make your own.</p>
        </form>

    @else
        <p>You are not authorized.</p>
    @endif
    
@endsection