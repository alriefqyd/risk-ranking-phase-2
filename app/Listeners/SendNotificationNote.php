<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\ProjectNote;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use Illuminate\Queue\InteractsWithQueue;

class SendNotificationNote
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $admins = User::find($event->project->created_by);
        Notification::send($admins, new ProjectNote($event->project));
    }
}
