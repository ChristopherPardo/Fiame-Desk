<?php

namespace App\Http\Controllers;

use App\Models\Gathering;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use \Carbon\Carbon;

class GatheringController extends Controller
{
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'description' => ['required', 'string', 'max:255', 'regex:/^[a-z\s-]+$/i'],
            'date' => ['required', 'date'],
        ])->validate();

        $date = Carbon::parse($request->date)->format('Y-m-d');

        $gathering = Gathering::where('date', $date)->first();

        if (! $gathering) {
            Gathering::create([
                'description' => $request->description,
                'date' => $date,
                'user_id' => auth()->user()->id,
            ]);
        } else {
            $gathering->description = $request->description;
            $gathering->save();
        }

        return redirect('events');
    }

    public function delete(Gathering $gathering)
    {
        Gathering::find($gathering->id)->delete();
        return Redirect('events');
    }
}
