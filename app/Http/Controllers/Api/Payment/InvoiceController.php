<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Xendit\Xendit;

class InvoiceController extends Controller
{
    function __construct()
    {
        Xendit::setApiKey(env('API_KEY'));
    }

    public function invoice()
    {
        $params = [ 
            'external_id' => 'paket-1',
            'amount' => 3005000,
            'description' => 'Invoice Demo #123',
            'invoice_duration' => 86400,
            'customer' => [
                'given_names' => 'John',
                'surname' => 'Doe',
                'email' => 'johndoe@example.com',
                'mobile_number' => '+6287774441111',
                'addresses' => [
                    [
                        'city' => 'Jakarta Selatan',
                        'country' => 'Indonesia',
                        'postal_code' => '12345',
                        'state' => 'Daerah Khusus Ibukota Jakarta',
                        'street_line1' => 'Jalan Makan',
                        'street_line2' => 'Kecamatan Kebayoran Baru'
                    ]
                ]
            ],
            'currency' => 'IDR',
           
          ];
        
          $createInvoice = \Xendit\Invoice::create($params);
          
          return [
            'success'   => true,
            'message'   => 'Invoice berhasil dibuat',
            'data'      => $createInvoice
          ];
    }

    public function getInvoice()
    {
        $id = '638d944c373574474591c4e3';
        $getInvoice = \Xendit\Invoice::retrieve($id);

        return [
            'success'   => true,
            'message'   => 'berhasil mendapatkan invoice',
            'data'      => $getInvoice
        ];
    }
}
