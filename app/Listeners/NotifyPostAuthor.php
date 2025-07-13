<?php

namespace App\Listeners;

use App\Events\CommentCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class NotifyPostAuthor implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CommentCreated $event): void
    {
        $comment = $event->comment;
        $post = $comment->post;
        $author = $post->user;

        Log::info("Новый комментарий к посту #{$post->id} от {$comment->user->name}. Автор поста: {$author->email}");
    }
}
