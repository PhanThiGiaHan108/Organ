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
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
    public function repliedBy()
    {
        return $this->belongsTo(User::class, 'replied_by_user_id');
    }
}
