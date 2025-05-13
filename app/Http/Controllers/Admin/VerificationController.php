<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\VerificationStatusUpdated;

/**
 * Handles verification requests and management on the admin side.
 * Allows admins to review, approve, or reject contractor verifications.
 */
class VerificationController extends AdminController
{
    /**
     * Display a listing of pending and verified contractors.
     */
    public function index()
    {
        $pendingVerifications = User::where('role', 'contractor')
            ->where('documents_submitted_at', '!=', null)
            ->where('verification_status', '!=', 'approved')
            ->orderBy('documents_submitted_at', 'asc')
            ->get();

        $verifiedContractors = User::where('role', 'contractor')
            ->where('verification_status', 'approved')
            ->orderBy('verified_at', 'desc')
            ->get();

        return view('layouts.admin.verifications.index', compact('pendingVerifications', 'verifiedContractors'));
    }

    /**
     * Display the verification details for a specific contractor.
     */
    public function show(User $contractor)
    {
        if ($contractor->role !== 'contractor') {
            return redirect()->route('admin.verifications.index')
                ->with('error', 'Only contractor accounts can be verified.');
        }

        return view('layouts.admin.verifications.show', compact('contractor'));
    }

    /**
     * Show the form for editing the contractor verification.
     */
    public function edit(User $contractor)
    {
        if ($contractor->role !== 'contractor') {
            return redirect()->route('admin.verifications.index')
                ->with('error', 'Only contractor accounts can be verified.');
        }

        return view('layouts.admin.verifications.edit', compact('contractor'));
    }

    /**
     * Update the verification status of a contractor.
     */
    public function update(Request $request, User $contractor)
    {
        if ($contractor->role !== 'contractor') {
            return redirect()->route('admin.verifications.index')
                ->with('error', 'Only contractor accounts can be verified.');
        }

        $validated = $request->validate([
            'verification_status' => 'required|in:verified,rejected,pending',
            'feedback' => 'nullable|string|max:500',
            'notify_contractor' => 'nullable|boolean',
        ]);

        $wasVerified = $contractor->verification_status === 'approved';
        $wasRejected = $contractor->verification_status === 'rejected';

        // Update based on the status
        switch ($validated['verification_status']) {
            case 'verified':
                $contractor->verification_status = 'approved';
                $contractor->verified_at = Carbon::now();
                break;
            case 'rejected':
                if (empty($validated['feedback'])) {
                    return redirect()->back()
                        ->withInput()
                        ->withErrors(['feedback' => 'Feedback is required when rejecting verification.']);
                }
                $contractor->verification_status = 'rejected';
                $contractor->verified_at = null;
                break;
            case 'pending':
                $contractor->verification_status = 'pending';
                $contractor->verified_at = null;
                break;
        }

        // Save feedback if provided
        if (isset($validated['feedback'])) {
            $contractor->admin_feedback = $validated['feedback'];
        }

        $contractor->save();

        // Send notification email if required
        if (!empty($request->notify_contractor)) {
            Mail::to($contractor->email)->send(new VerificationStatusUpdated($contractor));
        }

        // Determine appropriate message
        if ($validated['verification_status'] === 'verified') {
            $statusMessage = 'Contractor has been verified successfully.';
        } elseif ($validated['verification_status'] === 'rejected') {
            $statusMessage = 'Contractor verification has been rejected.';
        } else {
            $statusMessage = 'Contractor verification has been reset to pending.';
        }

        return redirect()->route('admin.verifications.show', $contractor)
            ->with('success', $statusMessage);
    }
    
    /**
     * Download a contractor verification document.
     *
     * @param User $contractor
     * @param string $documentType
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadDocument(User $contractor, $documentType)
    {
        // Check if user is a contractor
        if ($contractor->role !== 'contractor') {
            abort(404);
        }
        
        $filePath = null;
        $fileName = null;
        
        // Get the appropriate file path based on document type
        switch ($documentType) {
            case 'license':
                $filePath = $contractor->contractor_license_file;
                $fileName = 'contractor_license.' . pathinfo($filePath, PATHINFO_EXTENSION);
                break;
            case 'drivers':
                $filePath = $contractor->drivers_license_file;
                $fileName = 'drivers_license.' . pathinfo($filePath, PATHINFO_EXTENSION);
                break;
            case 'insurance':
                $filePath = $contractor->insurance_certificate_file;
                $fileName = 'insurance_certificate.' . pathinfo($filePath, PATHINFO_EXTENSION);
                break;
            default:
                abort(404);
        }
        
        // Check if file exists
        if (!$filePath || !Storage::disk('public')->exists($filePath)) {
            abort(404);
        }
        
        // Return file for download
        return response()->download(storage_path('app/public/' . $filePath), $fileName);
    }
    
    /**
     * Preview a contractor verification document.
     *
     * @param User $contractor
     * @param string $documentType
     * @return \Illuminate\Http\Response
     */
    public function previewDocument(User $contractor, $documentType)
    {
        // Check if user is a contractor
        if ($contractor->role !== 'contractor') {
            abort(404);
        }
        
        $filePath = null;
        
        // Get the appropriate file path based on document type
        switch ($documentType) {
            case 'license':
                $filePath = $contractor->contractor_license_file;
                break;
            case 'drivers':
                $filePath = $contractor->drivers_license_file;
                break;
            case 'insurance':
                $filePath = $contractor->insurance_certificate_file;
                break;
            default:
                abort(404);
        }
        
        // Check if file exists
        if (!$filePath || !Storage::disk('public')->exists($filePath)) {
            abort(404);
        }
        
        // Return file for preview
        return response()->file(storage_path('app/public/' . $filePath));
    }
} 