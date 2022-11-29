<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class EventRegister extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'event_id', 'name', 'email','phone', 'agency'
    ];

    public function getEvent(){
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }
}
