<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.registerUser');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'first_name' => ['required', 'max:255', 'min:2'],
            'last_name' => ['required', 'max:255', 'min:2'],
            'age' => ['required', 'integer',  'min:18'],
            'gender' => ['required', 'max:1'],
            'location' => ['required', 'max:255', 'min:2'],
            'email' => ['required', 'email', 'max:255', 'min:5', 'unique:users,email'],
            'password' => ['required', 'max:255', 'min:2'],
            'image' => ['required', 'file', 'image'],
        ]);

        $genderToShow = ($request['gender'] === 'M') ? 'F' : 'M';

        $request->file('image')->store('public');

        $uploadedFile = $request->file('image');


        User::create([
            'first_name' => $attributes['first_name'],
            'last_name' => $attributes['last_name'],
            'age' => $attributes['age'],
            'gender' => $attributes['gender'],
            'location' => $attributes['location'],
            'email' => $attributes['email'],
            'gender_to_show' => $genderToShow,
            'age_from' => 18,
            'age_till' => 100,
            'password' => bcrypt($attributes['password']),
            'image' => $uploadedFile->hashName(),
            'email_verified_at' => now(),
        ]);

        return redirect('/home');
    }
}
