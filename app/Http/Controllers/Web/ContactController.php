<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ContactController extends Controller
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
            $dataContact    = Contact::latest()->get();

            return DataTables::of($dataContact)
                    ->addIndexColumn()
                    ->make(true);
        }

        return view('pages.settings.contact')->with('contacts');
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
            'name'      => 'required|string|unique:contacts',
            'image'     => 'nullable|image|mimes:png,svg|max:1048',
            'url'       => 'required',
        ], [
            'name.required'     => 'Nama tidak boleh kosong',
            'name.unique'       => 'Nama sudah digunakan',
            'url.required'      => 'Url tidak boleh kosong'
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
            $fileNameWithExt    = $image->getClientOriginalName();
            $fileNameSave       = Str::uuid();
            $path               = $image->storeAs('public/contacts', $fileNameSave);
        }

        $contact    = Contact::create([
            'name'  => $request->name,
            'image' => $fileNameSave,
            'url'   => $request->url,
        ]);

        return [
            'success'   => true,
            'message'   => 'Data kontak berhasil ditambahkan',
            'data'      => new ContactResource($contact)
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
        $data     = Validator::make($request->all(), [
            'name'      => 'required|string|unique:contacts,id'.$id,
            'url'       => 'requiered',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'name.unique'   => 'Nama sudah digunakan',
            'url.required'  => 'Url tidak boleh kosong',
        ]);

        if($data->fails())
        {
            return response()->json([
                'status'    => false,
                'errors'    => $data->getMessageBag()->toArray()
            ]);
        }

        $contact    = Contact::findOrFail($id);

        if($request->hasFile('image') && $request->file('image') != null)
        {
            Storage::delete('public/contacts/'.$contact->image);
            
            $fileNameWithExt   = $request->file('image')->getClientOriginalName();
            $fileNameSave      = Str::uuid();
            $path               = $request->file('image')->storeAs('public/contacs', $fileNameSave);
        }

        $contact->update([
            'name'  => $request->name,
            'image' => $fileNameSave ?? $contact->image,
            'url'   => $request->url
        ]);

        return [
            'success'   => true,
            'message'   => 'Data kontak ditambahkan',
            'data'      => new ContactResource($contact)
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
        $contact = Contact::findOrFail($id);

        Storage::delete('public/contacts/'.$contact->image);

        $contact->delete();

        return [
            'success'   => true,
            'message'   => 'Data kontak berhasil dihapus'
        ];
    }
}
