<form>

</form>@extends('layouts.app')

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


<form action="./forgot-password" method="POST">
    @csrf
    <h1>I forgot my password</h1>

    <label>Your email</label>
    <input type="email" placeholder="Email" id="email" name="email" required />

    <button type="submit">Send me password reset link</button>
</form>
@endsection