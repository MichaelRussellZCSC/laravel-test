<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    //
    public function movies()
    {
        // all movies with rating above 8 , first 10 only and ordered alphabetically by name
        $query = "
            SELECT *
                FROM `movies`
                WHERE `rating` > ?
                ORDER BY `name` ASC
                LIMIT 10
        ";

        $query_builder = DB::table('movies');
        $query_builder->limit(10);
        $query_builder->orderBy('name', 'asc');
        $query_builder->where('rating', '>', 8);

        $movie_names = $query_builder->pluck('name');

        $movies = DB::table('movies')
            ->where('rating', '>', 8)
            ->orderBy('name')
            ->limit(10)
            ->get();

        dd($movies);
    }
}
