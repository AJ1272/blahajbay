@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <div class='advertisement'>
        <h1>{{$advertisement->title}}</h1>
        <p>{{$advertisement->description}}</p>
        <span>Asking price: {{$advertisement->price}}</span><br>
        <span>status: {{$advertisement->status}}</span><br>
        Categories:
        @foreach( $advertisement->categories as $category)
            <span class="themelabel">{{$category->category}}</span>
        @endforeach
    </div>

    <div class='advertisement'>
        <h2>Bids</h2>
        
        @foreach($advertisement->bids as $bid)
            <div class='comment'>
                <h3>{{$bid->user->name}}</h3>
                <span>offered {{$bid->height}} on {{$bid->created_at}}</span> <br>
                <span>this bid is {{$bid->status}}</span> <br>
            </div>
        @endforeach
    </div>

    @if (!Auth::check())

        <div class='advertisement'>
            <h2>Want to place a bid or message the seller?</h2>
            <a href="{{ route('users.login') }}">Log in</a>
            <br>
            or <a href="{{ route('users.create') }}">register as a new user.</a>
        </div>

    @elseif(Auth::check()) //Auth::user()->id == $advertisement->user->id

        <h2>Your messagechains:</h2>
        @foreach ($advertisement->messagechains as $messagechain)
            <div class="advertisement">
                <h3>Your conversation with {{$messagechain->buyer->name}}</h3>
                @foreach ($messagechain->messages as $message)
                    <p><b> {{$message->user->name}} said:</b> {{$message->content}}</p>
                @endforeach
                <form action="{{ route('messages.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label><h3>New message:</h3></label>
                <input type="text" value="type a new message" id="content" name="content" required>
                <input type="hidden" name="messagechain_id" value="{{ $messagechain->id }}">
                <button type="submit">Send message</button>
            </form>
            </div>
        @endforeach

    @else
        <div class='advertisement'>
            <h2>Place a bid</h2>
            <form action="{{ route('bids.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <label><h3>Amount:</h3></label>
                <input type="number" min="0" step="0.01" value="0" id="price" name="height" required>
                <input type="hidden" name="advertisement_id" value="{{ $advertisement->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <button type="submit">Place bid</button>
            </form>
            If user has a message chain for this advertisement, show the messagechain, plus a form to add a message to the chain.
            If there is no message chain, create a form for a new message chain.
        </div>
        
    @endif

    <div class="advertisement">
                <h3>Start a new messagechain with this seller</h3>
                <form action="{{ route('messagechains.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label><h3>New message:</h3></label>
                <input type="text" value="type a new message" id="content" name="content" required>
                <input type="hidden" name="advertisement_id" value="{{ $advertisement->id }}">
                <input type="hidden" name="seller_id" value="{{ $advertisement->user_id }}">
                <button type="submit">Send message</button>
            </form>
    
@endsection