<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeRegistration extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'career_id', 'name', 'email', 'phone',
        'address', 'province_code', 'city_code',
        'district_code', 'village_code',
    ];


    /**
     * Get the user that owns the EmployeeRegistration
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getCareer()
    {
        return $this->belongsTo(Career::class, 'career_id', 'id');
    }

   
}
