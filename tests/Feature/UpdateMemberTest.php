<?php


use App\Models\Member;

test('it expects the same data to be provided as in a create request', function () {
    $member = Member::factory()->create();

    $response = $this->patch('/api/members/' . $member->id, []);

    $response->assertStatus(422);
});

test('it updates a member with a valid member request', function () {
    $city = 'New York';
    $state = 'NY';
    $member = Member::factory()->create(['country' => 'US']);

    $response = $this->patch('/api/members/' . $member->id, [
        'team_id' => $member->team_id,
        'first_name' => $member->first_name,
        'last_name' => $member->last_name,
        'city' => $city,
        'state' => $state,
        'country' => $member->country
    ]);

    $response->assertStatus(200);
    $this->assertEquals($city, $member->fresh()->city);
    $this->assertEquals($state, $member->fresh()->state);
});
