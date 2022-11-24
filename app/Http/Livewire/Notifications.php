<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Notifications extends Component
{
    public function render()
    {
        $user = User::find(auth()->user()->id);
        $unreadNotifications = $user->unreadNotifications;
        $notifications = $user->notifications;
        return view('livewire.notifications',[
            'notifications' => $notifications,
            'user' => $user,
            'numOfNotification' => sizeof($notifications),
            'unreadNotification' => sizeof($unreadNotifications)
        ]);
    }
}
