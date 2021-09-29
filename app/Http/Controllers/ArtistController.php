<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function all()
    {
        return response()->json(['data' => Artist::all()]);
    }

    public function show($id)
    {
        return response()->json(['data' => Artist::find($id)]);
    }

    public function create(Request $request)
    {
        $artist = Artist::create($this->validate($request, [
            'name' => 'required|unique:artists',
            'on_tour' => 'boolean'
        ]));

        return response()->json(['data' => $artist], 201);
    }

    public function update(Request $request, $id)
    {
        $artist = Artist::findOrFail($id);
        $artist->update($request->except('id'));

        return response()->json(['data' => $artist]);
    }

    public function delete($id)
    {
        Artist::destroy($id);

        return response()->json(null, 204);
    }
}
