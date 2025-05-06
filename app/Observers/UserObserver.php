<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Contractor;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        if ($user->role === 'contractor') {
            // Create a contractor record for the user
            $contractor = Contractor::create([
                'name' => $user->name,
                'email' => $user->email,
                'company_name' => $user->name . "'s Company", // Default company name
                'status' => 'active',
            ]);

            // Update the user with the contractor_id
            $user->update(['contractor_id' => $contractor->id]);
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        // If user role is changed to contractor
        if ($user->role === 'contractor' && !$user->contractor_id) {
            $contractor = Contractor::create([
                'name' => $user->name,
                'email' => $user->email,
                'company_name' => $user->name . "'s Company", // Default company name
                'status' => 'active',
            ]);

            $user->update(['contractor_id' => $contractor->id]);
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        // If user is a contractor, delete their contractor record
        if ($user->contractor_id) {
            Contractor::where('id', $user->contractor_id)->delete();
        }
    }
} 