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

            //store the advertisement in the database
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

    public function edit(Advertisement $advertisement)
    {
        if (!Auth::check() || $advertisement->user_id !== Auth::user()->id){
            return redirect()->route('advertisements.index');
        }
        return view('advertisements.edit', compact('advertisement'));
    }

    public function update(Request $request, Advertisement $advertisement)
    {
        $advertisement->title = $request->input('title');
        $advertisement->description = $request->input('description');
        $advertisement->price = $request->input('price');
        $advertisement->save();
        return view('advertisements.show', compact('advertisement'));
    }

    public function destroy(Advertisement $advertisement)
    {
        if (!Auth::check() || $advertisement->user_id != Auth::user()->id){
            return redirect()->route('advertisements.index');
        }
        else {
            if ($advertisement) {
                $advertisement->delete();
            }
            return redirect()->route('users.dashboard');
        }
        
    }
}