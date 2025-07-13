<?php

namespace App\Http\Controllers\Api;

use App\Events\PostCreated;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $posts = Post::with('user')
        ->latest()
        ->paginate(10);

        return response()->json($posts);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:10',
        ]);

        $post = Post::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'user_id' => Auth::id(),
        ]);
        $post->save();

        PostCreated::dispatch($post);

        return response()->json($post, 201);
    }

    public function show(Post $post)
    {
        $post->load(['user', 'comments.user']);
        return response()->json($post);
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post); // Проверка политики

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:10',
        ]);

        $post->update($data);
        return response()->json($post);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post); // проверка прав
        $post->delete();

        return response()->json(['message' => 'Post deleted']);
    }
}
