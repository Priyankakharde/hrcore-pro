<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class NotificationController extends Controller
{
    /**
     * Display Notifications
     */
    public function index(Request $request)
    {
        $query = Notification::with('user');

        // Search
        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('message', 'like', '%' . $request->search . '%');

            });

        }

        // Filter Type
        if ($request->filled('type')) {

            $query->where('type', $request->type);

        }

        // Filter Status
        if ($request->filled('status')) {

            $query->where('status', $request->status);

        }

        // Filter Priority
        if ($request->filled('priority')) {

            $query->where('priority', $request->priority);

        }

        $notifications = $query
            ->latest()
            ->paginate(10);

        return view('notifications.index', [

            'notifications' => $notifications,

            'totalNotifications' => Notification::count(),

            'unreadNotifications' => Notification::where('status', 'Unread')->count(),

            'readNotifications' => Notification::where('status', 'Read')->count(),

            'highPriority' => Notification::where('priority', 'High')->count(),

            'todayNotifications' => Notification::whereDate('created_at', today())->count(),

        ]);
    }

    /**
     * Show Create Form
     */
    public function create()
    {
        $users = User::orderBy('name')->get();

        return view('notifications.create', compact('users'));
    }
        /**
     * Store Notification
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'user_id' => 'required|exists:users,id',

            'title' => 'required|string|max:255',

            'message' => 'required|string',

            'type' => 'required|string',

            'priority' => 'required|string',

            'action_url' => 'nullable|string|max:255',

        ]);

        $validated['status'] = 'Unread';

        Notification::create($validated);

        return redirect()
            ->route('notifications.index')
            ->with('success', 'Notification created successfully.');
    }

    /**
     * Display Notification
     */
    public function show(Notification $notification)
    {
        return view('notifications.show', compact('notification'));
    }

    /**
     * Show Edit Form
     */
    public function edit(Notification $notification)
    {
        $users = User::orderBy('name')->get();

        return view(
            'notifications.edit',
            compact('notification', 'users')
        );
    }

    /**
     * Update Notification
     */
    public function update(Request $request, Notification $notification)
    {
        $validated = $request->validate([

            'user_id' => 'required|exists:users,id',

            'title' => 'required|string|max:255',

            'message' => 'required|string',

            'type' => 'required|string',

            'priority' => 'required|string',

            'status' => 'required|string',

            'action_url' => 'nullable|string|max:255',

        ]);

        $notification->update($validated);

        return redirect()
            ->route('notifications.index')
            ->with('success', 'Notification updated successfully.');
    }
        /**
     * Delete Notification
     */
    public function destroy(Notification $notification)
    {
        $notification->delete();

        return redirect()
            ->route('notifications.index')
            ->with('success', 'Notification deleted successfully.');
    }

    /**
     * Mark Notification as Read
     */
    public function markAsRead(Notification $notification)
    {
        $notification->update([
            'status' => 'Read',
            'read_at' => now(),
        ]);

        return redirect()
            ->route('notifications.index')
            ->with('success', 'Notification marked as read.');
    }

    /**
     * Mark Notification as Unread
     */
    public function markAsUnread(Notification $notification)
    {
        $notification->update([
            'status' => 'Unread',
            'read_at' => null,
        ]);

        return redirect()
            ->route('notifications.index')
            ->with('success', 'Notification marked as unread.');
    }
}