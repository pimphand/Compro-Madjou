<?php

namespace App\Models;

use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
{
    public $guarded = [];

    protected $fillable = [
        'name','display_name','description'
    ];

    public function Role(){
        return $this->hasMany(Permission::class, 'permission_id', 'id');
    }
}
