<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\CarrerResource;
use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CarrerController extends Controller
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
            $dataCarrer = Career::latest()->get();

            return DataTables::of($dataCarrer)
                    ->addIndexColumn()
                    ->make(true);
        }

        return view('pages.careers.index')->with('carrers');
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
        $data   = Validator::make($request->all(),[
            'name'  => 'required',
            'body'  => 'requried',
            'location'  => 'required',
            'department'    => 'required',
            'minimum_experience'    => 'requried',
            'employment_type'       => 'required', 
        ], [
            'name.required'     => 'Nama tidak boleh kosong',
            'body.required'     => 'Konten tidak boleh kosong',
            'location.required' => 'Lokasi tidak boleh kosong',
            'minimum_experience.required'   => 'Pengalaman tidak boleh kosong',
            'employment_type.required'      => 'Tipe pekerja tidak boleh kosong',
        ]);

        if($data->fails())
        {
            return response()->json([
                'status'    => false,
                'errors'    => $data->getMessageBag()->toArray(),
            ]);
        }

        $career     = Career::create([
            'name'      => $request->name,
            'body'      => $request->body,
            'location'  => $request->location,
            'department'    => $request->department,
            'minimum_experience'    => $request->minimum_experience,
            'employment_type'       => $request->employment_type,
        ]);

        return [
            'success'   => true,
            'message'   => 'Data karir berhasil disimpan',
            'data'      => new CarrerResource($career),
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
        $data   = Validator::make($request->all(),[
            'name'  => 'required',
            'body'  => 'requried',
            'location'  => 'required',
            'department'    => 'required',
            'minimum_experience'    => 'requried',
            'employment_type'       => 'required', 
        ], [
            'name.required'     => 'Nama tidak boleh kosong',
            'body.required'     => 'Konten tidak boleh kosong',
            'location.required' => 'Lokasi tidak boleh kosong',
            'minimum_experience.required'   => 'Pengalaman tidak boleh kosong',
            'employment_type.required'      => 'Tipe pekerja tidak boleh kosong',
        ]);

        if($data->fails())
        {
            return response()->json([
                'status'    => false,
                'errors'    => $data->getMessageBag()->toArray(),
            ]);
        }

        $career     = Career::findOrFail($id);
        $career->update([
            'name'      => $request->name,
            'body'      => $request->body,
            'location'  => $request->location,
            'department'    => $request->department,
            'minimum_experience'    => $request->minimum_experience,
            'employment_type'       => $request->employment_type,
        ]);

        return [
            'success'   => true,
            'message'   => 'Data karir berhasil diubah',
            'data'      => new CarrerResource($career),
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
        $career = Career::destroy($id);

        return [
            'success'   => true,
            'message'   => 'Data karir berhasil dihapus',
        ];
    }
}
