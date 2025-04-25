<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PermitController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\NotificationController;

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

// Custom login route - override default auth route
Route::view('/login', 'layouts.pages.login')->name('login.custom')->middleware('guest');

// Who We Serve routes
Route::view('/who-we-serve', 'layouts.pages.who-we-serve')->name('who-we-serve');
Route::view('/who-we-serve/home-builder', 'layouts.pages.HomeBuilder')->name('who-we-serve.home-builder');
Route::view('/who-we-serve/developers', 'layouts.pages.developers')->name('who-we-serve.developers');
Route::view('/who-we-serve/GeneralContractor', 'layouts.pages.GeneralContractor')->name('who-we-serve.GeneralContractor');
Route::view('/who-we-serve/sub-contractor', 'layouts.pages.subcontractor')->name('who-we-serve.sub-contractor');
Route::view('/who-we-serve/solar-ev', 'layouts.pages.solar-ev')->name('who-we-serve.solar-ev');
Route::view('/who-we-serve/architect', 'layouts.pages.architect')->name('who-we-serve.architect');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Authenticated routes
Route::middleware(['auth'])->group(function () {
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
});

// temporary admin routes
Route::view('/admin.dashboard', 'layouts.admin.dashboard')->name('admin.dashboard');
Route::view('/client.dashboard', 'layouts.client.dashboard')->name('client.dashboard');
require __DIR__.'/auth.php';
