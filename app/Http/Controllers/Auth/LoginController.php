<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Mail\TwoFactorCodeMail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;




class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/todo';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login(LoginRequest $request)
{
    $email = (string) $request->input('email');
    $ip = $request->ip();
    $throttleKey = Str::lower($email) . '|' . $ip;

    // Rate limiting
    if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
        throw ValidationException::withMessages([
            'email' => ['Too many login attempts. Please try again in ' . RateLimiter::availableIn($throttleKey) . ' seconds.'],
        ]);
    }

    $user = \App\Models\User::where('email', $email)->first();

    if ($user && Hash::check($request->password . $user->salt, $user->password)) {
        Auth::login($user);
        RateLimiter::clear($throttleKey);
        $request->session()->regenerate();

        // Two-factor auth (if used)
        $user->generateTwoFactorCode();
        \Mail::to($user->email)->send(new \App\Mail\TwoFactorCodeMail($user));

        return redirect()->route('verify.index');
    }

    RateLimiter::hit($throttleKey, 60);

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
}

}
