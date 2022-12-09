<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Xendit\Xendit;


class XenditController extends Controller
{
    function __construct()
    {
        Xendit::setApiKey(env('API_KEY'));
    }

    // get balance xendit
    public function balance() {


       $getBalance =  \Xendit\Balance::getBalance('CASH');

       return [
            'success'   => true,
            'message'   => 'Balance berhasil ditampilkan',
            'data'      => $getBalance,
       ];
    }


}
