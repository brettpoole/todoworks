<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class TodoTest extends TestCase
{
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->make();
    }

    /** @test */
    public function a_new_user_can_create_a_todo_item()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }
}
