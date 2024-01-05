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

test('it returns an error status if nothing is provided for the name input', function () {
    $response = $this->post('/api/teams', []);

    $response->assertStatus(422);

    $team = Team::first();

    $this->assertNull($team);
});

test('it returns an error status if the name input is not a string', function () {
    $response = $this->post('/api/teams', ['name' => 42]);

    $response->assertStatus(422);

    $team = Team::where(['name' => 42])->first();

    $this->assertNull($team);
});
