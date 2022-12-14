<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_type_id', 'title', 'programing', 'body', 'slug', 'image', 'url', 'location', 'lang'
    ];

    public function getType()
    {
        return $this->belongsTo(ProjectType::class, 'project_type_id', 'id');
    }
}
