<?php


use App\Models\Member;

test('it shows the details of a member if they exist', function () {
    $member = Member::factory()->create();

    $response = $this->get('/api/members/' . $member->id);

    $response->assertStatus(200)
        ->assertJsonFragment(['city' => $member->city]);
});

test('it returns 404 if the member does not exist', function () {
    $response = $this->get('/api/members/42');

    $response->assertStatus(404);
});
