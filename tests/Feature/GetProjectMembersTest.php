<?php


use App\Models\Member;
use App\Models\Project;

test('it shows all members of a project, paginated in alphabetical order', function () {
    $project = Project::factory()->create();
    $project->members()->sync(Member::factory(25)->create());

    $response = $this->get('/api/projects/' . $project->id . '/members');

    $firstTenAlphabetical = $project->members()->orderBy('last_name', 'asc')->take(10)->get();

    $response->assertStatus(200);

    $firstTenAlphabetical->each(function ($member) use ($response) {
        $response->assertJsonFragment(['last_name' => $member->last_name]);
    });
});
