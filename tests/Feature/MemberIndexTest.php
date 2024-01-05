<?php


use App\Models\Member;

test('it displays members, paginated in last name alphabetical order', function () {
    $response = $this->get('/api/members');

    $firstTenAlphabetical = Member::orderBy('last_name', 'asc')->take(10)->get();

    $response
        ->assertStatus(200);

    $firstTenAlphabetical->each(function ($member) use ($response) {
        $response->assertJsonFragment(['name' => $member->last_name]);
    });
});
