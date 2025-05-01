<?php

namespace App\Http\Controllers\Admin;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Manages documents from the admin perspective.
 * Provides functionality to list, view, and manage document submissions.
 */
class DocumentController extends AdminController
{
    /**
     * Display a listing of all documents.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Document::with(['permit', 'contractor', 'folder']);
        
        // Filter by contractor if requested
        if ($request->has('contractor_id') && $request->contractor_id) {
            $query->where('contractor_id', $request->contractor_id);
        }
        
        // Filter by category/folder if requested
        if ($request->has('category') && $request->category) {
            $query->whereHas('folder', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->category . '%');
            });
        }
        
        $documents = $query->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();
        
        // Get all contractors for the filter dropdown
        $contractors = \App\Models\User::where('role', 'contractor')->orderBy('name')->get();
        
        return view('layouts.admin.documents.index', compact('documents', 'contractors'));
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
        $path = $document->file_path;
        $filename = basename($path);
        
        // Try both storage locations
        if (Storage::exists($path)) {
            return response()->download(storage_path('app/' . $path), $document->name . '.' . $document->extension);
        } elseif (Storage::disk('public')->exists($path)) {
            return response()->download(storage_path('app/public/' . $path), $document->name . '.' . $document->extension);
        }
        
        // If file doesn't exist in either location, fallback to the original path
        return response()->download(storage_path('app/' . $path), $document->name . '.' . $document->extension);
    }
    
    /**
     * Preview the specified document.
     * 
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function preview(Document $document)
    {
        $path = $document->file_path;
        
        // Try both storage locations
        if (Storage::exists($path)) {
            return response()->file(storage_path('app/' . $path));
        } elseif (Storage::disk('public')->exists($path)) {
            return response()->file(storage_path('app/public/' . $path));
        }
        
        // If file doesn't exist in either location, fallback to the original path
        return response()->file(storage_path('app/' . $path));
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
            'folder_id' => 'nullable|exists:document_folders,id',
            'file' => 'required|file|max:10240',
        ]);
        
        // Get contractor info
        $contractor = \App\Models\User::findOrFail($validated['contractor_id']);
        
        // Use existing folder if provided
        $folder = null;
        if (!empty($validated['folder_id'])) {
            $folder = \App\Models\DocumentFolder::findOrFail($validated['folder_id']);
        } else {
            // Create default folder if none provided
            $folder = \App\Models\DocumentFolder::firstOrCreate([
                'name' => 'General',
                'user_id' => $contractor->id,
                'parent_folder_id' => null
            ]);
        }
        
        // Generate folder path based on folder structure
        $folderPath = 'contractors/' . $contractor->id . '_' . strtolower(str_replace(' ', '_', $contractor->name));
        
        // Add folder name to path
        $currentFolder = $folder;
        $folderNames = [];
        
        while ($currentFolder) {
            array_unshift($folderNames, strtolower(str_replace(' ', '_', $currentFolder->name)));
            $currentFolder = $currentFolder->parentFolder;
        }
        
        $folderPath .= '/' . implode('/', $folderNames);
        
        // Store the file
        $file = $request->file('file');
        $path = $file->store($folderPath, 'public');
        
        // Make sure we store path without 'public/' prefix for consistent access
        $path = str_replace('public/', '', $path);
        
        // Create document record
        $document = new \App\Models\Document([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'file_path' => $path,
            'file_type' => $file->getClientMimeType(),
            'file_size' => $file->getSize(),
            'document_status' => 'pending',
            'contractor_id' => $contractor->id,
            'folder_id' => $folder->id,
            'uploaded_by' => auth()->id()
        ]);
        
        $document->save();
        
        // Redirect back based on where the upload was initiated
        if ($request->has('from_folder') && $request->from_folder) {
            return redirect()->route('admin.documents.folder', $folder)
                ->with('success', 'Document uploaded successfully.');
        }
        
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

    /**
     * Browse folders for a specific contractor.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function folders(Request $request)
    {
        $request->validate([
            'contractor_id' => 'required|exists:users,id',
        ]);
        
        $contractor = \App\Models\User::findOrFail($request->contractor_id);
        
        // Get root folders for this contractor
        $rootFolders = \App\Models\DocumentFolder::where('user_id', $contractor->id)
            ->whereNull('parent_folder_id')
            ->with(['subfolders', 'documents'])
            ->get();
        
        $contractors = \App\Models\User::where('role', 'contractor')->orderBy('name')->get();
        
        return view('layouts.admin.documents.folders', compact('contractor', 'rootFolders', 'contractors'));
    }

    /**
     * Show documents in a specific folder.
     * 
     * @param  \App\Models\DocumentFolder  $folder
     * @return \Illuminate\View\View
     */
    public function folderDocuments(\App\Models\DocumentFolder $folder)
    {
        $folder->load(['subfolders', 'documents']);
        $contractor = $folder->user;
        
        // Get breadcrumb data
        $breadcrumbs = [];
        $currentFolder = $folder;
        
        while ($currentFolder) {
            array_unshift($breadcrumbs, $currentFolder);
            $currentFolder = $currentFolder->parentFolder;
        }
        
        return view('layouts.admin.documents.folder', compact('folder', 'contractor', 'breadcrumbs'));
    }
} 