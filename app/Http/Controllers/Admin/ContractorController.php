<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Manages contractor accounts from the admin perspective.
 * Provides functionality to list, view, and manage contractor accounts.
 */
class ContractorController extends AdminController
{
    /**
     * Display a listing of all contractors.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $contractors = User::where('role', 'contractor')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('layouts.admin.contractors.index', compact('contractors'));
    }
    
    /**
     * Display the specified contractor profile.
     * 
     * @param  \App\Models\User  $contractor
     * @return \Illuminate\View\View
     */
    public function show(User $contractor)
    {
        if ($contractor->role !== 'contractor') {
            return redirect()->route('admin.contractors.index')
                ->with('error', 'Selected user is not a contractor.');
        }
        
        return view('layouts.admin.contractors.show', compact('contractor'));
    }
    
    /**
     * Get dashboard data for contractors.
     * Used for API endpoints to populate admin dashboard.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDashboardContractors()
    {
        $recentContractors = User::where('role', 'contractor')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        $verifiedCount = User::where('role', 'contractor')
            ->where('verification_status', 'approved')
            ->count();
            
        $pendingCount = User::where('role', 'contractor')
            ->where('documents_submitted_at', '!=', null)
            ->where('verification_status', '!=', 'approved')
            ->count();
            
        return response()->json([
            'recent' => $recentContractors,
            'verified_count' => $verifiedCount,
            'pending_count' => $pendingCount
        ]);
    }

    /**
     * Delete a contractor and all their related data.
     * 
     * @param  \App\Models\User  $contractor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $contractor)
    {
        if ($contractor->role !== 'contractor') {
            return redirect()->route('admin.contractors.index')
                ->with('error', 'Selected user is not a contractor.');
        }

        try {
            DB::beginTransaction();

            // Clear foreign key constraints for messages first
            DB::table('messages')->where('contractor_id', $contractor->id)->update(['contractor_id' => null]);
            DB::table('messages')->where('sender_id', $contractor->id)->update(['sender_id' => null]);
            DB::table('messages')->where('recipient_id', $contractor->id)->update(['recipient_id' => null]);
            
            // Delete related data
            $contractor->projects()->delete();
            $contractor->permits()->delete();
            $contractor->documents()->delete();
            $contractor->invoices()->delete();
            $contractor->sentMessages()->delete();
            $contractor->receivedMessages()->delete();
            $contractor->contractorMessages()->delete();
            $contractor->notifications()->delete();
            
            // Delete the associated Contractor record if it exists
            if ($contractor->contractor_id) {
                \App\Models\Contractor::where('id', $contractor->contractor_id)->delete();
            }
            
            // Delete the contractor user
            $contractor->delete();

            DB::commit();

            return redirect()->route('admin.contractors.index')
                ->with('success', 'Contractor and all related data have been deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->route('admin.contractors.index')
                ->with('error', 'Failed to delete contractor: ' . $e->getMessage());
        }
    }
} 