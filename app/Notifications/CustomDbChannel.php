<?php

namespace App\Notifications;

use \Illuminate\Notifications\Notification;

class CustomDbChannel
{
    public function send($notifiable, Notification $notification){
        $data = $notification->toArray($notifiable);
        return $notifiable->routeNotificationFor('database')->create([
            'id' => $notification->id,
            'project_id' => $data['project_id'],
            'owner_id' => $data['owner_id'],
            'type' => get_class($notification),
            'data' => $data,
            'read_at' => null,
        ]);
    }
}
