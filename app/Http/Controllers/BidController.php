<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreBidRequest;
use App\Models\Bid;
use App\Models\Advertisement;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    public function store(StoreBidRequest $request)
    {
        if (!Auth::check()){
            return redirect()->route('advertisements.index');
        }
        else {
            //validate the bid
            $validated = $request->validated();
            $validated['user_id'] = Auth::user()->id;
            $bid = Bid::create($validated);
            //dd($advertisement);
            return redirect()->route('advertisements.show', $bid->advertisement);
        }
    }

    public function destroy(Bid $bid)
    {
        if (!Auth::check() || $bid->user_id != Auth::user()->id){
            return redirect()->route('advertisements.index');
        }
        else {
            if ($bid) {
                $bid->delete();
            }
            return redirect()->route('users.dashboard');
        }
        
    }
}