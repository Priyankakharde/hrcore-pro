<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'subject',
        'message',
        'status',
        'priority',
        'is_read',
        'chat_type',
        'attachment',
        'is_pinned',
        'is_starred',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'is_pinned' => 'boolean',
        'is_starred' => 'boolean',
    ];

    /**
     * Employee Relationship
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Check if chat is unread
     */
    public function isUnread()
    {
        return !$this->is_read;
    }

    /**
     * Check if chat is read
     */
    public function isRead()
    {
        return $this->is_read;
    }

    /**
     * Mark chat as read
     */
    public function markAsRead()
    {
        $this->update([
            'is_read' => true,
        ]);
    }

    /**
     * Mark chat as unread
     */
    public function markAsUnread()
    {
        $this->update([
            'is_read' => false,
        ]);
    }
}