<?php


use App\Models\Project;

test('it creates a project if provided a name string', function () {
    $projectName = 'Laravel development';

    $response = $this->post('/api/projects', ['name' => $projectName]);

    $response->assertStatus(201);

    $project = Project::where(['name' => $projectName])->first();
    $this->assertEquals($projectName, $project->name);
});

test('it returns an error status if nothing is provided for the name input', function () {
    $response = $this->post('/api/projects', []);

    $response->assertStatus(422);

    $project = Project::first();

    $this->assertNull($project);
});

test('it returns an error status if the name input is not a string', function () {
    $response = $this->post('/api/projects', ['name' => 42]);

    $response->assertStatus(422);

    $project = Project::where(['name' => 42])->first();

    $this->assertNull($project);
});
