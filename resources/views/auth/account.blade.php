@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <p>some text</p>
    @if (Auth::check() && Auth::user()->id == $user->id)    
    <h1>{{$user->name}}</h1>
    
    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit"  onclick="return confirm('This will delete your account and all your blogposts, comments and uploaded images permanently. Are you sure?')">Delete My Account</button>
        <p>Deleting your account will delete your account and all your blogposts, comments and uploaded images permanently. We store no backups, so make sure to make your own.</p>
    </form>
    
    @else
        <p>You are not authorized.</p>
    @endif
    
@endsection