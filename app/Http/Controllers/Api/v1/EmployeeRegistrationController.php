<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeRegistrationResource;
use App\Models\EmployeeRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            'career_id' => 'required|exists:careers,id',
            'name'      => 'required',
            'email'     => 'required|unique:employee_registrations,id|email',
            'phone'     => 'required|max:15',
            'address'   => 'required',
        ], [
            'career_id.required'    => 'Career tidak boleh kosong',
            'career_id.exists'      => 'Career tidak ditemukan',
            'name.required'         => 'Nama tidak boleh kosong',
            'name.unique'           => 'Nama sudah digunakan',
            'email.required'        => 'Email tidak boleh kosong',
            'email.unique'          => 'Email sudah digunakan',
            'email.email'           => 'Email tidak valid',
            'phone.required'        => 'Nomer telpon tidak boleh kosong',
            'address.required'      => 'Alamat tidak boleh kosong',
        ]);

        if ($data->fails()) {
            return response()->json([
                'status'    => false,
                'errors'    => $data->getMessageBag()->toArray()
            ]);
        }

        EmployeeRegistration::create([
            'career_id'     => $request->career_id,
            'name'          => $request->name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'province_code' => $request->province_code,
            'city_code'     => $request->city_code,
            'district_code' => $request->district_code,
            'village_code'  => $request->village_code,
        ]);

        return response()->json([
            'success'   => true,
            'message'   => 'Data employee berhasil disimpan'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
