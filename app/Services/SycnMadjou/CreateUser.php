<?php

namespace App\Services\SycnMadjou;

class CreateUser extends BaseApi
{
    public function create($data)
    {
        $params = [
            'name' => $data->name,
            'username' => $data->username,
            'password' => $data->password,
            'expired' => $data->expired,
            'status' => $data->status,
        ];
        return $this->request('POST', $data->url, ['form_params' => $params]);
    }
}
