<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $title_of_page = 'Movie website';

        $view = view('index', 
            [
                'title' => $title_of_page,
                'headline' => 'Welcome, '
            ]
        );

        $view->with('date', date('j. n. Y'));

        $view->with([
            'username' => 'Honza',
            'admin' => false
        ]);

        $view->top_movies = \App\Movie::limit(10)->get();

        $name = 'John';
        $surname = 'Wayne';

        // $view->with([
        //     'name' => $name,
        //     'surname' => $surname
        // ]);

        $view->with(compact('name', 'surname'));

        $view->user_input = '"><h1>This page is now mine!</h1><"';

        return $view;
    }
}
