<?php

namespace App\Http\Controllers\Sync;

use App\Http\Controllers\Controller;
use App\Services\SycnMadjou\CreateUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SyncProductController extends Controller
{
    /**
     * create for madjou product
     */
    public function store(Request $request)
    {
        $sycn = new CreateUser();
        $data = $sycn->create($request->all());

        Log::alert('sycn-create-user: ', json_encode($data));
        return $data;
    }
}
