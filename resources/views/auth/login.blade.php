@extends('layouts.app')

@section('title', 'Page Title')

@section('content')

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="./authenticate" method="POST">
    @csrf
    <h1>Login user</h1>

    <label>Email</label>
    <input type="email" placeholder="Email" id="email" name="email" required />

    <label>Password</label>
    <input type="password" placeholder="Password" id="password" name="password" required />

    <button type="submit">Login</button>
</form>

<a href="{{route('password.request')}}">Oh no, I forgot my password.</a>

@endsection