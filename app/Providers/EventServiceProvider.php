<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Events\CommentCreated;
use App\Events\PostCreated;
use App\Listeners\NotifyPostAuthor;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        \App\Events\PostCreated::class => [
            \App\Listeners\NotifyAdminAboutNewPost::class,
        ],
    ];
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
