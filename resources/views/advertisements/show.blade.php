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

    <div class='advertisement'>
        <h2>Place your own bid</h2>
        <p>Form here to place a bid</p>
    </div>
    
@endsection