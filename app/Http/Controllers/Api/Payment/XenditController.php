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


}
