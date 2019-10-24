@extends('layout')

@section('content')

    <main style="margin: 0 2em;">

        @if ($person->id)

            {!! Form::open(['url' => '/person/'.$person->id, 'method' => 'put']) !!}

        @else

            {!! Form::open(['url' => '/person', 'method' => 'post']) !!}

        @endif

            {{ Form::bootstrapTextField('name', $person->name) }}

            <div class="form-group">
                <label for="" class="control-label">Photo url</label>
                {!! Form::text('photo_url', $person->photo_url, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                <label for="" class="control-label">Biography</label>
                <textarea class="form-control" name="biography" cols="30" rows="10">{{ $person->biography }}</textarea>
            </div>

            <div class="form-group">
                <label for="" class="control-label">Profession</label>
                {!! Form::select('profession_id', $professions, $person->profession_id, ['placeholder' => 'Choose a profession...', 'class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                <input type="submit" value="save" class="form-control">
            </div>

        {!! Form::close() !!}

    </main>

@endsection