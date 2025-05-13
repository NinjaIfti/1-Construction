<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

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
     * Show the form for creating a new contractor.
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('layouts.admin.contractors.create');
    }
    
    /**
     * Store a newly created contractor in the database.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'company_name' => ['nullable', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'zip' => ['nullable', 'string', 'max:20'],
            'company_type' => ['nullable', 'string', 'max:100'],
            'company_size' => ['nullable', 'string', 'max:100'],
            'license_number' => ['nullable', 'string', 'max:100'],
            'project_types' => ['nullable', 'array'],
            'services' => ['nullable', 'array'],
            'project_volume' => ['nullable', 'string', 'max:100'],
            'verification_status' => ['nullable', 'string', 'in:pending,under_review,approved,rejected'],
        ]);

        try {
            DB::beginTransaction();
            
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = 'contractor';
            $user->company_name = $request->company_name;
            $user->phone_number = $request->phone_number;
            $user->address = $request->address;
            $user->city = $request->city;
            $user->state = $request->state;
            $user->zip = $request->zip;
            $user->company_type = $request->company_type;
            $user->company_size = $request->company_size;
            $user->license_number = $request->license_number;
            $user->project_types = $request->project_types;
            $user->services = $request->services;
            $user->project_volume = $request->project_volume;
            
            // Set verification status if provided
            if ($request->verification_status) {
                $user->verification_status = $request->verification_status;
                
                // If approved, set verified_at timestamp
                if ($request->verification_status === 'approved') {
                    $user->verified_at = now();
                }
            } else {
                // Default to pending
                $user->verification_status = 'pending';
            }
            
            $user->save();
            
            DB::commit();
            
            return redirect()->route('admin.contractors.index')
                ->with('success', 'Contractor created successfully.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create contractor: ' . $e->getMessage());
        }
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
     * Show the form for editing the contractor.
     * 
     * @param  \App\Models\User  $contractor
     * @return \Illuminate\View\View
     */
    public function edit(User $contractor)
    {
        if ($contractor->role !== 'contractor') {
            return redirect()->route('admin.contractors.index')
                ->with('error', 'Selected user is not a contractor.');
        }
        
        return view('layouts.admin.contractors.edit', compact('contractor'));
    }
    
    /**
     * Update the specified contractor in the database.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $contractor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $contractor)
    {
        if ($contractor->role !== 'contractor') {
            return redirect()->route('admin.contractors.index')
                ->with('error', 'Selected user is not a contractor.');
        }
        
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $contractor->id],
            'company_name' => ['nullable', 'string', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'zip' => ['nullable', 'string', 'max:20'],
            'company_type' => ['nullable', 'string', 'max:100'],
            'company_size' => ['nullable', 'string', 'max:100'],
            'license_number' => ['nullable', 'string', 'max:100'],
            'project_types' => ['nullable', 'array'],
            'services' => ['nullable', 'array'],
            'project_volume' => ['nullable', 'string', 'max:100'],
            'verification_status' => ['nullable', 'string', 'in:pending,under_review,approved,rejected'],
        ];
        
        // Only validate password if it's provided
        if ($request->filled('password')) {
            $rules['password'] = ['required', 'confirmed', Rules\Password::defaults()];
        }
        
        $request->validate($rules);

        try {
            DB::beginTransaction();
            
            $contractor->name = $request->name;
            $contractor->email = $request->email;
            
            // Only update password if provided
            if ($request->filled('password')) {
                $contractor->password = Hash::make($request->password);
            }
            
            $contractor->company_name = $request->company_name;
            $contractor->phone_number = $request->phone_number;
            $contractor->address = $request->address;
            $contractor->city = $request->city;
            $contractor->state = $request->state;
            $contractor->zip = $request->zip;
            $contractor->company_type = $request->company_type;
            $contractor->company_size = $request->company_size;
            $contractor->license_number = $request->license_number;
            $contractor->project_types = $request->project_types;
            $contractor->services = $request->services;
            $contractor->project_volume = $request->project_volume;
            
            // Update verification status if provided
            if ($request->verification_status) {
                $previousStatus = $contractor->verification_status;
                $contractor->verification_status = $request->verification_status;
                
                // If changing to approved and wasn't previously approved, set verified_at timestamp
                if ($request->verification_status === 'approved' && $previousStatus !== 'approved') {
                    $contractor->verified_at = now();
                }
                
                // If changing from approved to something else, nullify the verified_at timestamp
                if ($previousStatus === 'approved' && $request->verification_status !== 'approved') {
                    $contractor->verified_at = null;
                }
            }
            
            $contractor->save();
            
            DB::commit();
            
            return redirect()->route('admin.contractors.show', $contractor)
                ->with('success', 'Contractor updated successfully.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update contractor: ' . $e->getMessage());
        }
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

    /**
     * Delete a contractor and all their related data.
     * 
     * @param  \App\Models\User  $contractor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $contractor)
    {
        \Log::info('Contractor deletion started', ['contractor_id' => $contractor->id, 'name' => $contractor->name]);
        
        if ($contractor->role !== 'contractor') {
            \Log::warning('Deletion rejected - not a contractor', ['contractor_id' => $contractor->id, 'role' => $contractor->role]);
            return redirect()->route('admin.contractors.index')
                ->with('error', 'Selected user is not a contractor.');
        }

        try {
            DB::beginTransaction();

            // Store the contractor's ID for further cleanup
            $contractorId = $contractor->id;
            $contractorContractorId = $contractor->contractor_id;
            
            // 1. Clear messages references
            // Use updateExistingPivot for many-to-many relationships
            DB::table('messages')->where('contractor_id', $contractorId)->update(['contractor_id' => null]);
            DB::table('messages')->where('sender_id', $contractorId)->update(['sender_id' => null]);
            DB::table('messages')->where('recipient_id', $contractorId)->update(['recipient_id' => null]);
            
            // 2. Clean up related data with force delete when available
            // Delete all comments associated with this contractor's permits
            $permitIds = DB::table('permits')
                ->join('projects', 'permits.project_id', '=', 'projects.id')
                ->where('projects.contractor_id', $contractorId)
                ->pluck('permits.id');
                
            if (!empty($permitIds)) {
                // Delete comments related to permits
                DB::table('comments')->whereIn('permit_id', $permitIds)->delete();
                
                // Delete notifications related to permits
                DB::table('notifications')->whereIn('permit_id', $permitIds)->delete();
                
                // Delete documents related to permits
                $documentIds = DB::table('documents')->whereIn('permit_id', $permitIds)->pluck('id');
                $permitDocuments = \App\Models\Document::whereIn('id', $documentIds)->get();
                foreach ($permitDocuments as $document) {
                    // Delete the physical file from storage
                    if ($document->file_path) {
                        if (Storage::disk('public')->exists($document->file_path)) {
                            Storage::disk('public')->delete($document->file_path);
                        } elseif (Storage::exists($document->file_path)) {
                            Storage::delete($document->file_path);
                        }
                    }
                }
                DB::table('documents')->whereIn('id', $documentIds)->delete();
                
                // Now delete the permits
                DB::table('permits')->whereIn('id', $permitIds)->delete();
            }
            
            // 3. Delete contractor documents directly linked to contractor (not through permits)
            $contractorDocuments = $contractor->documents()->get();
            foreach ($contractorDocuments as $document) {
                // Delete the physical file from storage
                if ($document->file_path) {
                    if (Storage::disk('public')->exists($document->file_path)) {
                        Storage::disk('public')->delete($document->file_path);
                    } elseif (Storage::exists($document->file_path)) {
                        Storage::delete($document->file_path);
                    }
                }
            }
            $contractor->documents()->delete();
            
            // 4. Delete contractor's projects
            $contractor->projects()->delete();
            
            // 5. Delete invoices
            $contractor->invoices()->delete();
            
            // 6. Delete messages
            $contractor->sentMessages()->delete();
            $contractor->receivedMessages()->delete();
            $contractor->contractorMessages()->delete();
            
            // 7. Delete notifications
            $contractor->notifications()->delete();
            
            // 8. Delete comments created by the contractor
            $contractor->comments()->delete();
            
            // 9. Delete verification document files from storage
            $verificationFiles = [
                $contractor->contractor_license_file,
                $contractor->drivers_license_file,
                $contractor->insurance_certificate_file
            ];
            
            foreach ($verificationFiles as $filePath) {
                if (!empty($filePath)) {
                    if (Storage::disk('public')->exists($filePath)) {
                        Storage::disk('public')->delete($filePath);
                    } elseif (Storage::exists($filePath)) {
                        Storage::delete($filePath);
                    }
                }
            }
            
            // 10. Check and delete the associated Contractor model record if it exists
            if ($contractorContractorId) {
                \App\Models\Contractor::where('id', $contractorContractorId)->delete();
            }
            
            // 11. Delete the contractor user
            $contractor->delete();

            \Log::info('Contractor deletion completed successfully', ['contractor_id' => $contractor->id]);
            
            DB::commit();

            return redirect()->route('admin.contractors.index')
                ->with('success', 'Contractor and all related data have been completely deleted.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Contractor deletion failed', ['contractor_id' => $contractor->id, 'error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            
            return redirect()->route('admin.contractors.index')
                ->with('error', 'Failed to delete contractor: ' . $e->getMessage());
        }
    }
} 