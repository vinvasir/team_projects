<?php


use App\Models\Team;

test('it creates a team if provided a valid string for the name', function () {
    $teamName = 'Example Team';

    $this->assertNull(Team::where(['name' => $teamName])->first());

    $response = $this->post('/api/teams', ['name' => $teamName]);

    $response->assertStatus(201);

    $team = Team::where(['name' => $teamName])->first();

    $this->assertNotNull($team);

    $this->assertEquals($teamName, $team->name);
});
