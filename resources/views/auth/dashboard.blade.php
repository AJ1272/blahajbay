@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    @if (Auth::check() && Auth::user()->id == $user->id)    
        <h1>Dashboard of {{$user->name}}</h1>
    
        <h2>Your advertisements:</h2>
        @foreach ($user->advertisements as $advertisement)
            <div class="advertisement">
                <h3><a href="{{route('advertisements.show', $advertisement)}}">{{$advertisement->title}}</a></h3>
                <p>{{$advertisement->description}}</p>
                Current categories:
                @foreach( $advertisement->categories as $category)
                    <span class="themelabel">{{$category->category}}</span>
                @endforeach
            <br>
                <p>Your asking price: {{$advertisement->price}}</p>
                @foreach ($advertisement->bids as $bid)
                    {{$bid->user->name}} bid {{$bid->height}} <br>
                @endforeach
                <a href="{{route('advertisements.edit', $advertisement)}}">Edit advertisement</a>
                <form action="{{ route('advertisements.destroy', $advertisement) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('This will detele your advertisement. Are you sure?')">Delete</button>
                </form>
            </div>
        @endforeach
        
        <h2>Your messages:</h2>
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