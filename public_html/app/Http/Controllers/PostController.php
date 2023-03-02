<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;

class PostsController extends Controller
{

    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $post = new Post;
        $post->user_id = $data->input('userId');
        $post->title = $data->input('title');
        $post->body = $data->input('body');
        $post->save();
        return response()->json($post);
    }

    public function show($id)
    {
        $post = Post::find($id);
        return response()->json($post);
    }

    public function update(UpdatePostRequest $request, $id)
    {
        $data = $request->validated();
        $post = Post::find($id);
        $post->user_id = $data->input('userId');
        $post->title = $data->input('title');
        $post->body = $data->input('body');
        $post->save();
        return response()->json($post);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return response()->json(['message' => 'Post deleted']);
    }
}
