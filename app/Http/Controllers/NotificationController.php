<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    // Retourne la vue d'affichage de toutes les notifications
    public function index()
    {
        $notifications = Notification::with('module')->orderByDesc('id')->paginate(10);
        return view('notifications', compact('notifications'));
    }

    // Retourne la vue d'affichage de module avec notifications
    public function show(string $id)
    {
        $notification = Notification::findOrFail($id);
        return redirect()->route('modules.show', $notification->module_id);
    }

    // Pour marquer une notification comme lu et renvoie vers la page précédente
    public function read($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->read = 1;
        $notification->save();

        return redirect()->back();
    }
}
