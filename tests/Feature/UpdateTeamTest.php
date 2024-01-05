<?php


use App\Models\Team;

test('it updates a team if it exists and provided a name string', function () {
    $team = Team::factory()->create();
    $newName = 'New name';

    $response = $this->patch('/api/teams/' . $team->id, ['name' => $newName]);

    $response->assertStatus(204);

    $this->assertEquals($newName, $team->fresh()->name);
});
