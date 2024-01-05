<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Error;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request)
    {
        $team = new Team(['name' => $request->get('name')]);

        $team->saveOrFail();
        return response()->json(['message' => 'Successfully created a team'], 201);
    }

    public function show($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
