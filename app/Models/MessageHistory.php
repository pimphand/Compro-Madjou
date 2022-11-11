<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MessageHistory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'message_id','user_id',
        'status','comment',
    ];

    public function getMessage()
    {
        return $this->belongsTo(Message::class, 'message_id', 'id');
    }

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
