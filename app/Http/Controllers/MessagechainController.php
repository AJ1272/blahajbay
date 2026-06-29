<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreMessageRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\Messagechain;

class MessagechainController extends Controller
{
    public function store(StoreMessageRequest $request)
    {
        if (!Auth::check()){
            return redirect()->route('advertisements.index');
        }
        else {
            //store a new messagechain in the database
            $messagechainvariables['seller_id'] = $request->seller_id;
            $messagechainvariables['buyer_id'] = Auth::user()->id;
            $messagechainvariables['advertisement_id'] = $request->advertisement_id;
            $messagechain = Messagechain::create($messagechainvariables);

            //validate the message
            $validated = $request->validated();
            $validated['user_id'] = Auth::user()->id;
            $validated['messagechain_id'] = $messagechain->id;

            //store the message in the database
            $message = Message::create($validated);

            return redirect()->route('advertisements.show', $message->messagechain->advertisement_id);
        }
    }
}
