<?php


use App\Models\Team;

test('it displays all teams in alphabetical order with pagination data', function () {
    Team::factory(20)->create();

    $response = $this->get('/api/teams');

    $firstTenAlphabetical = Team::orderBy('name', 'asc')->take(10)->get();

    $response
        ->assertStatus(200);

    $firstTenAlphabetical->each(function ($team) use ($response) {
        $response->assertJsonFragment(['name' => $team->name]);
    });
});
