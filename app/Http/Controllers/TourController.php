<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function all()
    {
        return response()->json(Tour::all());
    }

    public function show($id)
    {
        return response()->json(Tour::find($id));
    }

    public function create(Request $request)
    {
        $tour = Tour::create($this->validate($request, [
            'name' => 'required',
            'active' => 'boolean'
        ]));

        return response()->json($tour, 201);
    }

    public function update(Request $request, $id)
    {
        $tour = Tour::findOrFail($id);

        $tour->update($request->except('id'));

        return response()->json($tour);
    }

    public function delete($id)
    {
        Tour::destroy($id);

        return response()->json(null, 204);
    }
}
