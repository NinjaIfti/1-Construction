<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;

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
} 