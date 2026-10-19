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

test('user can only see their own galleries - cross-tenant isolation', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $user1Galleries = Gallery::factory()->count(2)->create(['user_id' => $user1->id]);
    $user2Galleries = Gallery::factory()->count(3)->create(['user_id' => $user2->id]);

    $response = $this->actingAs($user1)
        ->getJson(route('galleries.list', ['per_page' => 50]));

    $response->assertStatus(200);

    $data = $response->json();
    $returnedGalleries = $data['data']['result']['data'];

    expect($data['data']['countItems'])->toBe(2);
    expect($returnedGalleries)->toHaveCount(2);

    // Verify all returned galleries belong to user1
    foreach ($returnedGalleries as $gallery) {
        expect($gallery['user_id'])->toBe($user1->id);
    }

    // Verify user2's galleries are NOT returned
    $user2GalleryIds = $user2Galleries->pluck('uuid')->toArray();
    $returnedUuids = collect($returnedGalleries)->pluck('uuid')->toArray();

    foreach ($user2GalleryIds as $user2GalleryId) {
        expect(in_array($user2GalleryId, $returnedUuids))->toBeFalse();
    }
});

test('different users see different gallery lists', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    Gallery::factory()->create(['user_id' => $user1->id, 'name' => 'User1 Gallery']);
    Gallery::factory()->create(['user_id' => $user2->id, 'name' => 'User2 Gallery']);

    $response1 = $this->actingAs($user1)
        ->getJson(route('galleries.list', ['per_page' => 50]));

    $response2 = $this->actingAs($user2)
        ->getJson(route('galleries.list', ['per_page' => 50]));

    $data1 = $response1->json();
    $data2 = $response2->json();

    expect($data1['data']['countItems'])->toBe(1);
    expect($data2['data']['countItems'])->toBe(1);

    expect($data1['data']['result']['data'][0]['name'])->toBe('User1 Gallery');
    expect($data2['data']['result']['data'][0]['name'])->toBe('User2 Gallery');

    expect($data1['data']['result']['data'][0]['user_id'])->toBe($user1->id);
    expect($data2['data']['result']['data'][0]['user_id'])->toBe($user2->id);
});

test('unauthenticated user cannot list galleries', function () {
    $response = $this->getJson(route('galleries.list'));

    $response->assertStatus(401);
});
