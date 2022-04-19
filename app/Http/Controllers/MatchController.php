<?php

namespace App\Http\Controllers;

use App\Mail\Matching;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MatchController extends Controller
{
    public function matching()
    {
        $userId = Auth::id();
        $message = 'My Matches';

        $personsLikes = DB::table('matchings')
            ->where('person_id', '=', "$userId")
            ->where('like_dislike', '=', 'L')
            ->pluck('user_id')
            ->toArray();

        $matchings = DB::table('matchings')
            ->whereIn('person_id', $personsLikes)
            ->where('user_id', '=', "$userId")
            ->where('like_dislike', '=', 'L')
            ->pluck('person_id')
            ->toArray();



        $gallery = DB::table('users')
            ->whereIn('id', $matchings)
            ->pluck('image')
            ->toArray();


        $matchingPersons = DB::table('users')
            ->whereIn('id', $matchings)
            ->get()
            ->toArray();

        if (empty($matchings)) {
            $message = 'No Matches to View!';
        }

        foreach ($matchingPersons as $person) {
            Mail::to($person->email)->send(new Matching(Auth::user()->first_name));
            Mail::to(Auth::user())->send(new Matching($person->first_name));
        }

        return view('gallery', [
            'gallery' => $gallery,
            'message' => $message,
        ]);
    }
}
