<form>

</form>@extends('layouts.app')

@section('title', 'Page Title')

@section('content')

<p>Maybe also use a password manager instead of trying to remember your passwords.</p>

<form action="{{ route('password.update') }}" method="POST">
    @csrf
    <h1>Reset your password</h1>

    <label>Your email</label>
    <input type="email" placeholder="Email" id="email" name="email" required />

    <label>Your new password</label>
    <input type="password" id="password" name="password" required />

    <label>retype your new password</label>
    <input type="password" id="password_confirmation" name="password_confirmation" required />

    <input type="hidden" name="token" id="token" value="{{ $token }}" />

    <button type="submit">Reset my password (I promise not to forget again)</button>
</form>
@endsection