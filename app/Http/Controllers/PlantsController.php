<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Breed;
use App\Models\Plant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PlantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('plants/index', ["plants" => Plant::query()
            ->where('visibility', '=', 'public')
            ->orWhere('user_id', '=', Auth::user()?->id ?? 0)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        $breeds = Breed::all();
        return view("plants/create", ["breeds" => $breeds]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'breed_id' => ['required', 'exists:breeds,id'],
            'name' => ['min:1', 'max:255'],
            'visibility' => ['required', Rule::in(['private', 'public'])]
        ]);

        if (Auth::user() == null) {
            return redirect('/');
        }

        $plant = new Plant;
        $plant->user_id = Auth::user()->id;
        $plant->name = $validated["name"];
        $plant->breed_id = $validated["breed_id"];
        $plant->visibility = $validated["visibility"];

        if (!isset($validated['image_link']) || count($validated['image_link']) < 1) {
            $plant->image_link = Breed::query()->whereKey($plant->breed_id)->get()[0]['image_link'];
        }

        if ($plant->save()) {
            return redirect('/plants', 201);
        }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plant = Plant::find($id);
        //Sprawdz czy użytkownik jest autorem komentarza:
        if (Auth::user()->id != $plant->user_id) {
            return back();
        }
        if ($plant->delete()) {
            return redirect()->route('plants');
        }
    }
}
