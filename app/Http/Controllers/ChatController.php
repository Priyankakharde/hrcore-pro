<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ChatController extends Controller
{
    /**
     * Display Chats
     */
    public function index(Request $request): View
    {
        $query = Chat::with('employee');

        // Search
        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('subject', 'like', '%' . $request->search . '%')
                  ->orWhere('message', 'like', '%' . $request->search . '%');

            });

        }

        // Employee Filter
        if ($request->filled('employee')) {

            $query->where('employee_id', $request->employee);

        }

        // Status Filter
        if ($request->filled('status')) {

            $query->where('status', $request->status);

        }

        // Read Filter
        if ($request->filled('read')) {

            if ($request->read == 'Read') {

                $query->where('is_read', true);

            } else {

                $query->where('is_read', false);

            }

        }

        $chats = $query
            ->latest()
            ->paginate(10);

        return view('chat.index', [

            'chats' => $chats,

            'employees' => Employee::orderBy('name')->get(),

            'totalChats' => Chat::count(),

            'activeChats' => Chat::where('status', 'Active')->count(),

            'unreadChats' => Chat::where('is_read', false)->count(),

            'todayChats' => Chat::whereDate('created_at', today())->count(),

        ]);
    }

    /**
     * Show Create Form
     */
    public function create(): View
    {
        $employees = Employee::orderBy('name')->get();

        return view('chat.create', compact('employees'));
    }
        /**
     * Store Chat
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([

            'employee_id' => 'required|exists:employees,id',

            'subject' => 'required|string|max:255',

            'message' => 'required|string',

            'status' => 'required|string',

            'priority' => 'required|string',

            'chat_type' => 'required|string',

            'is_read' => 'nullable|boolean',

            'is_pinned' => 'nullable|boolean',

            'is_starred' => 'nullable|boolean',

            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',

        ]);

        // Upload Attachment
        if ($request->hasFile('attachment')) {

            $validated['attachment'] = $request
                ->file('attachment')
                ->store('chat-attachments', 'public');

        }

        // Checkbox Defaults
        $validated['is_read'] = $request->boolean('is_read');

        $validated['is_pinned'] = $request->boolean('is_pinned');

        $validated['is_starred'] = $request->boolean('is_starred');

        Chat::create($validated);

        return redirect()
            ->route('chat.index')
            ->with('success', 'Chat created successfully.');
    }
        /**
     * Display Chat
     */
    public function show(Chat $chat): View
    {
        return view('chat.show', compact('chat'));
    }

    /**
     * Show Edit Form
     */
    public function edit(Chat $chat): View
    {
        $employees = Employee::orderBy('name')->get();

        return view(
            'chat.edit',
            compact('chat', 'employees')
        );
    }
        /**
     * Update Chat
     */
    public function update(Request $request, Chat $chat): RedirectResponse
    {
        $validated = $request->validate([

            'employee_id' => 'required|exists:employees,id',

            'subject' => 'required|string|max:255',

            'message' => 'required|string',

            'status' => 'required|string',

            'priority' => 'required|string',

            'chat_type' => 'required|string',

            'is_read' => 'nullable|boolean',

            'is_pinned' => 'nullable|boolean',

            'is_starred' => 'nullable|boolean',

            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',

        ]);

        // Upload New Attachment

        if ($request->hasFile('attachment')) {

            $validated['attachment'] = $request
                ->file('attachment')
                ->store('chat-attachments', 'public');

        }

        // Checkbox Values

        $validated['is_read'] = $request->boolean('is_read');

        $validated['is_pinned'] = $request->boolean('is_pinned');

        $validated['is_starred'] = $request->boolean('is_starred');

        $chat->update($validated);

        return redirect()
            ->route('chat.index')
            ->with('success', 'Chat updated successfully.');
    }
        /**
     * Delete Chat
     */
    public function destroy(Chat $chat): RedirectResponse
    {
        if ($chat->attachment && \Storage::disk('public')->exists($chat->attachment)) {

            \Storage::disk('public')->delete($chat->attachment);

        }

        $chat->delete();

        return redirect()
            ->route('chat.index')
            ->with('success', 'Chat deleted successfully.');
    }

    /**
     * Mark Chat as Read
     */
    public function markAsRead(Chat $chat): RedirectResponse
    {
        $chat->update([
            'is_read' => true,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Chat marked as read.');
    }

    /**
     * Mark Chat as Unread
     */
    public function markAsUnread(Chat $chat): RedirectResponse
    {
        $chat->update([
            'is_read' => false,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Chat marked as unread.');
    }
        /**
     * Pin Chat
     */
    public function pin(Chat $chat): RedirectResponse
    {
        $chat->update([
            'is_pinned' => true,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Chat pinned successfully.');
    }

    /**
     * Unpin Chat
     */
    public function unpin(Chat $chat): RedirectResponse
    {
        $chat->update([
            'is_pinned' => false,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Chat unpinned successfully.');
    }

    /**
     * Star Chat
     */
    public function star(Chat $chat): RedirectResponse
    {
        $chat->update([
            'is_starred' => true,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Chat marked as important.');
    }

    /**
     * Remove Star
     */
    public function unstar(Chat $chat): RedirectResponse
    {
        $chat->update([
            'is_starred' => false,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Chat removed from important.');
    }
}