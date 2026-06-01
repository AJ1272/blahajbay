@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <div class='advertisement'>
        <h1>{{$advertisement->title}}</h1>
        <p>{{$advertisement->description}}</p>
        <span>Asking price: {{$advertisement->price}}</span>
        <span>status: {{$advertisement->status}}</span>
    </div>

    <div class='advertisement'>
        <h2>Previous bids</h2>
        
        @foreach($advertisement->bids as $bid)
            <div class='comment'>
                <h3>{{$bid->user->name}}</h3>
                <span>offered {{$bid->height}} on {{$bid->created_at}}</span>
            </div>
        @endforeach
    </div>

    @if (!Auth::check())

        <div class='advertisement'>
            <h2>Want to place a bid?</h2>
            <a href="{{ route('users.login') }}">Log in</a>
            <br>
            or <a href="{{ route('users.create') }}">register as a new user.</a>
        </div>

    @else

        <div class='advertisement'>
            <h2>Place a bid</h2>
            <form action="{{ route('bids.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <label><h3>Amount:</h3></label>
                <input type="number" min="0" step="0.01" value="0" id="price" name="price" required>
                <input type="hidden" name="advertisement_id" value="{{ $advertisement->id }}">
                <button type="submit">Plaats bod</button>
            </form>
        </div>

    @endif
    
@endsection