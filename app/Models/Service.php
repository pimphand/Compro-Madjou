<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'title', 'slug', 'tags', 'body'
        ,'image', 'lang'
    ];

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function setTagsAttribute($value)
    {
        $this->attributes['tags']   = json_encode($value);
    }

    public function getTagsAtrribute($value)
    {
        $this->attributes['tags']   = json_encode($value);
    }
}
