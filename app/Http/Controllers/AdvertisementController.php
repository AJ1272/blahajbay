<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreAdvertisementRequest;
use App\Models\Advertisement;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class AdvertisementController extends Controller
{
    public function index(Request $request)
    {
    
        $filter = $request->input('category');

        if($filter){
            
            $filtercategory = Category::where('category', $filter)->first();
        
            $advertisements = $filtercategory->advertisements()->orderBy('created_at','desc')->simplePaginate(3);
        }
        else {
            $advertisements = Advertisement::orderBy('created_at','desc')->simplePaginate(15);
        }
        
        $menucategories = Category::all();

        return view('home', compact('advertisements', 'menucategories'));
    }

    public function create()
    {
        if (!Auth::check()){
            return redirect()->route('advertisements.index');
        }
        else {
            $categories = Category::orderby('category', 'desc')->get();
            return view('advertisements.create', compact('categories'));
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

            //connect the selected categories
            $advertisement->categories()->attach($request->input('category'));
            //store the image in the public disk
            //save the image to the database
            //show user their advertisement
            return redirect()->route('advertisements.show', $advertisement);
        }
    }

    public function show(Advertisement $advertisement)
    {
        $advertisement->load('bids');
        $advertisement->load('categories');
        return view('advertisements.show', compact('advertisement'));
    }

    public function edit(Advertisement $advertisement)
    {
        if (!Auth::check() || $advertisement->user_id !== Auth::user()->id){
            return redirect()->route('advertisements.index');
        }
        $categories = Category::orderby('category', 'desc')->get();
        return view('advertisements.edit', compact('advertisement', 'categories'));
    }

    public function update(Request $request, Advertisement $advertisement)
    {
        $advertisement->title = $request->input('title');
        $advertisement->description = $request->input('description');
        $advertisement->price = $request->input('price');
        $advertisement->save();
        //remove old categories and attach new ones
        $advertisement->categories()->detach();
        $advertisement->categories()->attach($request->input('category'));
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