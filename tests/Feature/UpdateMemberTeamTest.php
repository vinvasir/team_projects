<?php


use App\Models\Member;
use App\Models\Team;

test('it updates the member\'s team_id if the new team_id exists', function () {
    $member = Member::factory()->create(['state' => 'CA', 'country' => 'USA']);
    $oldTeamId = $member->team_id;
    $newTeam = Team::factory()->create();

    $response = $this->put('/api/members/' . $member->id . '/teams', ['team_id' => $newTeam->id]);

    $response->assertStatus(200);
    $this->assertNotEquals($oldTeamId, $member->fresh()->team_id);
});

test('it returns a bad request error if the team id does not exist', function () {
    $member = Member::factory()->create(['state' => 'CA', 'country' => 'USA']);
    $oldTeamId = $member->team_id;

    $response = $this->put('/api/members/' . $member->id . '/teams', ['team_id' => $oldTeamId + 1]);

    $response->assertStatus(422);
    $this->assertEquals($oldTeamId, $member->fresh()->team_id);
});
