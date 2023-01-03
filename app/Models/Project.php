<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_type_id', 'title', 'programing', 'body', 'slug', 'image', 
        'url', 'location', 'lang', 'years', 'logo', 'client_about', 'price'
    ];

    public function getType(): BelongsTo
    {
        return $this->belongsTo(ProjectType::class, 'project_type_id', 'id');
    }

    public function gallery(): HasMany
    {
        return $this->hasMany(ProjectGallery::class);
    }
    public function development(): HasMany
    {
        return $this->hasMany(ProjectDevelop::class);
    }

    public function setProgramingAttribute($value)
    {
        $this->attributes['programing'] = json_encode($value);
    }

    // public function getProgramingAttribute($value)
    // {
    //     return $this->attributes['programing']    = json_decode($value);
    // }

    public function programing(): BelongsTo
    {
        return $this->belongsTo(ProgramingLanguage::class, 'programing', 'name');
    }

    protected $casts = [
        'programing' => 'array',
    ];
}
