@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
        <h1>Account page of {{$user->name}}</h1>
        <p>their awesome profile picture here</p>
    
        

        <h2>Email verification.</h2>
        @if (is_null($user->email_verified_at))
            <p>This user is not yet verified.</p>
        @else
            <p>This user is verified.</p>
        @endif

        <h2>Their advertisements:</h2>
        @foreach ($user->advertisements as $advertisement)
            <div class="advertisement">
                <h3><a href="{{route('advertisements.show', $advertisement)}}">{{$advertisement->title}}</a></h3>
                <p>{{$advertisement->description}}</p>
                <p>Their asking price: {{$advertisement->price}}</p>
                @foreach ($advertisement->bids as $bid)
                    {{$bid->user->name}} bid {{$bid->height}} <br>
                @endforeach
            </div>
        @endforeach
    
@endsection