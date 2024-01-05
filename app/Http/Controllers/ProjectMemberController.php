<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectMemberRequest;
use App\Http\Resources\MemberResource;
use App\Models\Project;

class ProjectMemberController extends Controller
{
    public function index(Project $project)
    {
        return MemberResource::collection(
          $project
              ->members()
              ->orderBy('last_name', 'asc')
              ->paginate(10)
        );
    }

    public function store(Project $project, ProjectMemberRequest $request)
    {
        $project->members()->attach($request->get('member_id'));

        return response()->json(['Message' => 'successfully added a project member'], 201);
    }
}
