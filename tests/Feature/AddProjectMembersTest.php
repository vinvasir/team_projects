<?php


use App\Models\Member;
use App\Models\Project;

test('it can add a member to a project', function () {
    $project = Project::factory()->create();
    $member = Member::factory()->create();

    $response = $this->post('/api/projects/' . $project->id . '/members', ['member_id' => $member->id]);

    $response->assertStatus(201);
    $this->assertContains($member->id, $project->members()->pluck('id'));
});
