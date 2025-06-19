<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'is_read',
        'user_id', 
    ];

    /**
     * Lấy các phản hồi của admin.
     */
    public function replies(): HasMany
    {
        return $this->hasMany(ContactReply::class);
    }

    /**
     * Lấy thông tin user gửi tin nhắn.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
