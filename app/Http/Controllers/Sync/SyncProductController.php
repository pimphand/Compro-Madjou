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
    public function store(Request $request, $id)
    {
        $validate = "";
        $product = Product::find($id);

        $sycn = new UserService();
        $data = $sycn->create($product, $request);
        if ($data) {
            return [
                'success'   => true,
                'message'   => 'Data produk berhasil ditambahkan',
            ];
        }
    }

    /**
     * create for madjou list
     */
    public function list(Request $request, $id)
    {
        $product = Product::find($id);
        $sycn = new UserService();
        $data = $sycn->list($product, $request);
        return response()->json($data);
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

    /**
     * create for update user
     */
    public function delete(Request $request, $id)
    {
        $product = Product::find($id);
        $sycn = new UserService();
        $data = $sycn->delete($product, $request);
        if ($data) {
            return [
                'success'   => true,
                'message'   => 'Data produk berhasil dihapus',
                "DATA" => $data
            ];
        }
    }
}
