<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'chatroom_id',
        'user_id',
        'message_text',
        'attachment_path',
    ];

    public function chatroom() {
        return $this->belongsTo(Chatroom::class);
    }
    
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function attachment() {
        return $this->hasOne(Attachment::class);
    }
}
