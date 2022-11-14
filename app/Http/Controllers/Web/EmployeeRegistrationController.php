<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeRegistrationResource;
use App\Models\EmployeeRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class EmployeeRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax())
        {
            $dataEmployee = EmployeeRegistration::latest()->get();

            return DataTables::of($dataEmployee)
                    ->addIndexColumn()
                    ->make(true);
        }

        return view('pages.employees.index')->with('employees');
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
        //
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
        $data = Validator::make($request->all(),[
            'career_id' => 'required|',
            'name'      => 'required|unique:employee_registrations,id'.$id,
            'email'     => 'required|unique:employee_registrations,id'.$id,
            'phone'     => 'required|number|max:15',
            'address'   => 'requried|',
        ], [
            'career_id.required'    => 'Career tidak boleh kosong',
            'name.required'         => 'Nama tidak boleh kosong',
            'name.unique'           => 'Nama sudah digunakan',
            'email.required'        => 'Email tidak boleh kosong', 
            'email.unique'          => 'Email sudah digunakan',
            'phone.required'        => 'Nomer telpon tidak boleh kosong',
            'address.required'      => 'Alamat tidak boleh kosong',
        ]);

        if($data->fails())
        {
            return response()->json([
                'status'        => false,
                'errors'        => $data->getMessageBag()->toArray()
            ]);
        }

        $dataEmployee   = EmployeeRegistration::create([
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

        return [
            'success'   => true,
            'message'   => 'Data employee berhasil diubah',
            'data'      => new EmployeeRegistrationResource($dataEmployee)
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataEmployee = EmployeeRegistration::destroy($id);

        return [
            'success'   => true,
            'message'   => 'Data pekerja berhasil dihapus',
        ];
    }
}
