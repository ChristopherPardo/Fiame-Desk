<?php

namespace App\Http\Controllers;

use App\Models\Gathering;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class GatheringController extends Controller
{
    public function delete(Gathering $gathering)
    {
        Gathering::find($gathering->id)->delete();
        return Redirect('events');
    }
}
