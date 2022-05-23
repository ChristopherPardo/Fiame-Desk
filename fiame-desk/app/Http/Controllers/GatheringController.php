<?php

namespace App\Http\Controllers;

use App\Models\Gathering;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class GatheringController extends Controller
{
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'description' => ['required', 'string', 'max:255', 'regex:/^[a-z\s-]+$/i'],
            'date' => ['required', 'string', 'max:255', 'regex:/^(?:(?:31(\/)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/)(?:0?[13-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/'],
        ])->validate();
        
        $date = \Carbon\Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d');
    
            dd(Gathering::where('date', $date)->first());

        if(Gathering::where('date', $date)->first() == null){
            if(! $request->alter){
                Validator::make($request->all(), [
                    'date' => ['required', 'unique:gatherings'],
                ])->validate();
            }
            
           $request->save();

        }

        Gathering::create([
            'description' => $request->description,
            'date' => $date,
            'user_id' => auth()->user()->id,
        ]);

        return redirect('events');
    }
}
