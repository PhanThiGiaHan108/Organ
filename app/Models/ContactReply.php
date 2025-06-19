<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_id',
        'replied_by_user_id',
        'reply',
    ];

    // Quan hệ: mỗi phản hồi thuộc về một liên hệ
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    // Quan hệ: người trả lời là 1 user (admin)
    public function repliedBy()
    {
        return $this->belongsTo(User::class, 'replied_by_user_id');
    }
}
