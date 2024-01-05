<?php


use App\Models\Project;

test('it shows the details of a project if it exists', function () {
    $project = Project::factory()->create();

    $response = $this->get('/api/projects/' . $project->id);

    $response->assertStatus(200)
        ->assertJsonFragment(['name' => $project->name]);
});

test('it returns a 404 if the project does not exist', function () {
    $response = $this->get('/api/projects/42');

    $response->assertStatus(404);
});
