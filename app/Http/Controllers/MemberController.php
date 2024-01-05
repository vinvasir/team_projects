<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use App\Http\Resources\MemberResource;
use App\Models\Member;

class MemberController extends Controller
{
    public function index()
    {
        return MemberResource::collection(Member::all());
    }

    public function store(MemberRequest $request)
    {
        return new MemberResource(Member::create($request->validated()));
    }

    public function show(Member $member)
    {
        return new MemberResource($member);
    }

    public function update(MemberRequest $request, Member $member)
    {
        $member->update($request->validated());

        return new MemberResource($member);
    }

    public function destroy(Member $member)
    {
        $member->delete();

        return response()->json(['message' => 'Successfully deleted member.'], 204);
    }
}
