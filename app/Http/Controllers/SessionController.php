<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create() {
        return view('auth.login');
    }

    public function store() {
        // validate
        $validAttributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        // compare & login
        Auth::attempt($validAttributes);

        if (! Auth::attempt($validAttributes)){
            throw ValidationException::withMessages([
                'email' => 'Sorry, those credentials donot match.'
            ]);
        }

        // regenerete session
        request()->session()->regenerate();

        // redirect
        return redirect('/jobs');
    }

    public function destroy() {
        Auth::logout();

        return redirect('/');
    }
}
