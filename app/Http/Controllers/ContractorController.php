<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ContractorController extends Controller
{
    /**
     * Display a listing of contractors
     */
    public function index()
    {
        $contractors = User::where('role', 'contractor')->get();
        return view('layouts.admin.contractors.index', compact('contractors'));
    }

    /**
     * Display the specified contractor details
     */
    public function show(User $contractor)
    {
        return view('layouts.admin.contractors.show', compact('contractor'));
    }

    /**
     * Get contractors for the admin dashboard
     */
    public function getDashboardContractors()
    {
        $contractors = User::where('role', 'contractor')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        return response()->json($contractors);
    }
} 