<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'service_id', 'title', 'body', 'image', 'lang'
    ];

    public function getService()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }
}
