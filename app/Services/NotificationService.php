<?php

namespace App\Services;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Database\Eloquent\Model;

class NotificationService
{
    /**
     * Create a new notification for a user
     *
     * @param User $user
     * @param string $message
     * @param Model|null $related
     * @param string $type
     * @param string|null $url
     * @param string|null $title
     * @return Notification
     */
    public static function notify(User $user, string $message, ?Model $related = null, string $type = 'info', ?string $url = null, ?string $title = null)
    {
        // Generate a title from the message if not provided
        if ($title === null) {
            // Limit title to first 50 characters of message
            $title = mb_strlen($message) > 50 ? mb_substr($message, 0, 47) . '...' : $message;
        }
        
        $notification = new Notification([
            'user_id' => $user->id,
            'title' => $title,
            'message' => $message,
            'type' => $type,
            'url' => $url,
            'read' => false,
        ]);
        
        if ($related) {
            $notification->related_type = get_class($related);
            $notification->related_id = $related->id;
        }
        
        $notification->save();
        
        return $notification;
    }
    
    /**
     * Send a notification to multiple users
     *
     * @param array $userIds
     * @param string $message
     * @param Model|null $related
     * @param string $type
     * @param string|null $url
     * @param string|null $title
     * @return array
     */
    public static function notifyMany(array $userIds, string $message, ?Model $related = null, string $type = 'info', ?string $url = null, ?string $title = null)
    {
        $notifications = [];
        
        foreach ($userIds as $userId) {
            $user = User::find($userId);
            if ($user) {
                $notifications[] = self::notify($user, $message, $related, $type, $url, $title);
            }
        }
        
        return $notifications;
    }
    
    /**
     * Notify all users with a specific role
     *
     * @param string $role
     * @param string $message
     * @param Model|null $related
     * @param string $type
     * @param string|null $url
     * @param string|null $title
     * @return array
     */
    public static function notifyRole(string $role, string $message, ?Model $related = null, string $type = 'info', ?string $url = null, ?string $title = null)
    {
        $users = User::where('role', $role)->pluck('id')->toArray();
        return self::notifyMany($users, $message, $related, $type, $url, $title);
    }
    
    /**
     * Get unread count for a user
     *
     * @param User $user
     * @return int
     */
    public static function unreadCount(User $user)
    {
        return Notification::where('user_id', $user->id)
            ->where('read', false)
            ->count();
    }
    
    /**
     * Mark all notifications as read for a user
     *
     * @param User $user
     * @return void
     */
    public static function markAllAsRead(User $user)
    {
        Notification::where('user_id', $user->id)
            ->where('read', false)
            ->update(['read' => true]);
    }
} 