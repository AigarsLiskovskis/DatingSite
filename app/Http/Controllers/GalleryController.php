<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{
    public function index($personsId)
    {
        $message ='Picture Gallery';

        $gallery = DB::table('images')
            ->where('user_id', '=', "$personsId")
            ->pluck('image')
            ->toArray();

        if(empty($gallery)){
           $message = 'No Pictures to View!';
        }

        return view('gallery', [
            'gallery' => $gallery,
            'message' => $message,
        ]);
    }
}
