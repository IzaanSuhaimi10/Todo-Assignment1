<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactorController extends Controller
{
            public function index()
        {
            return view('auth.verify-2fa');
        }

        public function store(Request $request)
        {
            $request->validate(['two_factor_code' => 'required']);

        $user = Auth::user();

        if ($request->two_factor_code == $user->two_factor_code &&
            now()->lt($user->two_factor_expires_at)) {
            $user->resetTwoFactorCode();
            return redirect()->intended('/todo');
        }

        return back()->withErrors(['two_factor_code' => 'The 2FA code is invalid or expired.']);
    }

}
