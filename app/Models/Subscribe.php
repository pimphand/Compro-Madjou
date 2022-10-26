<?php

namespace App\Models;

use App\Notifications\SubscribeNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Subscribe extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

    /**
     * Route notifications for the mail channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return array|string
     */
    public function send($data)
    {
        $this->notify(new SubscribeNotification($data));
    }
}
