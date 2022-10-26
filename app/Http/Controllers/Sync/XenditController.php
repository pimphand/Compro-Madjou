<?php

namespace App\Http\Controllers\Sync;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Xendit\Xendit;

class XenditController extends Controller
{
    public function __construct()
    {
        Xendit::setApiKey(config('services.xendit.secret'));
    }

    /**
     * get VA from xendit
     */
    public function getVa()
    {
        $getPaymentChannels = \Xendit\VirtualAccounts::getVABanks();

        return $getPaymentChannels;
    }
}
