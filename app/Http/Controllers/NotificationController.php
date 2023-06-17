<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewNotification;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function markAsRead(Request $request, $notification)
    {
        if (Auth::check()) {
            $notification = $request->user()->notifications()->findOrFail($notification);
            $notification->markAsRead();
        }

        return response()->json(['message' => 'Notification marked as read']);
    }

    public function showAll()
    {
        $user = Auth::user();
        $notifications = $user->notifications->sortByDesc('created_at');

        return view('superadmin.notifications.notifications', compact('notifications'));
    }

    public function sendNotification(Request $request, $userId = null, $adminId = null, $employeeId = null, $clientId = null)
    {

        dd($request);
        $validatedData = $request->validate([
            'title' => 'required|string',
            'message' => 'required|string',
        ]);

        $notificationData = [
            'heading' => $validatedData['title'],
            'notification' => $validatedData['message'],
        ];

        // Determine the users based on the provided IDs
        $users = [];
        if ($userId !== null) {
            $users = User::where('id', $userId)->get();
        } elseif ($adminId !== null) {
            $users = User::where('id', $adminId)->where('role_id', 2)->get();
        } elseif ($employeeId !== null) {
            $users = User::where('id', $employeeId)->where('role_id', 3)->get();
        } elseif ($clientId !== null) {
            $users = User::where('id', $clientId)->where('role_id', 4)->get();
        } else {
            // No specific user ID provided, send to all admins
            $users = User::where('role_id', 2)->get();
        }

        Notification::send($users, new NewNotification($notificationData));

        return redirect()->back()->with('success', 'Notification sent successfully.');
    }

}
