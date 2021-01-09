<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user()->id);

        $notifications = $user->notifications;

        return view('notification.index', compact('notifications'));
    }

    public function read($id)
    {
        $user = User::find(Auth::user()->id);

        $notification = $user->notifications->where('id', $id)->first();

        $notification->markAsRead();

        return redirect('/notification');
    }

    public function delete($id)
    {
        $user = User::find(Auth::user()->id);

        $notification = $user->notifications->where('id', $id)->first();

        $notification->delete();

        return redirect('/notification');
    }
}
