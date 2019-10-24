@extends('layout')

@section('content')
    <h1>Movies</h1>

    @foreach($movies as $movie)
        <div>
            <h2>{{ $movie->name }}</h2>
            <p>{{ $movie->year }}</p>
            <p>{{ $movie->rating }}</p>

            <a href="{{ action('NewMovieController@show', $movie->id) }}">Open detail</a>
            <a href="{{ route('movie_show', $movie->id) }}">Open detail</a>
        </div>
    @endforeach
@endsection
