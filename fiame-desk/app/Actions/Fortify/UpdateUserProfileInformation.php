<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'lastname' => ['required', 'string', 'max:255', 'regex:/^[a-z\s-]+$/i'],
            'firstname' => ['required', 'string', 'max:255', 'regex:/^[a-z\s-]+$/i'],
            'phone' => ['required', 'numeric', 'unique:users,phone,'.$input['id']],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        /*if ($input['phone'] !== $user->phone &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {*/
        $user->forceFill([
            'lastname' => $input['lastname'],
            'firstname' => $input['firstname'],
            'phone' => $input['phone'],
        ])->save();
        // }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'lastname' => $input['lastname'],
            'firstname' => $input['firstname'],
            'phone' => $input['phone'],
        ])->save();
    }
}
