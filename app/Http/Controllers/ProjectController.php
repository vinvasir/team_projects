<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        return ProjectResource::collection(Project::all());
    }

    public function store(ProjectRequest $request)
    {
        return new ProjectResource(Project::create($request->validated()));
    }

    public function show(Project $project)
    {
        return new ProjectResource($project);
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $project->update($request->validated());

        return new ProjectResource($project);
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return response()->json(['message' => 'Successfully deleted project'], 204);
    }
}
