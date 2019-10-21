<?php

namespace App\Http\Controllers\Api;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        return DB::table('reviews')
            ->get();
    }

    public function store(Request $request)
    {
        // get 4 pieces of information from the request
        $movie_id = $request->input('movie_id');
        $user_id = $request->input('user_id');
        $text = $request->input('text');
        $rating = $request->input('rating');

        // insert a new record in table reviews using that information
        DB::table('reviews')
            ->insertGetId([
                'movie_id' => $movie_id,
                'user_id' => $user_id,
                'text' => $text,
                'rating' => $rating
            ]);

        // optional: get the id of the last inserted review
        $new_id = DB::getPdo()->lastInsertId();

        // optional: return some nice response message
        return [
            'status' => 'success',
            'message' => 'Inserted successfully',
            'data' => [
                'id' => $new_id
            ]
        ];
    }
}
