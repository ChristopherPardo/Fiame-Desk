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
            'date' => ['required', 'string', 'max:255', 'regex:/^\d{4}/(0[1-9]|1[0-2])/(0[1-9]|[12][0-9]|3[01])$/'],
        ])->validate();

        dd($request);
    }
}
