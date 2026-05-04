<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Models\Advertisement;

class AdvertisementController extends Controller
{
    public function index()
    {
        $advertisements = Advertisement::orderBy('created_at','desc')->get();
        
        return view('home', compact('advertisements'));
    }
}
