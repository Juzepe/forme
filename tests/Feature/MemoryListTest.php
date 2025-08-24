<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MemoryListTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_memory_lists_index(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get('/memory-lists');

        $response->assertStatus(200);
    }

    public function test_user_can_view_create_memory_list_form(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get('/memory-lists/create');

        $response->assertStatus(200);
    }
}
