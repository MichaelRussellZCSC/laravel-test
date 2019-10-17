<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rating;

class RatingController extends Controller
{
    //
    public function index()
    {
        return Rating::all();
    }

    public function show(Request $request)
    {
        $id = $request->input('id');

        $rating = Rating::find($id);

        return $rating;
    }

    public function store()
    {
        $rating = new Rating;
        $rating->movie_id = 368;
        $rating->user_id = 5;
        $rating->value = 5;
        $rating->save();

        return [
            'status' => 'success',
            'message' => 'Inserted successfully',
            'data' => [
                'id' => $rating->id
            ]
        ];
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $value = $request->input('value');

        $rating = Rating::find($id);
        // $rating = Rating::where('id', $id)->first(); // same as line above

        if (!$rating) {
            return [
                'status' => 'fail',
                'message' => "A rating with id {$id} was not found :("
            ];
        }

        $rating->value = $value;
        $rating->save();

        return [
            'status' => 'success',
            'message' => 'Updated successfully',
            'data' => []
        ];
    }

    public function destroy(Request $request)
    {
        $id = $request->input('id');

        $rating = Rating::find($id);

        if (!$rating) {
            return [
                'status' => 'fail',
                'message' => "A rating with id {$id} was not found :("
            ];
        }

        $rating->delete();

        return [
            'status' => 'success',
            'message' => 'Deleted successfully',
            'data' => []
        ];
    }
}
