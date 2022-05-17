<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Str;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {

        dd('test');

        Validator::make($input, [
            'lastname' => ['required', 'string', 'max:255', 'regex:/^[a-z\s-]+$/i'],
            'firstname' => ['required', 'string', 'max:255', 'regex:/^[a-z\s-]+$/i'],
            'phone' => ['required', 'numeric', 'unique:users'],
            'password' => $this->passwordRules(),
        ])->validate();

        User::create([
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname'],
            'phone' => $input['phone'],
            'token' => Str::random(30),
            'admin' => isset($input['formAdmin']),
            'password' => Hash::make($input['password']),
        ]);

        return redirect('members'); 
    }
}
