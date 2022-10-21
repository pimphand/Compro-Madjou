<?php

namespace App\Models;

use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
{
    public $guarded = [];

    protected $fillable = [
        'name','display_name','description'
    ];

    public function getRole(){
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
}
