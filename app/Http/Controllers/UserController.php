<?php

namespace App\Http\Controllers;


use App\Models\Image;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function show()
    {
        $userId = Auth::id();

        $gallery = DB::table('images')
            ->where('user_id', '=', "$userId")
            ->pluck('image')
            ->toArray();

        $image = Auth::user()->image;

        return view('user/userProfile', [
            'image' => $image,
            'gallery' => $gallery
        ]);
    }


    public function update(Request $request)
    {
        $userprofile = Auth::user();

        $request->validate([
            'first_name' => ['required', 'max:255', 'min:3'],
            'last_name' => ['required', 'max:255', 'min:3'],
            'age' => ['required', 'max:255'],
            'location' => ['required', 'max:255', 'min:2'],
            'email' => ['required', 'email', 'max:255', 'min:5'],
            'age_range' => ['required'],
        ]);

        if (!empty($request['password'])){
            $request->validate([
                'password' => ['required', 'max:255', 'min:2'],
            ]);
            $userprofile->update([
                'password' => bcrypt($request['password']),
            ]);
        }

        $ageRange = explode(' - ', $request['age_range']);

        if ($request['female'] && $request['male']) {
            $genderToShow = 'B';
        } elseif ($request['female'] == 'F') {
            $genderToShow = $request['female'];
        } else {
            $genderToShow = $request['male'];
        }

        if ($request->hasfile('images')) {
            $images = $request->file('images');

            foreach ($images as $image) {
                $path = $image->store('public');
                $filename = explode("/", $path)[1];

                Image::create([
                    'user_id' => $userprofile->id,
                    'image' => $filename,
                ]);
            }
        }

        $userprofile->update([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'age' => $request['age'],
            'location' => $request['location'],
            'email' => $request['email'],
            'gender_to_show' => $genderToShow,
            'age_from' => $ageRange[0],
            'age_till' => $ageRange[1],
        ]);

        return redirect('user');
    }

    public function changePicture($picture)
    {
        $userprofile = Auth::user();
        $userId = Auth::id();

        $userprofile->update([
            'image' => $picture,
        ]);

        DB::table('matchings')
            ->where('person_id', '=', "$userId")
            ->where('like_dislike', '=', "D")
            ->delete();

        return redirect('user');
    }


}
