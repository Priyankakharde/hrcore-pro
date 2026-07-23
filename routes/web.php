<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Employees
    Route::resource('employees', EmployeeController::class);

    // Tasks
    Route::resource('tasks', TaskController::class);

    Route::put('/tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete');
    Route::put('/tasks/{task}/reopen', [TaskController::class, 'reopen'])->name('tasks.reopen');

    // Events
    Route::resource('events', EventController::class);

    // Projects
    Route::resource('projects', ProjectController::class);

    Route::put('/projects/{project}/complete', [ProjectController::class, 'complete'])->name('projects.complete');
    Route::put('/projects/{project}/hold', [ProjectController::class, 'hold'])->name('projects.hold');
    Route::put('/projects/{project}/restart', [ProjectController::class, 'restart'])->name('projects.restart');

    // Leaves
    Route::resource('leaves', LeaveController::class);

    Route::put('/leaves/{leave}/approve', [LeaveController::class, 'approve'])->name('leaves.approve');
    Route::put('/leaves/{leave}/reject', [LeaveController::class, 'reject'])->name('leaves.reject');

    // Payments
    Route::resource('payments', SalaryController::class);

    // Performance
    Route::resource('performance', PerformanceController::class);

    // Invoice
    Route::resource('invoice', InvoiceController::class);

    // Notifications
    Route::resource('notifications', NotificationController::class);

    Route::patch('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::patch('/notifications/{notification}/unread', [NotificationController::class, 'markAsUnread'])->name('notifications.unread');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Chat
    Route::resource('chat', ChatController::class);

    Route::patch('/chat/{chat}/read', [ChatController::class, 'markAsRead'])->name('chat.read');
    Route::patch('/chat/{chat}/unread', [ChatController::class, 'markAsUnread'])->name('chat.unread');
    Route::patch('/chat/{chat}/pin', [ChatController::class, 'pin'])->name('chat.pin');
    Route::patch('/chat/{chat}/unpin', [ChatController::class, 'unpin'])->name('chat.unpin');
    Route::patch('/chat/{chat}/star', [ChatController::class, 'star'])->name('chat.star');
    Route::patch('/chat/{chat}/unstar', [ChatController::class, 'unstar'])->name('chat.unstar');

    // Attendance
    Route::resource('attendance', AttendanceController::class);

    // Reports
    Route::resource('reports', ReportController::class);

    Route::get('/reports/export', [ReportController::class, 'export'])
        ->name('reports.export');

    Route::get('/reports/{report}/download', [ReportController::class, 'download'])
        ->name('reports.download');

});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';