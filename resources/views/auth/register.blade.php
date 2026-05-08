@extends('layouts.app')

@section('title', 'Page Title')

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@section('content')
<form action="./store" method="POST">
    @csrf
    <h1>Register new user</h1>

    <label>Username</label>
    <input type="text" placeholder="Username" id="name" name="name" required />

    <label>Email</label>
    <input type="email" placeholder="Email" id="email" name="email" required />

    <label>Password</label>
    <input type="password" placeholder="Password" id="password" name="password" required />

    <button type="submit">Register</button>
</form>
@endsection