<?php

namespace App\Services;

use DB;

class MovieService
{
    public function getTopRatedMovies()
    {
        $results = DB::table('movies')
            ->orderBy('rating', 'desc')
            ->limit(10)
            ->get();
        
        return $results;
    }



}