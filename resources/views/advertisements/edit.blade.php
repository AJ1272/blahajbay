@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    @if (!Auth::check() || $advertisement->user_id != Auth::user()->id)   
        <p>You are not logged in or not the owner of this advertisement.</p> 
    @else
        <form action="{{ route('advertisements.update', $advertisement) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        
            <div class="formitem">
                <label><h3>Advertisement title:</h3></label>
                <input type="text" id="title" name="title" value="{{$advertisement->title}}" required>
            </div>
        
            <div class="formitem">
                <label><h2>description of article:</h2></label>
                <textarea id="description" name="description" required>{{$advertisement->description}}</textarea>
            </div>

            <div class="formitem">
                <label><h2>asking price (in euros):</h2></label>
                <input type="number" min="0" step="0.01" id="price" name="price" value="{{$advertisement->price}}" required>
            </div>

            <div class="formitem">
            <label><h2>Category:</h2></label>
            Current categories:
            @foreach( $advertisement->categories as $category)
                <span class="themelabel">{{$category->category}}</span>
            @endforeach
            <br>
            <select multiple id="category" name="category[]" required>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->category }}</option>
                @endforeach
            </select>
            <p>(you can select multiple themes by holding Ctrl or Command. Note: old categories will be removed.)</p>
            </div>
        
            <div class="formitem">
                <label for="image"><h2>Select Image</h2></label>
                <input type="file" name="image" id="image">
                <p>Optional, please select a small image.</p>
            </div>

            <div class="formitem">
                <label><h2>Premium</h2></label>
                <input type ="checkbox" id="premium" name="premium" value="premium"></input>
                <p>Pay us money to give your add a nice golden background (does nothing else).</p>
            </div>

            <button type="submit">Edit advertisement</button>

        </form>
    @endif
    
@endsection