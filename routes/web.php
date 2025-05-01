<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PermitController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ContractorController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\VerificationController as AdminVerificationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ContractorController as AdminContractorController;
use App\Http\Controllers\Admin\DocumentController as AdminDocumentController;

Route::view('/', 'welcome');

// Product page route
Route::view('/product', 'layouts.pages.product')->name('product');

// Solutions route
Route::view('/solutions', 'layouts.pages.solutions')->name('solutions');

// Resources route
Route::view('/resources', 'layouts.pages.resources')->name('resources');

// Contact route
Route::view('/contact', 'layouts.pages.contact')->name('contact');

// Get Started route
Route::view('/get-started', 'layouts.pages.getStarted')->name('get-started');
Route::post('/register-contractor', [RegisterController::class, 'register'])->name('register.contractor');

// Client dashboard route
Route::get('/client/dashboard', [ContractorController::class, 'dashboard'])->middleware(['auth'])->name('client.dashboard');

// Contractor Verified Routes
Route::middleware(['auth', 'verified.contractor'])->group(function () {
    // Projects
    Route::resource('projects', ProjectController::class);
    Route::get('projects/{project}/dashboard', [ProjectController::class, 'dashboard'])->name('projects.dashboard');
    
    // Permits
    Route::resource('permits', PermitController::class);
    Route::post('permits/{permit}/comments', [PermitController::class, 'addComment'])->name('permits.comments.store');
    Route::patch('permits/{permit}/status', [PermitController::class, 'updateStatus'])->name('permits.update-status');
    
    // Tasks
    Route::resource('tasks', TaskController::class);
    Route::patch('tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.update-status');
    Route::get('projects/{project}/tasks', [TaskController::class, 'projectTasks'])->name('projects.tasks');
    Route::get('my-tasks', [TaskController::class, 'myTasks'])->name('tasks.my-tasks');
    
    // Documents
    Route::get('permits/{permit}/documents', [DocumentController::class, 'index'])->name('permits.documents.index');
    Route::get('permits/{permit}/documents/create', [DocumentController::class, 'create'])->name('permits.documents.create');
    Route::post('permits/{permit}/documents', [DocumentController::class, 'store'])->name('permits.documents.store');
    Route::get('documents/{document}', [DocumentController::class, 'show'])->name('documents.show');
    Route::get('documents/{document}/edit', [DocumentController::class, 'edit'])->name('documents.edit');
    Route::patch('documents/{document}', [DocumentController::class, 'update'])->name('documents.update');
    Route::delete('documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy');
    Route::get('documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');
    Route::get('documents/{document}/preview', [DocumentController::class, 'preview'])->name('documents.preview');
    Route::post('documents/{document}/replace', [DocumentController::class, 'replace'])->name('documents.replace');
});

// All authenticated routes (both verified and unverified)
Route::middleware(['auth'])->group(function () {
    // Profile Management
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
    
    // Notifications
    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('notifications/unread', [NotificationController::class, 'unread'])->name('notifications.unread');
    Route::get('notifications/{notification}', [NotificationController::class, 'show'])->name('notifications.show');
    Route::patch('notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::post('notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    Route::delete('notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    
    // API routes for notifications
    Route::get('api/notifications/count', [NotificationController::class, 'getUnreadCount'])->name('api.notifications.count');
    Route::get('api/notifications/recent', [NotificationController::class, 'getRecentNotifications'])->name('api.notifications.recent');
    
    // Contractor Verification Routes
    Route::get('/verification', [VerificationController::class, 'index'])->name('verification.index');
    Route::post('/verification/submit', [VerificationController::class, 'submitDocuments'])->name('verification.submit');
});

// Who We Serve routes
Route::view('/who-we-serve', 'layouts.pages.who-we-serve')->name('who-we-serve');
Route::view('/who-we-serve/home-builder', 'layouts.pages.HomeBuilder')->name('who-we-serve.home-builder');
Route::view('/who-we-serve/developers', 'layouts.pages.developers')->name('who-we-serve.developers');
Route::view('/who-we-serve/GeneralContractor', 'layouts.pages.GeneralContractor')->name('who-we-serve.GeneralContractor');
Route::view('/who-we-serve/sub-contractor', 'layouts.pages.subcontractor')->name('who-we-serve.sub-contractor');
Route::view('/who-we-serve/solar-ev', 'layouts.pages.solar-ev')->name('who-we-serve.solar-ev');
Route::view('/who-we-serve/architect', 'layouts.pages.architect')->name('who-we-serve.architect');

// Default dashboard - redirects based on user role
Route::get('dashboard', function() {
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('client.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Contractor Management
    Route::get('/contractors', [AdminContractorController::class, 'index'])->name('contractors.index');
    Route::get('/contractors/{contractor}', [AdminContractorController::class, 'show'])->name('contractors.show');
    Route::get('/api/dashboard/contractors', [AdminContractorController::class, 'getDashboardContractors'])->name('api.dashboard.contractors');
    
    // Verification Management
    Route::get('/verifications', [AdminVerificationController::class, 'index'])->name('verifications.index');
    Route::get('/verifications/{contractor}', [AdminVerificationController::class, 'show'])->name('verifications.show');
    Route::get('/verifications/{contractor}/edit', [AdminVerificationController::class, 'edit'])->name('verifications.edit');
    Route::put('/verifications/{contractor}', [AdminVerificationController::class, 'update'])->name('verifications.update');
    
    // Document Management
    Route::get('/documents', [AdminDocumentController::class, 'index'])->name('documents.index');
    Route::get('/documents/upload', [AdminDocumentController::class, 'upload'])->name('documents.upload');
    Route::post('/documents/store', [AdminDocumentController::class, 'storeDocument'])->name('documents.store');
    Route::post('/documents/create-folder', [AdminDocumentController::class, 'createFolder'])->name('documents.create-folder');
    Route::get('/documents/folders', [AdminDocumentController::class, 'listFolders'])->name('documents.list-folders');
    Route::get('/documents/{document}', [AdminDocumentController::class, 'show'])->name('documents.show');
    Route::get('/documents/{document}/download', [AdminDocumentController::class, 'download'])->name('documents.download');
    Route::get('/documents/{document}/preview', [AdminDocumentController::class, 'preview'])->name('documents.preview');
    Route::post('/documents/{document}/approve', [AdminDocumentController::class, 'approve'])->name('documents.approve');
    Route::post('/documents/{document}/reject', [AdminDocumentController::class, 'reject'])->name('documents.reject');
    Route::get('/api/dashboard/documents', [AdminDocumentController::class, 'getDashboardDocuments'])->name('api.dashboard.documents');
});

require __DIR__.'/auth.php';
