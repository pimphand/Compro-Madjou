<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectTypeResource;
use App\Models\ProjectType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProjectTypeController extends Controller
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
            $dataProType    = ProjectType::latest()->get();

            return DataTables::of($dataProType)
                    ->addIndexColumn()
                    ->make(true);
        }

        return view('pages.project-types.index')->with('project-types');
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
        $data   = Validator::make($request->all(), [
            'name'  => 'required|string|max:50'
        ], [
            'name.required'     => 'Nama tipe projek tidak boleh kosong',
        ]);

        if($data->fails())
        {
            return response()->json([
                'status'    => false,
                'errors'    => $data->getMessageBag()->toArray(),
            ]);
        }

        $proType    = ProjectType::create([
            'name'  => $request->name,
        ]);

        return [
            'success'   => true,
            'message'   => 'Data tipe projek berhasil disimpan',
            'data'      => new ProjectTypeResource($proType),
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
        $data   = Validator::make($request->all(), [
            'name'  => 'required|string|max:50'
        ], [
            'name.required'     => 'Nama tipe projek tidak boleh kosong',
        ]);

        if($data->fails())
        {
            return response()->json([
                'status'    => false,
                'errors'    => $data->getMessageBag()->toArray(),
            ]);
        }

        $proType = ProjectType::findOrFail($id);
        $proType->update([
            'name'  => $request->name,
        ]);

        return [
            'success'   => true,
            'message'   => 'Data tipe projek berhasil diubah',
            'data'      => new ProjectTypeResource($proType),
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
        $proType = ProjectType::findOrFail($id);
        $proType->delete();

        return [
            'success'   => true,
            'message'   => 'Data tipe projek berhasil dihapus',
        ];
    }
}
