<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags    = Tag::all();

        if(request()->ajax())
        {
            $dataService    = Service::with('getUser')->latest()->get();

            return DataTables::of($dataService)
                    ->addColumn('getUser', function($user){
                        return $user->getUser->name;
                    })
                    ->addIndexColumn()
                    ->make(true);
        }

        return view('pages.services.index',[
            'tags'   => $tags,
        ])->with('services');
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
            'title'     => 'required|max:50|',
            'body'      => 'required|string|',
            'image'     => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'title.required'    => 'Judul tidak boleh kosong',
            'body.required'     => 'Kontent tidak boleh kosong',
            'image.required'    => 'Gambar tidak boleh kosong',
        ]);

        if($data->fails())
        {
            return response()->json([
                'status'    => false,
                'errors'    => $data->getMessageBag()->toArray(),
            ]);
        }

        if($image = $request->file('image'))
        {
            $fileNameWithExt   = $image->getClientOriginalName();
            $fileName          = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $ext               = $image->getClientOriginalExtension();
            $fileNameSave      = Str::uuid();
            $path              = $image->storeAs('public/service', $fileNameSave);  
        }

        $service    = Service::create([
            'name'      => $request->name,
            'user_id'   => Auth::user()->id,
            'title'     => $request->title,
            'slug'      => Str::slug($request->title),
            'tags'      => $request->tags,
            'body'      => $request->body,
            'image'     => $fileNameSave,
        ]);

        return [
            'success'   => true,
            'message'   => 'Data layanan berhasil ditambahkan!',
            'data'      => new ServiceResource($service),
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
            'title'     => 'required|max:50',
            'body'      => 'required|',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'name.required'     => 'Nama tidak boleh kosong',
            'title.required'    => 'Judul tidak boleh kosong',
            'body.required'     => 'Konten tidak boleh kosong',
        ]);

        if($data->fails())
        {
            return response()->json([
                'status'    => false,
                'errors'    => $data->getMessageBag()->toArray()
            ]);
        }

        $service    = Service::findOrFail($id);

        if($request->hasFile('image') && $request->file('image') != null)
        {
            Storage::delete('public/service/'.$service->image);
            

            $fileNameWithExt    = $request->file('image')->getClientOriginalName();
            $fileName           = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $ext                = $request->file('image')->getClientOriginalExtension();
            $fileNameSave       = Str::uuid();
            $path               = $request->file('image')->storeAs('public/service', $fileNameSave);
        }

        $service->update([
            'name'      => $request->name,
            'user_id'   => Auth::user()->id,
            'title'     => $request->title,
            'slug'      => Str::slug($request->title),
            'body'      => $request->body,
            'tags'      => $request->tags,
            'image'     => $fileNameSave ?? $service->image,
        ]);

        return [
            'success'   => true,
            'message'   => 'Data layanan berhasil diubah!',
            'data'      => new ServiceResource($service),
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
        $service    = Service::findOrFail($id);
        Storage::delete('public/service/'.$service->image);
        $service->delete();

        return [
            'success'   => true,
            'message'   => 'Data layanan berhasil dihapus!',
        ];

    }
}
