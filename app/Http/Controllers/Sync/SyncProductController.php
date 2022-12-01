<?php

namespace App\Http\Controllers\Sync;

use App\Http\Controllers\Controller;
use App\Models\Madjou\Product;
use App\Services\SycnMadjou\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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

        $sycn = new UserService();
        $data = $sycn->create($product, $request);
        Log::alert('sycn-create-user: ', json_encode($data));
        return $data;
    }

    /**
     * create for madjou list
     */
    public function list(Request $request)
    {
        $product = Product::find($request->id);
        $response = Http::get($product->url, ["key" => $product->key]);
        return response()->json($response);
    }

    /**
     * create for update user
     */
    public function update(Request $request)
    {
        $product = Product::find($request->id);
        $sycn = new UserService();
        $data = $sycn->list($product, $request);
        Log::alert('sycn-create-update: ', json_encode($data));
        return $data;
    }
}
