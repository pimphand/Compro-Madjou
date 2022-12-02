<?php

namespace App\Services\SycnMadjou;

class UserService extends BaseApi
{
    public function create($product, $users)
    {
        $params = [
            'name' => $users['name'],
            'email' => $users['email'],
            'type' => 1,
            'username' => $users['username'],
            'password' => $users['password'],
            'expired_at' => $users['expired'],
            'status' => 1,
            'key' => $product->key
        ];

        return $this->request('POST', $product->url_store, ['form_params' => $params]);
    }

    public function list($product)
    {
        $params = [
            'key' => $product->key
        ];

        return $this->request('POST', $product->url_list, ['form_params' => $params]);
    }

    public function update($product)
    {
        $params = [
            'key' => $product->key
        ];
        return $this->request('POST', $product->url_update, ['form_params' => $params]);
    }
    public function delete($product, $request)
    {
        $params = [
            'key' => $product->key
        ];
        return $this->request('POST', $product->url_delete . "/" . $request->id, ['form_params' => $params]);
    }
}
