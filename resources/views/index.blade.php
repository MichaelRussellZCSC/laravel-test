@extends('layout')

@section('content')

    <h1>{{ $headline }} {{ $username }}!</h1>

    <p>
        Today is {{ $date }}
    </p>

    <p>
        <?php if ($admin) : ?>
            My master!
        <?php else : ?>
            You are NOT an administrator.
        <?php endif; ?>
    </p>

    <p>Your full name is {{ $name . ' ' . $surname }}</p>

    <input name="text" value="{{ $user_input }}" />

    <ul>
        <?php foreach ($top_movies as $movie) : ?>

            <li>
                {{ $movie->name }}
            </li>

        <?php endforeach ?>
    </ul>

@endsection