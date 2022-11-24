<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\DetailServiceResource;
use App\Models\Service;
use App\Models\ServiceDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class DetailServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();

        if (request()->ajax()) {
            $dataDetService = ServiceDetail::latest()->get();
            return DataTables::of($dataDetService)
                ->addColumn('getService', function ($service) {
                    return $service->getService->title;
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('pages.detail-services.index', [
            'services'   => $services,
        ])->with('detail-services');
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
            'title'         => 'required|string|max:50',
            'body'          => 'required|string|',
            'image'         => 'required|image|mimes:jpg,jpeg,png',
        ], [
            'title.required'    => 'Judul tidak boleh kosong',
            'body.required'     => 'Konten tidak boleh kosong',
            'image.required'    => 'Gambar tidak boleh kosong',
        ]);

        if ($data->fails()) {
            return response()->json([
                'status'    => false,
                'errors'    => $data->getMessageBag()->toArray(),
            ]);
        }

        if ($image = $request->file('image')) {
            $fileNameWithExt    = $image->getClientOriginalName();
            $fileName           = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $ext                = $image->getClientOriginalExtension();
            $fileNameSave       = Str::uuid();
            $path               = $image->storeAs('public/detail-service', $fileNameSave);
        }

        $detService     = ServiceDetail::create([
            'service_id'        => $request->service_id,
            'title'             => $request->title,
            'body'              => $request->body,
            'image'             => $fileNameSave,
        ]);

        return [
            'success'   => true,
            'message'   => 'Data detail layanan berhasil disimpan!',
            'data'      => new DetailServiceResource($detService),
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
            'title'         => 'required|string|max:50',
            'body'          => 'required|string|',
            'image'         => 'nullable|image|mimes:jpg,jpeg,png',
        ], [
            'title.required'    => 'Judul tidak boleh kosong',
            'body.required'     => 'Konten tidak boleh kosong',
        ]);

        if ($data->fails()) {
            return response()->json([
                'status'    => false,
                'errors'    => $data->getMessageBag()->toArray(),
            ]);
        }

        $detService = ServiceDetail::findOrFail($id);

        if ($request->file('image') != null) {
            Storage::delete('public/detail-service/' . $detService->image);

            $fileNameWithExt    = $request->file('image')->getClientOriginalName();
            $fileName           = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $ext                = $request->file('image')->getClientOriginalExtension();
            $fileNameSave       = Str::uuid();
            $path               = $request->file('image')->storeAs('public/detail-service', $fileNameSave);
        }

        $detService->update([
            'service_id'    => $request->service_id,
            'title'         => $request->title,
            'body'          => $request->body,
            'image'         => $fileNameSave ?? $detService->image,
        ]);

        return [
            'success'   => true,
            'message'   => 'Data detail layanan berhasil diubah!',
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
        $detService = ServiceDetail::findOrFail($id);
        Storage::delete('public/detail-service/' . $detService->image);

        $detService->delete();

        return [
            'success'   => true,
            'message'   => 'Data detail layanan berhasil dihapus!',
        ];
    }
}
