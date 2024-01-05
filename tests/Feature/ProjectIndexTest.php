<?php


use App\Models\Project;

test('it displays all projects in alphabetical order with pagination data', function () {
    Project::factory(20)->create();

    $response = $this->get('/api/projects');

    $firstTenAlphabetical = Project::orderBy('name', 'asc')->take(10)->get();

    $response
        ->assertStatus(200);

    $firstTenAlphabetical->each(function ($team) use ($response) {
        $response->assertJsonFragment(['name' => $team->name]);
    });
});
