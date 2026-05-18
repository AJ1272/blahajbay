<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Models\Advertisement;
use Illuminate\Support\Facades\Auth;

class AdvertisementController extends Controller
{
    public function index()
    {
        $advertisements = Advertisement::orderBy('created_at','desc')->get();
        
        return view('home', compact('advertisements'));
    }

    public function create()
    {
        if (Auth::check()){
            return view('advertisements.create');
        }
        else {
            return redirect()->route('advertisements.index');
        }
    }

    public function store()
    {
        if (Auth::check()){
            return view('advertisements.create');
        }
        else {
            return redirect()->route('advertisements.index');
        }
    }
}
