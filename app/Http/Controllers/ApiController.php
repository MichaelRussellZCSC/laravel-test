<?php
 
namespace App\Http\Controllers;
 
use DB;
use Illuminate\Http\Request;
 
class ApiController extends Controller
{
    public function index()
    {
        // the logic of your page will be here
        $query = "
            SELECT *
            FROM `movies`
            WHERE 1
            ORDER BY `rating` DESC
            LIMIT 10
        ";
        $top_movies = DB::select($query);

        return $top_movies;

        // as response we will return an array of data
        return [
            'success' => true,
            'message' => 'Response successfully returned.',
            'errors' => [],
            'data' => [
                'class name' => self::class
            ]
        ];
    }

    public function search_people(Request $request)
    {
        $search_string = $request->input('search');

        $query = "
            SELECT *
            FROM `people`
            WHERE `name` LIKE ?
        ";

        $people = DB::select($query, [ "%{$search_string}%" ]);

        return $people;
    }

    public function cast_and_crew(Request $request)
    {
        if (!$request->has('id')) {
            return [
                'error' => 'Please specify the id of the movie'
            ];
        }

        $movie_id = $request->input('id');

        $query = "
            SELECT *
            FROM `movie_person`
            WHERE `movie_id` = ?
                AND `profession_id` = 3
        ";
        $movie_persons = DB::select($query, [ $movie_id ]);

        $person_ids = [];

        foreach ($movie_persons as $person) {
            
            $person_ids[] = $person->person_id;
            // array_push($person_ids, $person->person_id); // equivalent to the line above
        }

        $person_ids_string = join(', ', $person_ids);

        $questionmarks_string = join(', ', array_fill(0, count($person_ids), '?'));

        $query = "
            SELECT *
            FROM `people`
            WHERE `id` IN ({$questionmarks_string})
        ";

        $people = DB::select($query, $person_ids);

        return $people;
    }


    public function form()
    {
        return view('form');
    }

    public function handleForm(Request $request)
    {
        // $request = request(); // alternative to injecting in method parameters

        $search_string = $request->input('search');

        $query = "
            SELECT *
            FROM `people`
            WHERE `name` LIKE ?
        ";

        $people = DB::select($query, [ "%{$search_string}%" ]);

        return $people;
    }
}