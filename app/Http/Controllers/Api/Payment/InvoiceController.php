<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
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
    public function createInv(Request $request)
    {

        $package = Package::FindOrFail(1);

        $uniq_code = rand(0,999);

        $no = '0001';

        $fee = 5000;

        $total = $package->price + $fee + $uniq_code;

        $order = Order::create([
            'type'          => $package->id,
            'user_id'       => $request->user_id,
            'amount'        => $total,
            'code_unique'   => $uniq_code,
            'invoice_id'    => 'MDJ' . '-' . intval($no)+1,
        ]);

        if($order)
        {
            $inv_params = [
                'external_id'   => $order->invoice_id,
                'payer_email'   => 'rieflvi@gmail.com',
                'description'   => 'Pembbayaran web',
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
                    'name'          => 'rochman',
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
                'data'      => $inv,
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
