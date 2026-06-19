@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <h1>Advertisements</h1>

    <form action="{{ route('advertisements.index') }}" method="GET" enctype="multipart/form-data">
        @csrf
        <label><h2>Category:</h2></label>
        <select multiple id="category" name="category[]" required>
            @foreach($menucategories as $category)
                <option value="{{ $category->category }}">{{ $category->category }}</option>
            @endforeach
        </select>
        <label><h2>Searchterm:</h2></label>
        <input type="text" id="searchterm" name="searchterm" value="">
        <button type="submit">Filter</button>

    </form>

    <table>
        <tr>
            <th>Title</th>
            <th>Seller</th>
            <th>Price</th>
            <th>Category</th>
            <th>Availabilty</th>
            <th>Date</th>
        </tr>
        @foreach($advertisements as $advertisement)
            <tr>
                <td>
                    <a href="{{ route('advertisements.show', $advertisement) }}">{{$advertisement->title}}</a>
                </td>

                <td>
                    <a href="{{ route('users.show', $advertisement->user) }}">{{$advertisement->user->name}}</a>
                </td>
                
                <td>
                    {{$advertisement->price}}
                </td>

                <td>
                    @foreach( $advertisement->categories as $category)
                        <span class="themelabel">{{$category->category}}</span>
                    @endforeach
                </td>

                <td>
                    {{$advertisement->status}}
                </td>

            </tr>
        @endforeach
    </table>
    {{$advertisements->links()}}

@endsection