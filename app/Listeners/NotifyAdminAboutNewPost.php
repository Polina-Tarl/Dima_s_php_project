<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Models\User;
use App\Notifications\NewPostCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log;

class NotifyAdminAboutNewPost implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(PostCreated $event)
    {
        $admin = User::where('is_admin', true)->first();

        if ($admin) {
            Notification::send($admin, new NewPostCreated($event->post));
            Log::info("Письмо успешно отправлено админу на email: {$admin->email}");
        } else {
            Log::warning('Администратор не найден. Уведомление не отправлено.');
        }
    }
}
