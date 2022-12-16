<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Madjou\Product;
use App\Models\Order;
use App\Models\Package;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    
    public function create(Request $request, $id)
    {
        // create invoice code
        $noUrut = Order::count();
        $no= $noUrut;
        $auto=intval($no)+1;
        $inv_code= str_pad($auto , 6, '0', STR_PAD_LEFT);

        // unique code payment
        $uniq_code = rand(0,999);

        // fee for admin
        $fee = 5000;


        if( $request->type == 1 )
        {
            $product = Package::findOrFail($id);
        } 
        else if( $request->type == 2 )
        {
            $product = Product::findOrFail($id);
        } 

        $total = $product->price + $fee + $uniq_code;

        $order = Order::create([
            'type'          => $request->type,
            'booking_id'    => $product->id,
            'user_id'       => $request->user_id,
            'amount'        => $total,
            'code_unique'   => $uniq_code,
            'invoice_id'    => 'MDJ' . '-' . $inv_code,
        ]);

        return [
            'success'   => true,
            'message'   => 'Order berhasil dilaksanakan!',
            'data'      => new OrderResource($order),
        ];
    }
}
