<?php


use App\Models\Team;

test('it deletes a team', function () {
    $team = Team::factory()->create();
    $response = $this->delete('/api/teams/' . $team->id);

    $response->assertStatus(204);
    $this->assertNull(Team::find($team->id));
});

test('it returns 404 if an incorrect id is provided', function () {
    $team = Team::factory()->create();
    $response = $this->delete('/api/teams/' . $team->id + 1);

    $response->assertStatus(404);
    $this->assertEquals($team->name, Team::find($team->id)->name);
});
