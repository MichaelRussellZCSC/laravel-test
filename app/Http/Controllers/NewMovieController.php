<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;

class NewMovieController extends Controller
{
    public function index(){
        $movies = Movie::orderBy('id', 'desc')->limit(10)->get();

        return view('movies.index', compact('movies'));
    }

    public function show($movie_id){
        $movie = Movie::findOrFail($movie_id);

//        $movie = Movie::find($id);
//
//        if($movie == null){
//            return 'Movie not found';
//        }

        return view('movies.show', compact('movie'));
    }
}
