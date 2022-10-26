<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\PageLog;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->createPageLog();
    }

    /*
        function Log
    */
    public function createPageLog()
    {
        $log    = PageLog::whereIp(request()->getClientIp())
                    ->where('created_at', ">" , now()->subSecond(15))
                    ->count();

        if($log <= 0)
            if(strpos(request()->getRequestUri(), 'api') == true)
            {
                PageLog::create([
                    "page"  => \Str::substr(request()->getRequestUri(), 5),
                    "url"   => request()->getRequestUri(),
                    "ip"    => request()->getClientIp(),
                    "country"   => request()->country,
                    "province"  => request()->province,
                    "city"      => request()->city,
                    "district"  => request()->distric,
                    "village"   => request()->village,
                    "agent"     => request()->header("User-Agent"),
                    "os"        => null,   
                ]);
            }
    }
}
