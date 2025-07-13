<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewPostCreated extends Notification implements ShouldQueue
{
    use Queueable;

    public Post $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Новый пост создан')
            ->line("Пользователь {$this->post->user->name} создал пост: {$this->post->title}")
            ->action('Посмотреть пост', url("/posts/{$this->post->id}"))
            ->line('Это автоматическое уведомление.');
    }
}
