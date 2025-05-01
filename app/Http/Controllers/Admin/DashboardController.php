<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use App\Models\Document;

/**
 * Handles the admin dashboard functionality.
 * Provides data and views for the main admin dashboard.
 */
class DashboardController extends AdminController
{
    /**
     * Display the admin dashboard.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get summary data for dashboard
        $contractorsCount = User::where('role', 'contractor')->count();
        $pendingVerificationsCount = User::where('role', 'contractor')
            ->where('documents_submitted_at', '!=', null)
            ->where('verification_status', '!=', 'approved')
            ->count();
        
        // Documents data
        $documentsCount = 0;
        $pendingDocumentsCount = 0;
        $todayDocumentsCount = 0;
        
        if (class_exists(Document::class)) {
            $documentsCount = Document::count();
            $pendingDocumentsCount = Document::where('document_status', 'pending')
                ->orWhere('document_status', null)
                ->count();
            $todayDocumentsCount = Document::whereDate('created_at', now()->toDateString())->count();
        }
        
        // Projects and other data
        $projectsCount = 0;
        $tasksCount = 0;
        
        // Add additional model checks if these classes exist
        if (class_exists(Project::class)) {
            $projectsCount = Project::count();
        }
        
        if (class_exists(Task::class)) {
            $tasksCount = Task::count();
        }
        
        return view('layouts.admin.dashboard', compact(
            'contractorsCount',
            'pendingVerificationsCount',
            'projectsCount',
            'tasksCount',
            'documentsCount',
            'pendingDocumentsCount',
            'todayDocumentsCount'
        ));
    }
} 