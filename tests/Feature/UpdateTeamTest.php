<?php


use App\Models\Team;

test('it updates a team if it exists and provided a name string', function () {
    $team = Team::factory()->create();
    $newName = 'New name';

    $response = $this->patch('/api/teams/' . $team->id, ['name' => $newName]);

    $response->assertStatus(204);

    $this->assertEquals($newName, $team->fresh()->name);
});

test('it returns an error status if nothing is provided for the name input', function () {
    $team = Team::factory()->create();
    $oldName = $team->name;
    $response = $this->patch('/api/teams/' . $team->id, []);

    $response->assertStatus(422);

    $this->assertEquals($oldName, $team->fresh()->name);
});

test('it returns an error status if the name input is not a string', function () {
    $team = Team::factory()->create();
    $oldName = $team->name;
    $response = $this->patch('/api/teams/' . $team->id, ['name' => 42]);

    $response->assertStatus(422);

    $response->assertStatus(422);

    $this->assertEquals($oldName, $team->fresh()->name);
});
