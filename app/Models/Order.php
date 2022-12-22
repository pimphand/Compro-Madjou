<?php

namespace App\Models;

use App\Models\Madjou\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
    'type', 'user_id', 'amount', 'code_unique', 'invoice_id','booking_id'
    ];

    public function product(){
        return $this->belongsTo(Package::class, 'booking_id', 'id');
    }

    public function products(){
        return $this->belongsTo(Product::class, 'booking_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
