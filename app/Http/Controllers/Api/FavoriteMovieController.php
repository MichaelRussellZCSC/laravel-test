<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\FavoriteMovie;

class FavoriteMovieController extends Controller
{
    public function toggle(Request $request)
    {
        // get from request information about which user and which movie
        $user_id = $request->input('user_id'); // 1
        $movie_id = $request->input('movie_id'); // 488

        // try to find if this movie already favored
        // SELECT *
        // FROM `favorite_movies`
        // WHERE `user_id` = 1
        // AND `movie_id` = 488
        // LIMIT 1
        $favorite_movie = FavoriteMovie::where('user_id', $user_id)
            ->where('movie_id', $movie_id)
            ->first();

        // if NOT favored
        if ($favorite_movie === null) {
            // favor it (create a new favorite_movies record)
            $favorite_movie = new FavoriteMovie;
            $favorite_movie->user_id = $user_id;
            $favorite_movie->movie_id = $movie_id;

            // INSERT INTO `favorite_movies`
            // (`user_id`, `movie_id`, `created_at`, `updated_at`)
            // VALUES
            // (1, 488, '2019-10-22 11:13:00', '2019-10-22 11:13:00')
            $favorite_movie->save();

            // return a pretty response
            return [
                'status' => 'success',
                'message' => 'Movie was added to favorites',
                'data' => [
                    'favorite' => true
                ]
            ];
        } else {
            // unfavor it (delete the favorite_movies record)
            // DELETE
            // FROM `favorite_movies`
            // WHERE `id` = 123
            $favorite_movie->delete();

            // return a pretty response
            return [
                'status' => 'success',
                'message' => 'Movie was removed from favorites',
                'data' => [
                    'favorite' => false
                ]
            ];
        }
    }

    public function status(Request $request)
    {
        // get from request information about which user and which movie
        $user_id = $request->input('user_id'); // 1
        $movie_id = $request->input('movie_id'); // 488

        // try to find if this movie already favored
        // SELECT *
        // FROM `favorite_movies`
        // WHERE `user_id` = 1
        // AND `movie_id` = 488
        // LIMIT 1
        $favorite_movie = FavoriteMovie::where('user_id', $user_id)
            ->where('movie_id', $movie_id)
            ->first();

        // if NOT favored
        if ($favorite_movie === null) {
            return [
                'favorite' => false
            ];
        } else {
            return [
                'favorite' => true
            ];
        }
    }
}
