<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user1_id',
        'user2_id',
        'latest_message_id',
        'user1_unread_count',
        'user2_unread_count',
    ];

    public function user1()
    {
        return $this->belongsTo(User::class, 'user1_id');
    }

    public function user2()
    {
        return $this->belongsTo(User::class, 'user2_id');
    }

    public function latestMessage()
    {
        return $this->belongsTo(Message::class, 'latest_message_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'chat_id');
    }
}
