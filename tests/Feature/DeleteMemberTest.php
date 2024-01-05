<?php


use App\Models\Member;

test('it deletes a member if it exists', function () {
    $member = Member::factory()->create();
    $response = $this->delete('/api/members/' . $member->id);

    $response->assertStatus(204);
    $this->assertNull(Member::find($member->id));
});

test('it returns 404 if the member does not exist', function () {
    $member = Member::factory()->create();
    $response = $this->delete('/api/members/' . $member->id + 1);

    $response->assertStatus(404);
    $this->assertEquals($member->country, Member::find($member->id)->country);
});
