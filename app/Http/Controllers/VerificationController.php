<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class VerificationController extends Controller
{
    /**
     * Show the verification page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        
        // Redirect all contractors to client dashboard, bypassing verification
        if ($user->isContractor()) {
            return redirect()->route('client.dashboard');
        }
        
        return view('layouts.client.verification.index', compact('user'));
    }

    /**
     * Submit verification documents.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submitDocuments(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'license_number' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'contractor_license' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'drivers_license' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'insurance_certificate' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);
        
        // Store files
        $contractorLicensePath = $request->file('contractor_license')->store('verification/' . $user->id, 'public');
        $driversLicensePath = $request->file('drivers_license')->store('verification/' . $user->id, 'public');
        $insuranceCertificatePath = $request->file('insurance_certificate')->store('verification/' . $user->id, 'public');
        
        // Update user
        $user->update([
            'license_number' => $request->license_number,
            'company_name' => $request->company_name,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'contractor_license_file' => $contractorLicensePath,
            'drivers_license_file' => $driversLicensePath,
            'insurance_certificate_file' => $insuranceCertificatePath,
            'verification_status' => 'under_review',
            'documents_submitted_at' => now(),
        ]);
        
        return redirect()->route('verification.index')
            ->with('success', 'Your documents have been submitted for verification. We will review them shortly.');
    }
    
    /**
     * Show admin verification dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminDashboard()
    {
        $pendingVerifications = User::where('role', 'contractor')
            ->whereIn('verification_status', ['under_review', 'pending'])
            ->latest('documents_submitted_at')
            ->get();
            
        $verifiedContractors = User::where('role', 'contractor')
            ->where('verification_status', 'approved')
            ->latest('verified_at')
            ->get();
            
        return view('admin.verification.dashboard', [
            'pendingVerifications' => $pendingVerifications,
            'verifiedContractors' => $verifiedContractors
        ]);
    }
    
    /**
     * Show admin verification details for a contractor.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function adminShow(User $user)
    {
        if ($user->role !== 'contractor') {
            return redirect()->route('admin.verification.dashboard')
                ->with('error', 'Only contractor accounts can be verified.');
        }
        
        return view('admin.verification.show', compact('user'));
    }
    
    /**
     * Update verification status by admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function adminUpdate(Request $request, User $user)
    {
        if ($user->role !== 'contractor') {
            return redirect()->route('admin.verification.dashboard')
                ->with('error', 'Only contractor accounts can be verified.');
        }
        
        $request->validate([
            'verification_status' => ['required', Rule::in(['approved', 'rejected', 'pending', 'under_review'])],
            'admin_feedback' => 'nullable|string',
        ]);
        
        $updateData = [
            'verification_status' => $request->verification_status,
            'admin_feedback' => $request->admin_feedback,
        ];
        
        if ($request->verification_status === 'approved') {
            $updateData['verified_at'] = now();
        }
        
        $user->update($updateData);
        
        return redirect()->route('admin.verification.dashboard')
            ->with('success', 'Contractor verification status updated successfully.');
    }
} 