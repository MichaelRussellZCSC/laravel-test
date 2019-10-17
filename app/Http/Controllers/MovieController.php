<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Facades\App\Services\MovieService;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        // get parameters from request
        $orderby   = $request->input('orderby');
        if (!in_array($orderby, ['name', 'rating', 'year'])) {
            $orderby = 'name';
        }
        $orderway  = $request->input('orderway', 'asc');
        $limit     = $request->input('limit', 10);
        $page      = max(1, $request->input('page', 1));
        $search    = $request->input('search', null);
        $year      = $request->input('year', null);
        $minrating = $request->input('minrating', null);

        // initialize the query builder
        $query = DB::table('movies');

        // modify the query builder
        $query
            ->orderBy($orderby, $orderway)
            ->limit($limit)
            ->offset($page * $limit - $limit);

        if ($search !== null) {
            $query->where('name', 'like', "%{$search}%");
        }

        if ($year !== null) {
            $query->where('year', $year);
        }

        if ($minrating !== null) {
            $query->where('rating', '>=', $minrating);
        }

        // execute the query built by the query builder and get the results
        $movies = $query->get();

        return $movies;
    }

    public function show(Request $request)
    {
        $id = $request->input('id');

        $movie = \App\Movie::find($id);

        // $values = $movie->ratings->pluck('value')->toArray();
        // $average = array_sum($values) / count($values);

        $movie->ratings;

        $people = $movie->people;

        return [
            'movie' => $movie,
            'ratings' => $movie->ratings,
            'people' => $movie->people
        ];
    }

    public function cast_and_crew(Request $request)
    {
        $id = $request->input('id');

        if ($id === null) {
            return [];
        }

        // get person ids
        $person_ids = DB::table('movie_person')
            ->where('movie_id', $id)
            ->pluck('person_id');

        // use person ids to select people
        $people = DB::table('people')
            ->whereIn('id', $person_ids)
            ->get();

        return $people;
    }
    
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
    

    public function top_movies()
    {
        // SELECT *
        // FROM `movies`
        // ORDER BY `rating` DESC
        // LIMIT 10

        return MovieService::getTopRatedMovies();
    }

    public function movie_of_the_week()
    {
        $movie_id = 123;

        // SELECT *
        // FROM `movie`
        // WHERE `id` = 234
        
        $movie = DB::table('movies')
            ->where('id', $movie_id)
            ->first();

        // SELECT `genre_id`
        // FROM `genre_movie`
        // WHERE `movie_id` = 234

        $genre_ids = DB::table('genre_movie')
            ->where('movie_id', $movie->id)
            ->pluck('genre_id');
        
        // SELECT *
        // FROM `genres`
        // WHERE `id` IN (1, 2, 3)

        $genres = DB::table('genres')
            ->whereIn('id', $genre_ids)
            ->pluck('name');

        $people_ids = DB::table('movie_person')
            ->where('movie_id', $movie->id)
            ->where('profession_id', 3)
            ->pluck('person_id');

        $people = DB::table('people')
            ->whereIn('id', $people_ids)
            ->limit(3)
            ->pluck('name');

        return [
            'movie'  => $movie,
            'genres' => $genres,
            'people' => $people,
        ];
    }
}


