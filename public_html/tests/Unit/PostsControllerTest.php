<?php

namespace Tests\Unit;

use App\Models\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\TestCase;

class PostsControllerTest extends TestCase
{
    use DatabaseMigrations, WithFaker;

    public function testIndex()
    {
        Post::factory()->count(10)->create();
        $response = $this->get('/post');
        $response->assertStatus(200);
        $response->assertJsonCount(10);
    }

    public function testStore()
    {
        $data = [
            'userId' => $this->faker->randomDigitNotNull,
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
        ];
        $response = $this->postJson('/post', $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('posts', $data);
    }

    public function testUpdate()
    {
        $post = Post::factory()->create();
        $data = [
            'userId' => $this->faker->randomDigitNotNull,
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
        ];
        $response = $this->putJson("/post/$post->id", $data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('posts', $data);
    }

    public function testDestroy()
    {
        $post = Post::factory()->create();
        $response = $this->delete("/post/$post->id");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
}
