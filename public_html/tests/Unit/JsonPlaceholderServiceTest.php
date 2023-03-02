<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class JsonPlaceholderServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function testGetPosts()
    {
        $jsonPlaceholderService = app(JsonPlaceholderService::class);
        $posts = $jsonPlaceholderService->getPosts();

        $this->assertIsArray($posts);
        $this->assertNotEmpty($posts);
        $this->assertArrayHasKey('userId', $posts[0]);
        $this->assertArrayHasKey('title', $posts[0]);
        $this->assertArrayHasKey('body', $posts[0]);
        }

    public function testSavePostsToDatabase()
    {
        $jsonPlaceholderService = app(JsonPlaceholderService::class);
        $jsonPlaceholderService->savePostsToDatabase();

        $this->assertDatabaseCount('posts', 100);
    }
    
}
