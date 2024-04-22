<?php

namespace App\View\Components;

use App\Models\Notification;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    public $allNotifications;

    public function __construct()
    {
        $this->allNotifications = Notification::orderByDesc('id')->take(10)->get();
    }
    public function render(): View
    {
        return view('layouts.app');
    }
}
