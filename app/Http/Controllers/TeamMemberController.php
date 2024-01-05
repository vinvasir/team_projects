<?php

namespace App\Http\Controllers;

use App\Http\Resources\MemberResource;
use App\Models\Team;

class TeamMemberController extends Controller
{
    public function index(Team $team)
    {
        return MemberResource::collection(
            $team
                ->members()
                ->orderBy('last_name', 'asc')
                ->paginate(10)
        );
    }
}
