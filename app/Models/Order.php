<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
    'type', 'user_id', 'amount', 'code_unique', 'invoice_id',''
    ];

    public function packages(){
        return $this->belongsTo(Package::class, 'type', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
