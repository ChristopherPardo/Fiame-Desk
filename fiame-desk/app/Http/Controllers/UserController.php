<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
        User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'phone' => $request->phone,
            'token' => Str::random(30),
            'admin' => isset($request->formAdmin),
            'password' => Hash::make($request->password),
        ]);

        return redirect('members');
    }

    public function update(User $user)
    {
        $user->admin = request('admin') == 'on';
        $user->save();
        return redirect('members');
    }
}
