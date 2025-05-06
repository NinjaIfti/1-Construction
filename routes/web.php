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
use App\Http\Controllers\ClientMessageController;
use App\Http\Controllers\Admin\VerificationController as AdminVerificationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ContractorController as AdminContractorController;
use App\Http\Controllers\Admin\DocumentController as AdminDocumentController;
use App\Http\Controllers\Admin\AdminMessageController;
use App\Http\Controllers\ClientDocumentController;
use App\Http\Controllers\ClientPermitController;
use App\Http\Controllers\Admin\InvoiceController as AdminInvoiceController;
use App\Http\Controllers\ContractorInvoiceController;
Route::view('/', 'welcome');

// Product page route
Route::view('/product', 'layouts.pages.product')->name('product');

// Solutions route
Route::view('/solutions', 'layouts.pages.solutions')->name('solutions');

// Resources route
Route::view('/resourcess', 'layouts.pages.resourcess')->name('resourcess');

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
    
    // API routes for messages
    Route::get('api/messages/unread', [ClientMessageController::class, 'unreadCount'])->name('api.messages.unread');
    
    // Contractor Verification Routes
    Route::get('/verification', [VerificationController::class, 'index'])->name('verification.index');
    Route::post('/verification/submit', [VerificationController::class, 'submitDocuments'])->name('verification.submit');

    // Client Document Management
    Route::prefix('client/documents')->name('client.documents.')->group(function () {
        Route::get('/', [ClientDocumentController::class, 'index'])->name('index');
        Route::post('/upload', [ClientDocumentController::class, 'upload'])->name('upload');
        Route::post('/create-folder', [ClientDocumentController::class, 'createFolder'])->name('create-folder');
        Route::get('/search', [ClientDocumentController::class, 'search'])->name('search');
        Route::get('/{document}', [ClientDocumentController::class, 'show'])->name('show');
        Route::get('/{document}/edit', [ClientDocumentController::class, 'edit'])->name('edit');
        Route::put('/{document}', [ClientDocumentController::class, 'update'])->name('update');
        Route::delete('/{document}', [ClientDocumentController::class, 'destroy'])->name('destroy');
        Route::get('/{document}/download', [ClientDocumentController::class, 'download'])->name('download');
        Route::get('/{document}/preview', [ClientDocumentController::class, 'preview'])->name('preview');
        Route::delete('/folders/{folder}', [ClientDocumentController::class, 'destroyFolder'])->name('destroy-folder');
    });

    // Client Message Management
    Route::prefix('client/messages')->name('client.messages.')->group(function () {
        Route::get('/', [ClientMessageController::class, 'index'])->name('index');
        Route::get('/create', [ClientMessageController::class, 'create'])->name('create');
        Route::post('/', [ClientMessageController::class, 'store'])->name('store');
        Route::get('/{message}', [ClientMessageController::class, 'show'])->name('show');
        Route::get('/{message}/reply', [ClientMessageController::class, 'reply'])->name('reply');
        Route::post('/{message}/reply', [ClientMessageController::class, 'storeReply'])->name('store-reply');
    });

    // Client permit routes
    Route::prefix('client/permits')->name('client.permits.')->group(function () {
        Route::get('/', [ClientPermitController::class, 'index'])->name('index');
        Route::get('/create', [ClientPermitController::class, 'create'])->name('create');
        Route::post('/', [ClientPermitController::class, 'store'])->name('store');
        Route::get('/{permit}', [ClientPermitController::class, 'show'])->name('show');
        Route::post('/{permit}/comments', [ClientPermitController::class, 'addComment'])->name('comments.store');
    });

    // Client Invoice Management
    Route::prefix('client/invoices')->name('client.invoices.')->group(function () {
        Route::get('/', [ContractorInvoiceController::class, 'index'])->name('index');
        Route::get('/{invoice}', [ContractorInvoiceController::class, 'show'])->name('show');
        Route::get('/{invoice}/payment', [ContractorInvoiceController::class, 'paymentForm'])->name('payment');
        Route::post('/{invoice}/payment', [ContractorInvoiceController::class, 'processPayment'])->name('process-payment');
    });
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
    Route::delete('/contractors/{contractor}', [AdminContractorController::class, 'destroy'])->name('contractors.destroy');
    Route::get('/api/dashboard/contractors', [AdminContractorController::class, 'getDashboardContractors'])->name('api.dashboard.contractors');
    
    // Invoice Management
    Route::get('/invoices', [AdminInvoiceController::class, 'index'])->name('invoices.index');
    Route::get('/invoices/create', [AdminInvoiceController::class, 'create'])->name('invoices.create');
    Route::post('/invoices', [AdminInvoiceController::class, 'store'])->name('invoices.store');
    Route::get('/invoices/{invoice}', [AdminInvoiceController::class, 'show'])->name('invoices.show');
    Route::get('/invoices/{invoice}/edit', [AdminInvoiceController::class, 'edit'])->name('invoices.edit');
    Route::put('/invoices/{invoice}', [AdminInvoiceController::class, 'update'])->name('invoices.update');
    Route::delete('/invoices/{invoice}', [AdminInvoiceController::class, 'destroy'])->name('invoices.destroy');
    Route::patch('/invoices/{invoice}/mark-paid', [AdminInvoiceController::class, 'markAsPaid'])->name('invoices.mark-paid');
    Route::get('/invoices/contractor/{contractor}', [AdminInvoiceController::class, 'contractorInvoices'])->name('invoices.contractor');
    
    // Verification Management
    Route::get('/verifications', [AdminVerificationController::class, 'index'])->name('verifications.index');
    Route::get('/verifications/{contractor}', [AdminVerificationController::class, 'show'])->name('verifications.show');
    Route::get('/verifications/{contractor}/edit', [AdminVerificationController::class, 'edit'])->name('verifications.edit');
    Route::put('/verifications/{contractor}', [AdminVerificationController::class, 'update'])->name('verifications.update');
    
    // Permit Management
    Route::get('/permits', [App\Http\Controllers\Admin\AdminPermitController::class, 'index'])->name('permits.index');
    Route::get('/permits/contractor/{contractor}', [App\Http\Controllers\Admin\AdminPermitController::class, 'contractorPermits'])->name('permits.contractor');
    Route::get('/permits/{permit}', [App\Http\Controllers\Admin\AdminPermitController::class, 'show'])->name('permits.show');
    Route::patch('/permits/{permit}/status', [App\Http\Controllers\Admin\AdminPermitController::class, 'updateStatus'])->name('permits.update-status');
    Route::post('/permits/{permit}/comments', [App\Http\Controllers\Admin\AdminPermitController::class, 'addComment'])->name('permits.comments.store');
    Route::get('/api/dashboard/permits', [App\Http\Controllers\Admin\AdminPermitController::class, 'getDashboardPermits'])->name('api.dashboard.permits');
    
    // Document Management
    Route::get('/documents', [AdminDocumentController::class, 'index'])->name('documents.index');
    Route::get('/documents/upload', [AdminDocumentController::class, 'upload'])->name('documents.upload');
    Route::post('/documents/store', [AdminDocumentController::class, 'storeDocument'])->name('documents.store');
    Route::post('/documents/create-folder', [AdminDocumentController::class, 'createFolder'])->name('documents.create-folder');
    Route::get('/documents/folders', [AdminDocumentController::class, 'folders'])->name('documents.folders');
    Route::get('/documents/folder/{folder}', [AdminDocumentController::class, 'folderDocuments'])->name('documents.folder');
    Route::get('/documents/list-folders', [AdminDocumentController::class, 'listFolders'])->name('documents.list-folders');
    Route::get('/documents/{document}', [AdminDocumentController::class, 'show'])->name('documents.show');
    Route::get('/documents/{document}/download', [AdminDocumentController::class, 'download'])->name('documents.download');
    Route::get('/documents/{document}/preview', [AdminDocumentController::class, 'preview'])->name('documents.preview');
    Route::post('/documents/{document}/approve', [AdminDocumentController::class, 'approve'])->name('documents.approve');
    Route::post('/documents/{document}/reject', [AdminDocumentController::class, 'reject'])->name('documents.reject');
    Route::get('/api/dashboard/documents', [AdminDocumentController::class, 'getDashboardDocuments'])->name('api.dashboard.documents');

    // Admin Message Management
    Route::get('/messages', [AdminMessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/create', [AdminMessageController::class, 'create'])->name('messages.create');
    Route::post('/messages', [AdminMessageController::class, 'store'])->name('messages.store');
    Route::get('/messages/{message}', [AdminMessageController::class, 'show'])->name('messages.show');
    Route::get('/messages/{message}/reply', [AdminMessageController::class, 'reply'])->name('messages.reply');
    Route::post('/messages/{message}/reply', [AdminMessageController::class, 'storeReply'])->name('messages.store-reply');
    Route::get('/messages/contractor/{contractor}', [AdminMessageController::class, 'contractorMessages'])->name('messages.contractor');
    Route::get('/api/messages/unread', [AdminMessageController::class, 'unreadCount'])->name('api.messages.unread');

    // Admin Project Routes
    Route::get('/projects', [App\Http\Controllers\Admin\ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [App\Http\Controllers\Admin\ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [App\Http\Controllers\Admin\ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project}', [App\Http\Controllers\Admin\ProjectController::class, 'show'])->name('projects.show');
    Route::get('/projects/{project}/edit', [App\Http\Controllers\Admin\ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{project}', [App\Http\Controllers\Admin\ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project}', [App\Http\Controllers\Admin\ProjectController::class, 'destroy'])->name('projects.destroy');
    Route::patch('/projects/{project}/approve', [App\Http\Controllers\Admin\ProjectController::class, 'approve'])->name('projects.approve');
    Route::patch('/projects/{project}/complete', [App\Http\Controllers\Admin\ProjectController::class, 'complete'])->name('projects.complete');
});
// Client documents dashboard route
Route::get('/client/documents-dashboard', [ContractorController::class, 'documents'])->middleware(['auth'])->name('client.documents-dashboard');

// Notification APIs
Route::middleware(['auth'])->prefix('api')->name('api.')->group(function () {
    Route::get('/notifications/unread', [NotificationController::class, 'getUnreadNotifications'])->name('notifications.unread');
    Route::get('/notifications/recent', [NotificationController::class, 'getRecentNotifications'])->name('notifications.recent');
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
});

// Client Dashboard APIs
Route::middleware(['auth'])->prefix('client/api')->name('client.api.')->group(function () {
    Route::get('/dashboard/stats', [ContractorController::class, 'getDashboardStats'])->name('dashboard.stats');
    Route::get('/dashboard/activities', [ContractorController::class, 'getDashboardActivities'])->name('dashboard.activities');
    Route::get('/dashboard/documents', [ClientDocumentController::class, 'getDashboardDocuments'])->name('dashboard.documents');
});

require __DIR__.'/auth.php';
