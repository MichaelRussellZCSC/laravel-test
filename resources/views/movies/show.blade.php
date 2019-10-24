@extends('layout')

@section('content')
    <h1>{{ $movie->name }}</h1>
    <p>{{ $movie->year }}</p>
    <div>
        <img style="width: 10rem" src="{{ $movie->poster_url }}" alt="">
    </div>

    <p>
        <a href="/movies">Back to list of movies</a>
    </p>

    <p>
        <a href="{{ url('/movies') }}">Back to list of movies</a>
    </p>

    <p>
        <a href="{{ action('NewMovieController@index') }}">Back to list of movies</a>
    </p>
    <p>
        <a href="{{ route('movie_index') }}">Back to list of movies</a>
    </p>
@endsection
