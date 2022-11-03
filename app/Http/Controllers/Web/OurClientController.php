<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\OurClientResource;
use App\Models\OurClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class OurClientController extends Controller
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
            $dataClient = OurClient::latest()->get();

            return DataTables::of($dataClient)
                    ->addIndexColumn()
                    ->make(true);
        }

        return view('pages.our-clients.index')->with('clients');
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
        $data = Validator::make($request->all(),[
            'name'  => 'required|string|',
            'url'   => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'name.required'     => 'Nama tidak boleh kosong',
            'url.required'      => 'Url tidak boleh kosong',
            'image'             => 'Gambar tidak boleh kosong',
        ]);

        if ($data->fails()) 
        {
            return response()->json([
                'status'    => false,
                'errors'   => $data->getMessageBag()->toArray(),
            ]);
        }

        if($image = $request->file('image'))
        {
            $fileNameWithExt    = $image->getClientOriginalName();
            $fileName           = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $ext                = $image->getClientOriginalExtension();
            $fileNameSave       = $fileName.'.'.$ext;
            $path               = $image->storeAs('public/clients', $fileNameSave);
        }

        $client     = OurClient::create([
            'name'      => $request->name,
            'url'       => $request->url,
            'image'     => $fileNameSave,
        ]);

        return [
            'success'   => true,
            'message'   => 'Data client berhasil ditambahkan!',
            'data'      => new OurClientResource($client),
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
            'name'      => 'required|string',
            'url'       => 'required|string|max:255',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ],[
            'name.required'     => 'Nama tidak boleh kosong',
            'url.required'      => 'Url tidak boleh kosong',
        ]);

        if($data->fails())
        {
            return response()->json([
                'status'    => false,
                'errors'    => $data->getMessageBag()->toArray()
            ]);
        }

        $client = OurClient::findOrFail($id);

        if($request->hasFile('image') && $request->file('image') != null)
        {
            Storage::delete($client->image);
            
            $fileNameWithExt        = $request->file('image')->getClientOriginalName();
            $fileName               = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $ext                    = $request->file('image')->getClientOriginalExtension();
            $fileNameSave           = $fileName.'.'.$ext;
            $path                   = $request->file('image')->store($fileNameSave);
        }

        $client->update([
            'name'      => $request->name,
            'url'       => $request->url,
            'image'     => $fileNameSave ?? $client->image
        ]);

        return [
            'success'   => true,
            'message'   => 'Data client berhasil diubah!',
            'data'      => new OurClientResource($client)
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
        $client = OurClient::findOrFail($id);

        $path = Storage::delete($client->image);

        $client->delete();

        return [
            'success'   => true,
            'message'   => 'Data client berhasil dihapus!',
        ];
    }
}
