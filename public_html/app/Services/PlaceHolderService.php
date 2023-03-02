<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Models\Posts;

class JsonPlaceholderService
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getPosts()
    {
        $response = $this->client->request('GET', 'https://jsonplaceholder.typicode.com/posts');

        return json_decode($response->getBody()->getContents(), true);
    }

    public function savePostsToDatabase()
    {

        $posts = self::getPosts();

        foreach ($posts as $post) {
            $existingPost = Posts::where('title', $post['title'])
                ->where('body', $post['body'])
                ->first();

            if (!$existingPost) {
                Posts::create([
                    'title' => $post['title'],
                    'body' => $post['body'],
                    'user_id' => $post['userId'],
                ]);
            }
        }
    }
}