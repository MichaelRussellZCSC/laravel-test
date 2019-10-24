@extends('layout')

@section('content')
    <h1>Reviews of {{ $movie->name }}</h1>

    @foreach($reviews as $review)
        <div>
            <h2>{{ $review->rating }}</h2>
            <p>{{ $review->text }}</p>
            <hr>
        </div>
    @endforeach

    <a href="{{ action('NewMovieController@show', $movie->id) }}">Back to movie</a>

@endsection
