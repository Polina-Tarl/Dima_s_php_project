<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Comment;
use App\Events\CommentCreated;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommentController extends Controller
{
    use AuthorizesRequests;
    public function store(Request $request, $postId)
    {
        $data = $request->validate([
            'content' => 'required|string|min:10',
        ]);

        $post = Post::findOrFail($postId);

        $comment = new Comment([
            'content' => $data['content'],
            'user_id' => Auth::id(),
        ]);

        $post->comments()->save($comment);

        CommentCreated::dispatch($comment);

        return response()->json($comment, 201);
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();

        return response()->json(['message' => 'Комментарий удалён']);
    }
}
