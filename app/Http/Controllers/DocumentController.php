<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Permit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    /**
     * Display a listing of documents for a permit.
     */
    public function index(Permit $permit)
    {
        $this->authorize('view', $permit);
        
        $documents = $permit->documents()->latest()->get();
        
        return view('documents.index', compact('permit', 'documents'));
    }

    /**
     * Show the form for uploading a new document.
     */
    public function create(Permit $permit)
    {
        $this->authorize('update', $permit);
        
        return view('documents.create', compact('permit'));
    }

    /**
     * Store a newly created document in storage.
     */
    public function store(Request $request, Permit $permit)
    {
        $this->authorize('update', $permit);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx,txt|max:10240',
        ]);
        
        $file = $request->file('file');
        $path = $file->store('permits/' . $permit->id, 'public');
        
        $document = $permit->documents()->create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'file_path' => $path,
            'file_type' => $file->getClientMimeType(),
            'file_size' => $file->getSize(),
        ]);
        
        return redirect()->route('permits.show', $permit)
            ->with('success', 'Document uploaded successfully.');
    }

    /**
     * Display the specified document.
     */
    public function show(Document $document)
    {
        $permit = $document->permit;
        $this->authorize('view', $permit);
        
        return view('documents.show', compact('document'));
    }

    /**
     * Show the form for editing document details.
     */
    public function edit(Document $document)
    {
        $permit = $document->permit;
        $this->authorize('update', $permit);
        
        return view('documents.edit', compact('document'));
    }

    /**
     * Update the specified document in storage.
     */
    public function update(Request $request, Document $document)
    {
        $permit = $document->permit;
        $this->authorize('update', $permit);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        
        $document->update($validated);
        
        return redirect()->route('permits.show', $permit)
            ->with('success', 'Document updated successfully.');
    }

    /**
     * Remove the specified document from storage.
     */
    public function destroy(Document $document)
    {
        $permit = $document->permit;
        $this->authorize('update', $permit);
        
        // Delete the file from storage
        Storage::disk('public')->delete($document->file_path);
        
        $document->delete();
        
        return redirect()->route('permits.show', $permit)
            ->with('success', 'Document deleted successfully.');
    }
    
    /**
     * Download the specified document.
     */
    public function download(Document $document)
    {
        $permit = $document->permit;
        $this->authorize('view', $permit);
        
        return Storage::disk('public')->download($document->file_path, $document->name);
    }
    
    /**
     * Preview the specified document.
     */
    public function preview(Document $document)
    {
        $permit = $document->permit;
        $this->authorize('view', $permit);
        
        if ($document->isPdf()) {
            $url = Storage::disk('public')->url($document->file_path);
            
            return view('documents.preview_pdf', compact('document', 'url'));
        } elseif ($document->isImage()) {
            $url = Storage::disk('public')->url($document->file_path);
            
            return view('documents.preview_image', compact('document', 'url'));
        }
        
        // If not previewable, just download it
        return $this->download($document);
    }
    
    /**
     * Replace the file for a document.
     */
    public function replace(Request $request, Document $document)
    {
        $permit = $document->permit;
        $this->authorize('update', $permit);
        
        $validated = $request->validate([
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx,txt|max:10240',
        ]);
        
        // Delete the old file
        Storage::disk('public')->delete($document->file_path);
        
        // Upload the new file
        $file = $request->file('file');
        $path = $file->store('permits/' . $permit->id, 'public');
        
        // Update the document
        $document->update([
            'file_path' => $path,
            'file_type' => $file->getClientMimeType(),
            'file_size' => $file->getSize(),
        ]);
        
        return redirect()->route('permits.show', $permit)
            ->with('success', 'Document file replaced successfully.');
    }
} 