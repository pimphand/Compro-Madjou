<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class EventController extends Controller
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
            $event = Event::latest()->get();

            return DataTables::of($event)
                    ->addIndexColumn()
                    ->make(true);
        }
        
        return view('pages.events.index')->with('events');
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
            'title'     => 'required',
            'body'      => 'required',
            'location'  => 'required',
            'image'     => 'required|image|mimes:jpg,jpeg,png,svg,webp|max:2048',
            'date'      => 'required',
            'time'      => 'required'
        ], [
            'title.required'        => 'Judul tidak boleh kosong!',
            'body.required'         => 'Konten tidak boleh kosong!',
            'location.required'     => 'Lokasi tidak boleh kosong!',
            'image.required'        => 'Gambar tidak boleh kosong!',
            'date.required'         => 'Tanggal event tidak boleh kosong!',
            'time.required'         => 'Jam event tidak boleh kosong!'
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
            $path              = $image->storeAs('public/events', $fileNameSave);  
        }

        $event  = Event::create([
            'title'     => $request->title,
            'slug'      => Str::slug($request->title),
            'body'      => $request->body,
            'image'     => $fileNameSave,
            'location'  => $request->location,
            'date'      => $request->date,
            'time'      => $request->time,
        ]);

        return [
            'success'   => true,
            'message'   => 'Data event berhasil disimpan',
            'data'      => new EventResource($event),
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
            'title'     => 'required|string|',
            'body'      => 'required',
            'location'  => 'required',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048',
            'date'      => 'required',
            'time'      => 'required',
        ],[
            'title.required'        => 'Judul tidak boleh kosong!',
            'body.required'         => 'Konten tidak boleh kosong!',
            'location.required'     => 'Lokasi tidak boleh kosong!',
            'image.max'             => 'Gambar melebihi batas!',
            'image.mimes'           => 'Ekstensi gambar tidak sesuai!',
            'date.required'         => 'Tanggal event tidak boleh kosong!',
            'time.required'         => 'Jam event tidak boleh kosong!',
        ]);

        if($data->fails())
        {
            return response()->json([
                'status'    => false,
                'errors'    => $data->getMessageBag()->toArray(),
            ]);
        }

        $event = Event::findOrFail($id);

        if($request->hasFile('image') && $request->file('image') != null)
        {
            Storage::delete('public/events/'. $event->image);

            $fileNameWithExt    = $request->file('image')->getClientOriginalName();
            $fileName           = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $ext                = $request->file('image')->getClientOriginalExtension();
            $fileNameSave       = Str::uuid();
            $path               = $request->file('image')->storeAs('public/events', $fileNameSave); 
        }

        $event->update([
            'title'     => $request->title,
            'body'      => $request->body,
            'slug'      => Str::slug($request->title),
            'location'  => $request->location,
            'date'      => $request->date,
            'time'      => $request->time,
            'image'     => $fileNameSave ?? $event->image,
        ]);

        return [
            'success'   => true,
            'message'   => 'Data event berhasil diubah',
            'data'      => new EventResource($event),
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
        $event = Event::findOrFail($id);
        Storage::delete('public/events/'.$event->image);

        $event->delete();

        return [
            'success'   => true,
            'message'   => 'Data event berhasil dihapus',
        ];
    }
}
