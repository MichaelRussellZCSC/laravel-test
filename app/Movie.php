<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public function reviews()
    {
        return $this->hasMany('App\Review', 'movie_id', 'id');
    }

    public function people()
    {
        return $this->belongsToMany('App\Person');
    }

    public function favored_by_users()
    {
        return $this->belongsToMany('App\User', 'favorite_movies');
    }
}
