<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Http\Requests\ConfirmationRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class ConfirmationController extends Controller
{
    /**
     * @return \Illuminate\Container\Container|mixed|object
     */
    public function show(): mixed
    {
        return view('confirm');
    }

    public function confirmCode(ConfirmationRequest $request): RedirectResponse
    {
        $user = User::where('confirmation_code', $request->confirmation_code)->first();

        if (! $user) {
            return back()->withErrors(['confirmation_code' => 'Invalid confirmation code.']);
        }

        // Mark user as confirmed
        $user->is_confirmed = true;
        $user->save();

        event(new UserRegistered($user->name, ', confirmed'));

        return redirect()->route('home');
    }
}
