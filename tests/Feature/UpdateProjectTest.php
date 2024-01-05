<?php


use App\Models\Project;

test('it updates a project if it exists and provided a name string', function () {
    $project = Project::factory()->create();
    $newName = 'New name';

    $response = $this->patch('/api/projects/' . $project->id, ['name' => $newName]);

    $response->assertStatus(200);

    $this->assertEquals($newName, $project->fresh()->name);
});

test('it returns an error status if nothing is provided for the name input', function () {
    $project = Project::factory()->create();
    $oldName = $project->name;
    $response = $this->patch('/api/projects/' . $project->id, []);

    $response->assertStatus(422);

    $this->assertEquals($oldName, $project->fresh()->name);
});

test('it returns an error status if the name input is not a string', function () {
    $project = Project::factory()->create();
    $oldName = $project->name;
    $response = $this->patch('/api/projects/' . $project->id, ['name' => 42]);

    $response->assertStatus(422);

    $response->assertStatus(422);

    $this->assertEquals($oldName, $project->fresh()->name);
});
