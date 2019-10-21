<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function show(Request $request)
    {
        $id = $request->input('id');

        return \App\Movie::find($id);
    }
}
