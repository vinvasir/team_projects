<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectMemberRequest;
use App\Models\Project;

class ProjectMemberController extends Controller
{
    public function store(Project $project, ProjectMemberRequest $request)
    {
        $project->members()->attach($request->get('member_id'));

        return response()->json(['Message' => 'successfully added a project member'], 201);
    }
}
