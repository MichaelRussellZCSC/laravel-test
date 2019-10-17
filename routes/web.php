<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api', 'ApiController@index');
Route::get('/api/search/people', 'ApiController@search_people');
Route::get('/api/cast_crew', 'ApiController@cast_and_crew');

// moning workout
Route::get('/api/movies/top_rated', 'MovieController@top_movies');
Route::get('/api/movies/movie_of_the_week', 'MovieController@movie_of_the_week');

Route::get('/api/movies', 'MovieController@movies');

Route::get('/test/form', 'ApiController@form');
Route::post('/test/form', 'ApiController@handleForm');

Route::resource('/api/review', 'ReviewController');
Route::resource('/api/rating', 'RatingController');
