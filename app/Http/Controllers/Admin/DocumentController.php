<?php

namespace App\Http\Controllers\Admin;

use App\Models\Document;
use Illuminate\Http\Request;

/**
 * Manages documents from the admin perspective.
 * Provides functionality to list, view, and manage document submissions.
 */
class DocumentController extends AdminController
{
    /**
     * Display a listing of all documents.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $documents = Document::with('permit')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('layouts.admin.documents.index', compact('documents'));
    }
    
    /**
     * Display the specified document.
     * 
     * @param  \App\Models\Document  $document
     * @return \Illuminate\View\View
     */
    public function show(Document $document)
    {
        return view('layouts.admin.documents.show', compact('document'));
    }
    
    /**
     * Download the specified document.
     * 
     * @param  \App\Models\Document  $document
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(Document $document)
    {
        return response()->download(storage_path('app/' . $document->file_path), $document->original_filename);
    }
    
    /**
     * Preview the specified document.
     * 
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function preview(Document $document)
    {
        return response()->file(storage_path('app/' . $document->file_path));
    }
    
    /**
     * Get dashboard data for documents.
     * Used for API endpoints to populate admin dashboard.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDashboardDocuments()
    {
        $recentDocuments = Document::with('permit')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        $pendingCount = Document::where('document_status', 'pending')
            ->orWhere('document_status', null)
            ->count();
            
        $approvedCount = Document::where('document_status', 'approved')
            ->count();
            
        return response()->json([
            'recent' => $recentDocuments,
            'pending_count' => $pendingCount,
            'approved_count' => $approvedCount
        ]);
    }
    
    /**
     * Approve a document.
     * 
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve(Document $document)
    {
        $document->update([
            'document_status' => 'approved'
        ]);
        
        return redirect()->back()->with('success', 'Document has been approved.');
    }
    
    /**
     * Reject a document.
     * 
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reject(Document $document)
    {
        $document->update([
            'document_status' => 'rejected'
        ]);
        
        return redirect()->back()->with('success', 'Document has been rejected.');
    }

    /**
     * Show the form for uploading a new document.
     * 
     * @return \Illuminate\View\View
     */
    public function upload()
    {
        $contractors = \App\Models\User::where('role', 'contractor')->get();
        return view('layouts.admin.documents.upload', compact('contractors'));
    }

    /**
     * Store a new document with proper folder organization.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeDocument(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'contractor_id' => 'required|exists:users,id',
            'category' => 'required|string',
            'subcategory' => 'nullable|string',
            'file' => 'required|file|max:10240',
        ]);
        
        // Get contractor info
        $contractor = \App\Models\User::findOrFail($validated['contractor_id']);
        
        // Generate folder path
        $folderPath = 'contractors/' . $contractor->id . '_' . strtolower(str_replace(' ', '_', $contractor->name));
        
        // Add category subfolder
        $folderPath .= '/' . strtolower(str_replace(' ', '_', $validated['category']));
        
        // Add subcategory if provided
        if (!empty($validated['subcategory'])) {
            $folderPath .= '/' . strtolower(str_replace(' ', '_', $validated['subcategory']));
        }
        
        // Store the file
        $file = $request->file('file');
        $path = $file->store($folderPath, 'public');
        
        // If the file is related to a permit, find or create it
        $permit = null;
        if ($validated['category'] === 'permits' && !empty($validated['subcategory'])) {
            $permit = \App\Models\Permit::where('permit_number', $validated['subcategory'])
                ->where('contractor_id', $contractor->id)
                ->first();
        }
        
        // Create document record
        $document = new \App\Models\Document([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'file_path' => $path,
            'file_type' => $file->getClientMimeType(),
            'file_size' => $file->getSize(),
            'document_status' => 'pending',
        ]);
        
        // Associate with permit if found
        if ($permit) {
            $document->permit_id = $permit->id;
        }
        
        $document->save();
        
        return redirect()->route('admin.documents.index')
            ->with('success', 'Document uploaded and organized successfully.');
    }

    /**
     * Create a new category folder for organization.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createFolder(Request $request)
    {
        $validated = $request->validate([
            'contractor_id' => 'required|exists:users,id',
            'folder_name' => 'required|string|max:255',
            'parent_folder' => 'nullable|string',
        ]);
        
        // Get contractor info
        $contractor = \App\Models\User::findOrFail($validated['contractor_id']);
        
        // Base path for contractor
        $basePath = 'public/contractors/' . $contractor->id . '_' . strtolower(str_replace(' ', '_', $contractor->name));
        
        // Add parent folder if provided
        if (!empty($validated['parent_folder'])) {
            $basePath .= '/' . $validated['parent_folder'];
        }
        
        // Add new folder
        $newFolderPath = $basePath . '/' . strtolower(str_replace(' ', '_', $validated['folder_name']));
        
        // Create the directory
        \Illuminate\Support\Facades\Storage::makeDirectory($newFolderPath);
        
        return redirect()->back()
            ->with('success', 'Folder created successfully.');
    }
    
    /**
     * List folders for a contractor.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function listFolders(Request $request)
    {
        $validated = $request->validate([
            'contractor_id' => 'required|exists:users,id',
            'path' => 'nullable|string',
        ]);
        
        // Get contractor info
        $contractor = \App\Models\User::findOrFail($validated['contractor_id']);
        
        // Base path for contractor
        $basePath = 'contractors/' . $contractor->id . '_' . strtolower(str_replace(' ', '_', $contractor->name));
        
        // Add path if provided
        if (!empty($validated['path'])) {
            $basePath .= '/' . $validated['path'];
        }
        
        // List directories
        $directories = \Illuminate\Support\Facades\Storage::disk('public')->directories($basePath);
        
        // Format directory names
        $folders = [];
        foreach ($directories as $dir) {
            $folderName = basename($dir);
            $relativePath = str_replace($basePath . '/', '', $dir);
            $folders[] = [
                'name' => $folderName,
                'path' => $relativePath,
                'full_path' => $dir,
            ];
        }
        
        return response()->json(['folders' => $folders]);
    }
} 