<?php


use App\Models\Team;

test('it shows the details of a team if it exists', function () {
    $team = Team::factory()->create();

    $response = $this->get('/api/teams/' . $team->id);

    $response->assertStatus(200)
        ->assertJsonFragment(['name' => $team->name]);
});

test('it returns a 404 if the team does not exist', function () {
    $response = $this->get('/api/teams/42');

    $response->assertStatus(404);
});
