<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Base controller for all admin-related controllers.
 * Provides common functionality and standardizes admin controller behavior.
 * All admin controllers should extend this class.
 */
class AdminController extends Controller
{
    /**
     * Create a new AdminController instance.
     * 
     * @return void
     */
    public function __construct()
    {
        // Admin middleware is applied in route groups
    }
    
    /**
     * Get admin dashboard view.
     * 
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        return view('layouts.admin.dashboard');
    }
} 