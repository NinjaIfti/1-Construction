<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        
        $notification->update(['read' => true]);
        
        return response()->json(['success' => true]);
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead()
    {
        $user = Auth::user();
        
        $user->notifications()
            ->where('read', false)
            ->update(['read' => true]);
            
        return response()->json(['success' => true]);
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
     * Get all unread notifications for the current user
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUnreadNotifications()
    {
        $user = Auth::user();
        
        $notifications = $user->notifications()
            ->where('read', false)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function($notification) {
                return [
                    'id' => $notification->id,
                    'message' => $notification->message,
                    'type' => $notification->type,
                    'date' => $notification->created_at->format('M d'),
                    'url' => $notification->url
                ];
            });
            
        return response()->json($notifications);
    }
    
    /**
     * Get recent notifications for dashboard display
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRecentNotifications()
    {
        $user = Auth::user();
        
        $notifications = $user->notifications()
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function($notification) {
                return [
                    'id' => $notification->id,
                    'message' => $notification->message,
                    'type' => $notification->type,
                    'date' => $notification->created_at->format('M d'),
                    'url' => $notification->url,
                    'read' => (bool) $notification->read
                ];
            });
            
        return response()->json($notifications);
    }
} 