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
            'status' => $users['status'],
            'key' => $product->key
        ];

        return $this->request('POST', $product->url, ['form_params' => $params]);
    }

    public function list($product)
    {
        $params = [
            'key' => $product->key
        ];
        return $this->request('get', $product->url, ['form_params' => $params]);
    }

    public function update($product)
    {
        $params = [
            'key' => $product->key
        ];
        return $this->request('put', $product->url, ['form_params' => $params]);
    }
    public function delete($product)
    {
        $params = [
            'key' => $product->key
        ];
        return $this->request('delete', $product->url, ['form_params' => $params]);
    }
}
