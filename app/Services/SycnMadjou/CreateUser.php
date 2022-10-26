<?php

namespace App\Services\SycnMadjou;

class CreateUser extends BaseApi
{
    public function create($product, $users)
    {
        $params = [
            'name' => $users->name,
            'username' => $users->username,
            'password' => $users->password,
            'expired' => $users->expired,
            'status' => $users->status,
            'code' => $product->code
        ];
        return $this->request('POST', $product->url, ['form_params' => $params]);
    }
}
