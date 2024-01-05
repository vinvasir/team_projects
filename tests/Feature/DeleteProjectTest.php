<?php

use App\Models\Project;

test('it deletes a project', function () {
    $project = Project::factory()->create();
    $response = $this->delete('/api/projects/' . $project->id);

    $response->assertStatus(204);
    $this->assertNull(Project::find($project->id));
});

test('it returns 404 if an incorrect id is provided', function () {
    $project = Project::factory()->create();
    $response = $this->delete('/api/projects/' . $project->id + 1);

    $response->assertStatus(404);
    $this->assertEquals($project->name, Project::find($project->id)->name);
});
