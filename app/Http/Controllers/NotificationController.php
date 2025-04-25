<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the user's notifications.
     */
    public function index()
    {
        $notifications = Auth::user()->notifications()
            ->with('permit.project')
            ->latest()
            ->paginate(15);
            
        return view('notifications.index', compact('notifications'));
    }

    /**
     * Display all unread notifications.
     */
    public function unread()
    {
        $notifications = Auth::user()->notifications()
            ->unread()
            ->with('permit.project')
            ->latest()
            ->paginate(15);
            
        return view('notifications.unread', compact('notifications'));
    }

    /**
     * Show a specific notification.
     */
    public function show(Notification $notification)
    {
        $this->authorize('view', $notification);
        
        // Mark notification as read
        if (!$notification->read) {
            $notification->markAsRead();
        }
        
        // If notification is related to a permit, redirect to that permit
        if ($notification->permit_id) {
            return redirect()->route('permits.show', $notification->permit_id);
        }
        
        return redirect()->route('notifications.index')
            ->with('success', 'Notification marked as read.');
    }

    /**
     * Mark a notification as read.
     */
    public function markAsRead(Notification $notification)
    {
        $this->authorize('update', $notification);
        
        $notification->markAsRead();
        
        return redirect()->back()
            ->with('success', 'Notification marked as read.');
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead()
    {
        Auth::user()->notifications()
            ->unread()
            ->update(['read' => true]);
            
        return redirect()->back()
            ->with('success', 'All notifications marked as read.');
    }

    /**
     * Delete a notification.
     */
    public function destroy(Notification $notification)
    {
        $this->authorize('delete', $notification);
        
        $notification->delete();
        
        return redirect()->route('notifications.index')
            ->with('success', 'Notification deleted.');
    }

    /**
     * Get unread notification count.
     */
    public function getUnreadCount()
    {
        $count = Auth::user()->notifications()->unread()->count();
        
        return response()->json(['count' => $count]);
    }

    /**
     * Get recent unread notifications for navbar dropdown.
     */
    public function getRecentNotifications()
    {
        $notifications = Auth::user()->notifications()
            ->with('permit.project')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($notification) {
                return [
                    'id' => $notification->id,
                    'title' => $notification->title,
                    'message' => substr($notification->message, 0, 100) . (strlen($notification->message) > 100 ? '...' : ''),
                    'read' => $notification->read,
                    'created_at' => $notification->created_at->diffForHumans(),
                    'permit_id' => $notification->permit_id,
                ];
            });
            
        return response()->json([
            'notifications' => $notifications,
            'unread_count' => Auth::user()->notifications()->unread()->count(),
        ]);
    }
} 