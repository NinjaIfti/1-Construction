<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentFolder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ClientDocumentController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the user's documents.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $currentFolder = null;
        $folderId = $request->query('folder_id');
        
        \Log::info('Loading documents index', [
            'user_id' => $user->id,
            'requested_folder_id' => $folderId
        ]);
        
        if ($folderId) {
            $currentFolder = DocumentFolder::where('user_id', $user->id)
                ->findOrFail($folderId);
            
            \Log::info('Current folder found', [
                'folder_id' => $currentFolder->id,
                'folder_name' => $currentFolder->name,
                'parent_id' => $currentFolder->parent_folder_id
            ]);
        }
        
        // Make sure we get all folders for the current level
        $folderQuery = DocumentFolder::where('user_id', $user->id);
        
        // If we're at the root level (no folder_id), only show root folders
        // Otherwise, show child folders of the current folder
        if ($folderId === null) {
            $folderQuery->whereNull('parent_folder_id');
        } else {
            $folderQuery->where('parent_folder_id', $folderId);
        }
        
        $folders = $folderQuery->orderBy('name')->get();
        
        \Log::info('Folders found', [
            'count' => $folders->count(),
            'folder_ids' => $folders->pluck('id')->toArray(),
            'folder_names' => $folders->pluck('name')->toArray(),
            'parent_ids' => $folders->pluck('parent_folder_id')->toArray()
        ]);
        
        // Get documents for the current folder
        $documentsQuery = Document::where('user_id', $user->id);
        
        if ($folderId === null) {
            // If at root level, only show documents without a folder
            $documentsQuery->whereNull('folder_id');
        } else {
            // Show documents for the current folder
            $documentsQuery->where('folder_id', $folderId);
        }
        
        $documents = $documentsQuery->orderBy('created_at', 'desc')->get();
        
        \Log::info('Documents found', [
            'count' => $documents->count(),
            'document_ids' => $documents->pluck('id')->toArray(),
            'document_names' => $documents->pluck('name')->toArray(),
            'folder_ids' => $documents->pluck('folder_id')->toArray(),
            'user_ids' => $documents->pluck('user_id')->toArray()
        ]);
        
        return view('layouts.client.documents.index', compact('folders', 'documents', 'currentFolder'));
    }

    /**
     * Upload a new document.
     */
    public function upload(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx,txt|max:10240',
            'folder_id' => 'required|exists:document_folders,id',
            'description' => 'nullable|string',
        ]);
        
        $user = Auth::user();
        $file = $request->file('file');
        
        // Check if the folder belongs to the user
        $folder = DocumentFolder::where('user_id', $user->id)
            ->findOrFail($request->folder_id);
        
        \Log::info('Uploading document to folder', [
            'folder_id' => $folder->id,
            'folder_name' => $folder->name,
            'user_id' => $user->id
        ]);
        
        // Store the file
        $path = $file->store('documents/' . $user->id, 'public');
        
        // Create document record
        $document = new Document([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'file_path' => $path,
            'file_type' => $file->getClientMimeType(),
            'file_size' => $file->getSize(),
            'folder_id' => $folder->id,
            'user_id' => $user->id,
            'uploaded_by' => $user->id,
        ]);
        
        $document->save();
        
        return redirect()->route('client.documents.index', ['folder_id' => $folder->id])
            ->with('success', 'Document uploaded successfully.');
    }

    /**
     * Create a new folder.
     */
    public function createFolder(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'parent_folder_id' => 'nullable|exists:document_folders,id',
        ]);
        
        $user = Auth::user();
        
        // Log folder creation details
        \Log::info('Creating folder', [
            'user_id' => $user->id,
            'name' => $validated['name'],
            'parent_folder_id' => $request->parent_folder_id
        ]);
        
        // Convert empty string to null for parent_folder_id
        $parentFolderId = !empty($request->parent_folder_id) ? $request->parent_folder_id : null;
        
        // Check if the parent folder belongs to the user
        if ($parentFolderId) {
            $parentFolder = DocumentFolder::where('user_id', $user->id)
                ->findOrFail($parentFolderId);
            
            \Log::info('Parent folder found', [
                'parent_id' => $parentFolder->id,
                'parent_name' => $parentFolder->name
            ]);
        }
        
        // Create folder
        $folder = new DocumentFolder([
            'name' => $validated['name'],
            'user_id' => $user->id,
            'parent_folder_id' => $parentFolderId,
        ]);
        
        $folder->save();
        
        \Log::info('Folder created', [
            'folder_id' => $folder->id,
            'folder_name' => $folder->name,
            'parent_id' => $folder->parent_folder_id,
            'redirecting_to' => $parentFolderId
        ]);
        
        // Redirect to parent folder or root if no parent
        return redirect()->route('client.documents.index', ['folder_id' => $parentFolderId])
            ->with('success', 'Folder created successfully.');
    }

    /**
     * Display the specified document.
     */
    public function show(Document $document)
    {
        // Check if the document belongs to the user
        $this->authorize('view', $document);
        
        // Redirect to preview instead of showing a dedicated page
        return redirect()->route('client.documents.preview', $document);
    }

    /**
     * Show the form for editing document details.
     */
    public function edit(Document $document)
    {
        // Check if the document belongs to the user
        $this->authorize('update', $document);
        
        $folders = DocumentFolder::where('user_id', Auth::id())
            ->orderBy('name')
            ->get();
            
        return view('layouts.client.documents.edit', compact('document', 'folders'));
    }

    /**
     * Update the specified document in storage.
     */
    public function update(Request $request, Document $document)
    {
        // Check if the document belongs to the user
        $this->authorize('update', $document);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'folder_id' => 'nullable|exists:document_folders,id',
            'description' => 'nullable|string',
        ]);
        
        // Check if the folder belongs to the user
        if ($request->folder_id) {
            $folder = DocumentFolder::where('user_id', Auth::id())
                ->findOrFail($request->folder_id);
        }
        
        $document->update($validated);
        
        return redirect()->route('client.documents.index', ['folder_id' => $document->folder_id])
            ->with('success', 'Document updated successfully.');
    }

    /**
     * Remove the specified document from storage.
     */
    public function destroy(Document $document)
    {
        // Check if the document belongs to the user
        $this->authorize('delete', $document);
        
        // Store folder ID before deletion for redirect
        $folderId = $document->folder_id;
        
        // Delete the file from storage
        Storage::disk('public')->delete($document->file_path);
        
        $document->delete();
        
        return redirect()->route('client.documents.index', ['folder_id' => $folderId])
            ->with('success', 'Document deleted successfully.');
    }
    
    /**
     * Download the specified document.
     */
    public function download(Document $document)
    {
        // Check if the document belongs to the user
        $this->authorize('view', $document);
        
        // Get file extension
        $extension = pathinfo($document->file_path, PATHINFO_EXTENSION);
        
        // Create a filename with the proper extension
        $filename = $document->name;
        
        // If the filename doesn't already have the extension, add it
        if (!str_ends_with(strtolower($filename), strtolower('.' . $extension))) {
            $filename .= '.' . $extension;
        }
        
        \Log::info('Downloading document', [
            'document_id' => $document->id,
            'original_name' => $document->name,
            'download_name' => $filename,
            'extension' => $extension,
            'path' => $document->file_path
        ]);
        
        // Download with the proper filename including extension
        return Storage::disk('public')->download($document->file_path, $filename);
    }
    
    /**
     * Preview the specified document.
     */
    public function preview(Document $document)
    {
        // Check if the document belongs to the user
        $this->authorize('view', $document);
        
        if ($document->isPdf()) {
            $url = Storage::disk('public')->url($document->file_path);
            
            return view('layouts.client.documents.preview_pdf', compact('document', 'url'));
        } elseif ($document->isImage()) {
            $url = Storage::disk('public')->url($document->file_path);
            
            return view('layouts.client.documents.preview_image', compact('document', 'url'));
        }
        
        // If not previewable, just download it
        return $this->download($document);
    }
    
    /**
     * Search for documents.
     */
    public function search(Request $request)
    {
        $query = $request->get('query');
        $user = Auth::user();
        
        $documents = Document::where('user_id', $user->id)
            ->where(function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('layouts.client.documents.search_results', compact('documents', 'query'));
    }

    /**
     * Delete a folder and its contents.
     */
    public function destroyFolder(DocumentFolder $folder)
    {
        // Check if the folder belongs to the user
        if ($folder->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Get parent folder ID for redirect
        $parentFolderId = $folder->parent_folder_id;
        
        // Delete all documents in the folder
        foreach ($folder->documents as $document) {
            Storage::disk('public')->delete($document->file_path);
            $document->delete();
        }
        
        // Recursively delete subfolders
        foreach ($folder->subfolders as $subfolder) {
            $this->destroyFolder($subfolder);
        }
        
        $folder->delete();
        
        return redirect()->route('client.documents.index', ['folder_id' => $parentFolderId])
            ->with('success', 'Folder and its contents deleted successfully.');
    }

    /**
     * Get document statistics and recent documents for dashboard display.
     */
    public function getDashboardDocuments()
    {
        $user = Auth::user();
        
        // Get recent documents
        $recentDocuments = Document::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function($document) {
                return [
                    'id' => $document->id,
                    'name' => $document->name,
                    'type' => $document->file_type,
                    'size' => $this->formatFileSize($document->file_size),
                    'date' => $document->created_at->format('M d'),
                    'folder' => $document->folder ? $document->folder->name : 'Root',
                    'status' => $document->document_status,
                    'url' => route('client.documents.preview', $document)
                ];
            });
        
        // Calculate folder counts
        $folderCounts = DocumentFolder::where('user_id', $user->id)
            ->count();
            
        // Calculate document counts
        $totalDocuments = Document::where('user_id', $user->id)->count();
        $recentUploads = Document::where('user_id', $user->id)
            ->whereDate('created_at', '>=', now()->subDays(7))
            ->count();
        
        return response()->json([
            'recent' => $recentDocuments,
            'stats' => [
                'totalDocuments' => $totalDocuments,
                'totalFolders' => $folderCounts,
                'recentUploads' => $recentUploads
            ]
        ]);
    }
    
    /**
     * Format file size for display.
     */
    private function formatFileSize($size)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $i = 0;
        while ($size >= 1024 && $i < count($units) - 1) {
            $size /= 1024;
            $i++;
        }
        return round($size, 2) . ' ' . $units[$i];
    }
}