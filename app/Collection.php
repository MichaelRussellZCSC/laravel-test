<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function genre()
    {
        return $this->belongsTo('App\Genre');
    }

    public function movies()
    {
        return $this->belongsToMany('App\Movie');
    }

    public function collection_movies()
    {
        return $this->hasMany('App\CollectionMovie');
    }
}
