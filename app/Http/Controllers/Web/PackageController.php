<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $package = Package::latest()->get();
            return DataTables::of($package)
                ->addIndexColumn()
                ->make(true);
        }
        return view('pages.package.index');
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
            'name'     => 'required',
            'price'      => 'required',
            'details'  => 'required',
        ], [
            'name.required'        => 'Nama Paket tidak boleh kosong!',
            'price.required'         => 'Harga tidak boleh kosong!',
            'details.required'     => 'Detail tidak boleh kosong!',
        ]);

        if ($data->fails()) {
            return response()->json([
                'status'    => false,
                'errors'    => $data->getMessageBag()->toArray(),
            ]);
        }

        Package::create([
            "name" => $request->name,
            "price" => $request->price,
            "details" => explode(",", $request->details),
        ]);

        return [
            'success'   => true,
            'message'   => 'Data paket berhasil disimpan',
        ];
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
        $data = Validator::make($request->all(), [
            'name'     => 'required',
            'price'      => 'required',
            'details'  => 'required',
        ], [
            'name.required'        => 'Nama Paket tidak boleh kosong!',
            'price.required'         => 'Harga tidak boleh kosong!',
            'details.required'     => 'Detail tidak boleh kosong!',
        ]);

        if ($data->fails()) {
            return response()->json([
                'status'    => false,
                'errors'    => $data->getMessageBag()->toArray(),
            ]);
        }

        Package::findOrFail($id)->update([
            "name" => $request->name,
            "price" => $request->price,
            "details" => explode(",", $request->details),
        ]);

        return [
            'success'   => true,
            'message'   => 'Data paket berhasil disimpan',
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
        Package::destroy($id);
        return [
            'success'   => true,
            'message'   => 'Data paket berhasil disimpan',
        ];
    }
}
