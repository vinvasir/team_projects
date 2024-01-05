<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberTeamRequest;
use App\Http\Resources\MemberResource;
use App\Models\Member;

class MemberTeamController extends Controller
{
    public function update(Member $member, MemberTeamRequest $request)
    {
        $member->update($request->validated());

        return new MemberResource($member);
    }
}
