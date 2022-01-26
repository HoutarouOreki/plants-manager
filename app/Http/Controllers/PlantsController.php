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
        $query = Plant::query()->where('visibility', '=', 'public');
        if (Auth::check()) {
            $query->orWhere('user_id', '=', Auth::user()?->id ?? 0);
        }

        return view('plants/index', ["plants" => $query->get()]);
    }

    public function myPlants()
    {
        if (!Auth::user()) {
            return redirect('/login');
        }
        return view('plants/index', ["plants" => Plant::query()
            ->where('user_id', '=', Auth::user()->id)->get()]);
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
            'visibility' => ['required', Rule::in(['private', 'public'])],
            'imageLink' => []

        ]);

        if (Auth::user() == null) {
            return redirect('/');
        }

        $plant = new Plant;
        $plant->user_id = Auth::user()->id;
        $plant->name = $validated["name"];
        $plant->breed_id = $validated["breed_id"];
        $plant->visibility = $validated["visibility"];
        $plant->image_link = $validated["imageLink"];
        if (strlen($plant->image_link) < 2) {
            $plant->image_link = Breed::find($plant->breed_id)["image_link"];
        }

        if ($plant->save()) {
            return redirect('/plants');
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
        $plant = Plant::find($id);
        //Sprawdzenie czy użytkownik jest autorem
        if (Auth::user()->id != $plant->user_id) {
            return back()->with([
                'success' => false, 'message_type' => 'danger',
                'message' => 'Nie posiadasz uprawnień do przeprowadzenia tej operacji.'
            ]);
        }

        return view('plants/edit', ['plant' => $plant, 'breeds' => Breed::all()]);
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
        $plant = Plant::find($id);

        if (Auth::user() == null) {
            return redirect('/');
        }

        //Sprawdzenie czy użytkownik jest autorem
        if (Auth::user()->id != $plant->user_id) {
            return back()->with([
                'success' => false, 'message_type' => 'danger',
                'message' => 'Nie posiadasz uprawnień do przeprowadzenia tej operacji.'
            ]);
        }

        $validated = $request->validate([
            'breed_id' => ['required', 'exists:breeds,id'],
            'name' => ['min:1', 'max:255'],
            'visibility' => ['required', Rule::in(['private', 'public'])],
            'imageLink' => []
        ]);
        
        $plant->name = $validated["name"];
        $plant->breed_id = $validated["breed_id"];
        $plant->visibility = $validated["visibility"];
        $plant->image_link = $validated["imageLink"];
        if (strlen($plant->image_link) < 2) {
            $plant->image_link = Breed::find($plant->breed_id)["image_link"];
        }

        if ($plant->save()) {
            return redirect('/plants');
        }
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
