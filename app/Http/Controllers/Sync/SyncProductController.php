<?php

namespace App\Http\Controllers\Sync;

use App\Http\Controllers\Controller;
use App\Models\Madjou\Product;
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
        $validate = "";
        $product = Product::find($request->id);

        $sycn = new CreateUser();
        $data = $sycn->create($product, $request);
        Log::alert('sycn-create-user: ', json_encode($data));
        return $data;
    }
}
