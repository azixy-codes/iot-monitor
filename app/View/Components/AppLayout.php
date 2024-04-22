<?php

namespace App\View\Components;

use App\Models\Notification;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $allNotifications = Notification::orderByDesc('id')->take(10)->get();
        return view('layouts.app', compact('allNotifications'));
    }
}
