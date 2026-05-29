@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    @if (Auth::check() && Auth::user()->id == $user->id)    
        <h1>Dashboard of {{$user->name}}</h1>
    
        <h2>Your advertisements</h2>
        @foreach ($user->advertisements as $advertisement)
            <div class="advertisement">
                <h3>{{$advertisement->title}}</h3>
                <p>{{$advertisement->description}}</p>
                <p>Your asking price: {{$advertisement->price}}</p>
                @foreach ($advertisement->bids as $bid)
                    {{$bid->user->name}} bid {{$bid->height}} <br>
                @endforeach
            </div>
        @endforeach
        
        <h2>Your messages</h2>
        @foreach ($user->messages as $message)
            <div class="advertisement">
                <h3>Send to {{$message->user_id}}</h3>
                <p>{{$message->content}}</p>
            </div>
        @endforeach
        

    @else
        <p>You are not authorized.</p>
    @endif
    
@endsection