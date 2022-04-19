<?php

namespace App\Http\Controllers;

use App\Models\Matching;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class MainController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $ageFrom = Auth::user()->age_from;
        $ageTill = Auth::user()->age_till;
        $genderToShow = Auth::user()->gender_to_show;

        $dislikes = DB::table('matchings')
            ->where('user_id', '=', "$userId")
            ->where('like_dislike', '=', 'D')
            ->pluck('person_Id')
            ->toArray();

        $likes = DB::table('matchings')
            ->where('user_id', '=', "$userId")
            ->where('like_dislike', '=', 'L')
            ->pluck('person_Id')
            ->toArray();

        if($genderToShow === 'B'){
            $persons = DB::table('users')
                ->where('id', '!=', "$userId")
                ->whereNotIn('id', $dislikes)
                ->where('age', '>=', "$ageFrom")
                ->where('age', '<=', "$ageTill")
                ->get();
        }else{
            $persons = DB::table('users')
                ->where('id', '!=', "$userId")
                ->whereNotIn('id', $dislikes)
                ->whereNotIn('id', $likes)
                ->where('age', '>=', "$ageFrom")
                ->where('age', '<=', "$ageTill")
                ->where('gender', '=', "$genderToShow")
                ->get();
        }

        if (count($persons) > 0) {
            $randPerson = $persons->random();
            $image = $randPerson->image;


        } else {
            $randPerson = Auth::user();
            $randPerson['first_name'] = 'No more ';
            $randPerson['last_name'] = 'Like or Dislike!';
            $randPerson['age'] = '-';
            $image = 'default-avatar.png';
        }

        return view('main', [
            'person' => $randPerson,
            'image' => $image
        ]);
    }

    public function update(Request $request)
    {
        $userId = Auth::id();
        $likeDislike = $request['like_dislike'];
        $personId = $request['personId'];

        if ($userId == $personId) {
            return redirect('main');
        }

        Matching::create([
            'user_id' => $userId,
            'person_id' => $personId,
            'like_dislike' => $likeDislike,
        ]);

        return redirect('main');
    }
}


