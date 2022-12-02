<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Xendit\Xendit;


class XenditController extends Controller
{
    private $token = "xnd_development_5C7LORbHK9Q3iBkBdJ4YlKqkv5hIDC1mZHmLdBD8SiKYBQvn9P6ALECTs5mJK";

    // get balance xendit
    public function balance() {

        Xendit::setApiKey($this->token);

       $getBalance =  \Xendit\Balance::getBalance('CASH');

       return [
            'success'   => true,
            'message'   => 'Balance berhasil ditampilkan',
            'data'      => $getBalance,
       ];
    }

    public function notification(Request $request)
    {
        Xendit::setApiKey($this->token);

        $token = 'cDXUdWlm67iwADEtFaXB4X8nNPEY3bLlmaPsT88xGMYF2IWC';

        return [
            'success'   => true,
            'data'      => $token,
        ];
    }

    // data virtual account
    public function virtualAccount(){
        Xendit::setApiKey($this->token);


        $id = '6388f7cd85fde344e2c20876';
        $getVA = \Xendit\VirtualAccounts::retrieve($id);
        
        return [
            'success'   => true,
            'message'   => 'VA berhasil ditampilkan',
            'data'      => $getVA,
        ];
    }

    // create virtual account
    public function createVa()
    {
        Xendit::setApiKey($this->token);

        $params = [ 
            "external_id" => "madjou-1",
            "bank_code" => "MANDIRI",
            "name" => "Aji"
          ];
        
          $createVA = \Xendit\VirtualAccounts::create($params);

          return [
            'success'   => true,
            'message'   => 'pembuatan virtual account berhasil',
            'data'      => $createVA,
          ];
    }

    public function updateVa()
    {
        Xendit::setApiKey($this->token);

        $id = '6388f7cd85fde344e2c20876';
        $updateParams = ["suggested_amount" => 100000];

        $updateVA = \Xendit\VirtualAccounts::update($id, $updateParams);

        return [
            'success'   => true,
            'message'   => 'Virtual account telah diperbarui',
            'data'      => $updateVA
        ];
    }

    public function pay(){
        Xendit::setApiKey($this->token);

        $params = [
            "external_id"   => 'demo',
            "amount"        => 50000,
            "email"     => 'rieflvi@gmail.com',
        ];

        $getPay = \Xendit\Payouts::create($params);

        return response()->json([
            'success'   => true,
            'message'   => 'Pembayaran diupdate',
            'data'      => $getPay
        ]);
    }


}
