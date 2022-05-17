<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    use PasswordValidationRules;

    public function store(Request $request)
    {
        
        Validator::make($request->all(), [
            'lastname' => ['required', 'string', 'max:255', 'regex:/^[a-z\s-]+$/i'],
            'firstname' => ['required', 'string', 'max:255', 'regex:/^[a-z\s-]+$/i'],
            'phone' => ['required', 'numeric', 'unique:users'],
            'password' => $this->passwordRules(),
        ])->validate();

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
