<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            if (
                !$googleUser->getId() ||
                !$googleUser->getEmail() ||
                !$googleUser->getName()
            ) {
                return redirect('/login')
                    ->withErrors([
                        'google' => 'Google account details are incomplete.'
                    ]);
            }

            $user = DB::transaction(function () use ($googleUser) {
                $user = User::where(
                    'google_id',
                    $googleUser->getId()
                )->first();

                if (!$user) {
                    $user = User::where(
                        'email',
                        $googleUser->getEmail()
                    )->first();

                    // Do not silently link an existing account
                    // by email unless Google's email is verified
                    // and your account-linking policy permits it.
                    if ($user) {
                        abort(403, 'Please sign in and link Google from your account settings.');
                    }

                    $user = User::create([
                        'name' => $googleUser->getName(),
                        'email' => $googleUser->getEmail(),
                        'google_id' => $googleUser->getId(),
                        'password' => bcrypt(Str::random(40)),
                    ]);
                } else {
                    $user->update([
                        'name' => $googleUser->getName(),
                    ]);
                }

                return $user;
            });

            Auth::login($user);
            request()->session()->regenerate();

            return redirect('/dashboard');
        } catch (Throwable $e) {
            report($e);

            return redirect('/login')->withErrors([
                'google' => 'Google login failed. Please try again.'
            ]);
        }
    }
}
