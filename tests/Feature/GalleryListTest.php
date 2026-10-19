<?php

use App\Models\Gallery;
use App\Models\User;

test('authenticated user can list their galleries with pagination', function () {
    $user = User::factory()->create();
    Gallery::factory()->count(3)->create(['user_id' => $user->id]);
    Gallery::factory()->create(['user_id' => User::factory()->create()->id]);

    $response = $this->actingAs($user)
        ->getJson(route('galleries.list', ['per_page' => 50]));

    $response->assertStatus(200)
        ->assertJsonStructure([
            'status',
            'message',
            'data' => [
                'countItems',
                'result' => [
                    'data',
                    'current_page',
                    'per_page',
                ],
            ],
            'errors',
        ]);

    $data = $response->json();
    expect($data['data']['countItems'])->toBe(3);
    expect($data['data']['result']['data'])->toHaveCount(3);
    expect($data['data']['result']['data'][0]['user_id'])->toBe($user->id);
});

test('unauthenticated user cannot list galleries', function () {
    $response = $this->getJson(route('galleries.list'));

    $response->assertStatus(401);
});
