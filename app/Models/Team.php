<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'category_team_id','name','image',
        'position','lang'
    ];

    /**
     * Get the getTeam that owns the Team
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getTeam(): BelongsTo
    {
        return $this->belongsTo(TeamCategory::class, 'category_team_id', 'id');
    }
}
