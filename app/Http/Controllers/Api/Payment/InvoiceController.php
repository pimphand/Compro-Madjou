<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Madjou\Product;
use App\Models\Order;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Xendit\Xendit;

class InvoiceController extends Controller
{
    function __construct()
    {
        Xendit::setApiKey(env('API_KEY'));
    }

    // create invoice 
    public function createInv(Request $request, $id)
    {
        $type = $request->type;

        if( $type == 1 )
        {
            $product = Package::findOrFail($id);
        } 
        else if( $type == 2 )
        {
            $product = Product::findOrFail($id);
        } 
        
        $noUrut = Order::count();
        $no= $noUrut;
        $auto=intval($no)+1;
        $inv_code= str_pad($auto , 6, '0', STR_PAD_LEFT);

        $uniq_code = rand(0,999);

        $fee = 5000;

        $total = $product->price + $fee + $uniq_code;

        $order = Order::create([
            'type'          => $type,
            'user_id'       => $request->user_id,
            'amount'        => $total,
            'code_unique'   => $uniq_code,
            'booking_id'    => $product->id,
            'invoice_id'    => 'MDJ' . '-' . $inv_code,
        ]);
        

        if($order)
        {
            $inv_params = [
                'external_id'   => $order->invoice_id,
                'payer_email'   => 'rieflvi@gmail.com',
                'description'   => 'Pembayaran web',
                'fees'          => [
                    [
                        'type'      => 'Admin Fee',
                        'value'     => $fee,
                    ],
                    [
                        'type'      => 'unique code',
                        'value'     => $uniq_code,
                    ]
                    ],
                'amount'        => $total,
                'customer'      => [
                    'surname'          => 'rochman',
                    'email'         => 'rieflvi@gmail.com',
                    'mobile_number' => '08998988682',
                ],
                'payment_methods' => [
                        'BCA', 'BNI',
                         'BSI', 'BRI', 'MANDIRI', 'PERMATA',
                ],
                'should_send_email' => true,
            ];
    
    
            $inv = \Xendit\Invoice::create($inv_params);
    
            return [
                'success'   => true,
                'message'   => 'Invoice berhasil dibuat',
                'data order'        => new OrderResource($order),
                'data invoice'      => $inv,
            ];
        }
        
        return [
            'success'   => true,
            'message'   => 'Data order berhasil disimpan',
            'data'      => new OrderResource($order),
        ];        
       
    }

    // get invoice
    public function getInvoice(Request $request)
    {
       $id = $request->id;

       $inv = \Xendit\Invoice::retrieve($id);

        return [
            'success'   => true,
            'message'   => 'berhasil mendapatkan invoice',
            'data'      => $inv
        ];
    }
   
}
