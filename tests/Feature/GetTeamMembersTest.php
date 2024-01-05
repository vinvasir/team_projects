<?php


use App\Models\Member;
use App\Models\Team;

test('it shows all members of a team, paginated in alphabetical order', function () {
    $team = Team::factory()->create();
    Member::factory(25)->create(['team_id' => $team->id]);

    $response = $this->get('/api/teams/' . $team->id . '/members');

    $firstTenAlphabetical = $team->members()->orderBy('last_name', 'asc')->take(10)->get();

    $response->assertStatus(200);

    $firstTenAlphabetical->each(function ($member) use ($response) {
        $response->assertJsonFragment(['last_name' => $member->last_name]);
    });
});
