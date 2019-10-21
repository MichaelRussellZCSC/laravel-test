<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Collection;
use App\User;

class CollectionController extends Controller
{
    public function store()
    {
        $collection = new Collection;
        $collection->name = 'Bad movies';
        $collection->description = 'These I just don\'t like.';
        
        // associate the collection with the user 1
        $collection->user()->associate(1);
        
        // associate the collection with the genre 9 (history)
        $collection->genre()->associate(0);
        
        $collection->save();
        
        // attach 5 movies to the collection, giving appropriate priorities
        $collection->movies()->attach([
            123 => ['priority' => 5], 
            456 => ['priority' => 4], 
            789 => ['priority' => 3], 
            13 => ['priority' => 2], 
            900 => ['priority' => 1]
        ]);
    }

    public function user_lists()
    {
        $user = User::find(1);

        // $collections = \Facades\App\Services\CollectionService::getTopCollectionsForUser($user->id);

        $collections = $user->collections()->with('movies')->with('genre')->get();

        $movie_ids = [];
        foreach ($collections as $collection) {
            $movie_ids = array_merge($movie_ids, $collection->movies->pluck('id')->toArray());
            // foreach ($collection->movies as $movie) {
            //     $movie_ids[] = $movie->id;
            // }
        }

        return $movie_ids;

        // $movies = [];
        // foreach ($collections as $collection) {
        //     $movies[] = $collection->movies;
        // }

        // return view('welcome');

        // return $movies;
    }
}
