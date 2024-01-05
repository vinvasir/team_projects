<?php


use App\Models\Member;

test('it creates a member if provided a first_name and last_name', function () {
    $firstName = 'Programmer';
    $lastName = 'Dev';

    $response = $this->post('/api/members', [
        'first_name' => $firstName,
        'last_name' => $lastName
    ]);

    $response->assertStatus(201);
    $member = Member::where(['first_name' => $firstName, 'last_name' => $lastName])->first();
    $this->assertEquals($firstName, $member->first_name);
    $this->assertEquals($lastName, $member->last_name);
});

test('it allows the addition of city, state, and country', function () {
    $firstName = 'Programmer';
    $lastName = 'Dev';
    $city = 'Los Angeles';
    $state = 'CA';
    $country = 'US';

    $response = $this->post('/api/members', [
        'first_name' => $firstName,
        'last_name' => $lastName,
        'city' => $city,
        'state' => $state,
        'country' => $country
    ]);

    $response->assertStatus(201);
    $member = Member::where(['first_name' => $firstName, 'last_name' => $lastName])->first();
    $this->assertEquals($firstName, $member->first_name);
    $this->assertEquals($lastName, $member->last_name);
    $this->assertEquals($city, $member->city);
    $this->assertEquals($state, $member->state);
    $this->assertEquals($country, $member->country);
});

it('returns an http error if missing a first_name or last_name', function () {
    $lastName = 'Dev';

    $response = $this->post('/api/members', [
        'last_name' => $lastName
    ]);

    $response->assertStatus(422);
    $member = Member::where(['last_name' => $lastName])->first();
    $this->assertNull($member);
});

it('provides an http error if first_name or last_name are not strings', function () {
    $firstName = 'Programmer';
    $lastName = 42;

    $response = $this->post('/api/members', [
        'first_name' => $firstName,
        'last_name' => $lastName
    ]);

    $response->assertStatus(422);
    $member = Member::where(['first_name' => 'Programmer'])->first();
    $this->assertNull($member);
});

it('rejects an otherwise correct request that provides an invalid country abbreviation', function () {
    $firstName = 'Programmer';
    $lastName = 'Dev';
    $city = 'Los Angeles';
    $state = 'CA';
    $country = 'USofB';

    $response = $this->post('/api/members', [
        'first_name' => $firstName,
        'last_name' => $lastName,
        'city' => $city,
        'state' => $state,
        'country' => $country
    ]);

    $response->assertStatus(422);
    $member = Member::where(['last_name' => $lastName])->first();
    $this->assertNull($member);
});

it('rejects an otherwise correct request if a state is provided that does not belong to the country provided', function () {
    $firstName = 'Programmer';
    $lastName = 'Dev';
    $city = 'Los Angeles';
    $state = 'CA';
    $country = 'GB';

    $response = $this->post('/api/members', [
        'first_name' => $firstName,
        'last_name' => $lastName,
        'city' => $city,
        'state' => $state,
        'country' => $country
    ]);

    $response->assertStatus(422);
    $member = Member::where(['last_name' => $lastName])->first();
    $this->assertNull($member);
});
