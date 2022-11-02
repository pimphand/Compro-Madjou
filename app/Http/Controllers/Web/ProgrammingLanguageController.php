<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProgrammingLanguageResource;
use App\Models\ProgramingLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProgrammingLanguageController extends Controller
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
            $dataLanguage = ProgramingLanguage::latest()->get();

            return DataTables::of($dataLanguage)
                    ->addIndexColumn()
                    ->make(true);
        }

        return view('pages.languages.index')->with('languages');
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
            'name'  => 'required|string|unique:programing_languages',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048', 
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'name.unique'   => 'Nama sudah digunakan',
            'image.required'    => 'Gambar tidak boleh kosong',
        ]); 

        if($data->fails())
        {
            return response()->json([
                'status'    => false,
                'errors'    => $data->getMessageBag()->toArray()
            ]);
        }

        if($image = $request->file('image'))
        {
            $path           = 'language/';
            $languageImage  = $image->getClientOriginalName();
            $image->move($path);
            $request->image = $languageImage;
        }

        $language = ProgramingLanguage::create([
            'name'      => $request->name,
            'image'     => $request->image,
        ]);

        return response()->json([
            'success'   => true,
            'message'   => 'Data bahasa pemrogramman berhasil ditambahkan!',
            'data'      => new ProgrammingLanguageResource($language),
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
        $data = Validator::make($request->all(), [
            'name'  => 'required|string|unique:programing_languages,id,' . $id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', 
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'name.unique'   => 'Nama sudah digunakan',
        ]); 

        if($data->fails())
        {
            return response()->json([
                'status'    => false,
                'errors'    => $data->getMessageBag()->toArray()
            ]);
        }

        $language = ProgramingLanguage::findOrFail($id);

        if($request->hasFile('image') && $request->file('image') != null)
        {
            $imagePath = public_path().'/language/'.$language->image;
            if(File::exists($imagePath))
            {
                unlink($imagePath);
            }

            $image  = $request->file('image');
            $path   = 'language/';
            $languageImage  = $image->getClientOriginalName();
            $image->move($path, $languageImage);
            $request->image = $languageImage;
        }

        $language->update([
            'name'  => $request->name,
            'image' => $request->image ?? $language->image,
        ]);

        return response()->json([
            'success'   => true,
            'message'   => 'Data bahasa pemrograman berhasil diubah!',
            'data'      => new ProgrammingLanguageResource($language)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $language   = ProgramingLanguage::findOrFail($id);
        $path       = public_path().'/language/'.$language->image;
        unlink($path);

        $language->delete();

        return response()->json([
            'success'   => true,
            'message'   => 'Data bahasa pemrograman berhasil dihapus!'
        ], 200);
    }
}
