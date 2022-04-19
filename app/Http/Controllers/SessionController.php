<?php

namespace App\Http\Controllers;


class SessionController extends Controller
{
    public function store()
    {

        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (!auth()->attempt($attributes)) {
            return back()
                ->withInput()
                ->withErrors(['email' => 'Your provided credentials could not be verified.']);
        }

        session()->regenerate();

        return redirect('/main');
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/home');
    }

    public function login()
    {
        return redirect('/home');
    }
}
