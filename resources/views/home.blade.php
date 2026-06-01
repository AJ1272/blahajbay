@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <h1>Advertisements</h1>
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
                    
                </td>

                <td>
                    {{$advertisement->status}}
                </td>

            </tr>
        @endforeach
    </table>
@endsection