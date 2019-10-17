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
        $movie_id = $request->input('movie_id');
        $user_id = $request->input('user_id');
        $text = $request->input('text');
        $rating = $request->input('rating');

        DB::table('reviews')
            ->insertGetId([
                'movie_id' => $movie_id,
                'user_id' => $user_id,
                'text' => $text,
                'rating' => $rating
            ]);

        $new_id = DB::getPdo()->lastInsertId();

        return [
            'status' => 'success',
            'message' => 'Inserted successfully',
            'data' => [
                'id' => $new_id
            ]
        ];
    }
}
