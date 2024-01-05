<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamRequest;
use App\Http\Resources\TeamResource;
use App\Models\Team;
use Exception;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    public function index()
    {
        $teams = Team::orderBy('name', 'asc')->paginate(10);

        return TeamResource::collection($teams);
    }

    public function store(TeamRequest $request)
    {
        $team = new Team(['name' => $request->get('name')]);

        $team->saveOrFail();
        return response()->json(['message' => 'Successfully created a team'], 201);
    }

    public function show(Team $team)
    {
        return new TeamResource($team);
    }

    public function update(TeamRequest $request, Team $team)
    {
        $team->updateOrFail(['name' => $request->get('name')]);
        return response()->json(['message' => 'Successfully updated the team.'], 204);
    }

    public function destroy(Team $team)
    {
        try {
            $team->deleteOrFail();
            return response()->json(['message' => 'Successfully deleted team.'], 204);
        } catch (Exception $x) {
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }
}
