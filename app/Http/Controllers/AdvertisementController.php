<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreAdvertisementRequest;
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
        if (!Auth::check()){
            return redirect()->route('advertisements.index');
        }
        else {
            return view('advertisements.create');
        }
    }

    public function store(StoreAdvertisementRequest $request)
    {
        if (!Auth::check()){
            return redirect()->route('advertisements.index');
        }
        else {
            //validate the advertisement
            $validated = $request->validated();
            $validated['user_id'] = Auth::user()->id;
            //dd($validated);

            //store the advertisement in the databae
            $advertisement = Advertisement::create($validated);
            //store the image in the public disk
            //save the image to the database
            //show user their advertisement
            return redirect()->route('advertisements.show', $advertisement);
        }
    }

    public function show(Advertisement $advertisement)
    {
        $advertisement->load('bids');
        return view('advertisements.show', compact('advertisement'));
    }
}