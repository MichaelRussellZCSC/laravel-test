<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;
use App\Profession;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $person = new Person;

        $professions = Profession::orderBy('name') // starting the query
            ->get()               // executing the query, getting a collection
            ->pluck('name', 'id') // plucking just names indexed by ids from collection, getting another collection
            ->all();              // turning that other collection into an associative array

        // return view('person/edit', ['professions' => $professions]);
        return view('person/edit', compact('person', 'professions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $person = new Person;
        $person->name = $request->input('name');
        $person->photo_url = $request->input('photo_url');
        $person->biography = $request->input('biography');
        $person->profession_id = $request->input('profession_id');

        $person->save();

        return redirect('/person/'.$person->id.'/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $person = Person::find($id);

        $professions = Profession::orderBy('name') // starting the query
            ->get()               // executing the query, getting a collection
            ->pluck('name', 'id') // plucking just names indexed by ids from collection, getting another collection
            ->all();              // turning that other collection into an associative array

        // return view('person/edit', ['professions' => $professions]);
        return view('person/edit', compact('person', 'professions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $person = Person::find($id);
        
        $person->name = $request->input('name');
        $person->photo_url = $request->input('photo_url');
        $person->biography = $request->input('biography');
        $person->profession_id = $request->input('profession_id');

        $person->save();

        return redirect('/person/'.$person->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
