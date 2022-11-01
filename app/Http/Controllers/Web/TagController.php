<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagsResource;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $dataTag    = Tag::latest()->get();
            return DataTables::of($dataTag)
                ->addIndexColumn()
                ->make(true);
        }
        return view('pages.tags.index')->with('tags');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('');
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
            'type'  => 'required|string',
            'name'  => 'required|string|unique:tags'
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'name.unique' => 'Nama sudah digunakan',
            'type.required' => 'Tipe tidak boleh kosong',
        ]);

        if ($data->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $data->getMessageBag()->toArray()
            ]);
        }

        $tag    = Tag::create([
            'type'      => $request->type,
            'name'      => $request->name,
        ]);

        return [
            'success'   => true,
            'message'   => 'Data tag berhasil ditambahkan!',
            'data'      => new TagsResource($tag)
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
        $tag = Tag::findOrFail($id);

        return response()->json([
            'success'   => true,
            'message'   => 'Data tag berhasil ditampilkan!',
            'data'      => new TagsResource($tag),
        ], 200);
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
            'type'  => 'required|string',
            'name'  => 'required|string|unique:tags,id,' . $id
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'name.unique' => 'Nama sudah digunakan',
            'type.required' => 'Tipe tidak boleh kosong',
        ]);

        if ($data->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $data->getMessageBag()->toArray()
            ]);
        }

        $tag = Tag::findOrFail($id);
        $tag->update([
            'type'  => $request->type,
            'name'  => $request->name,
        ]);

        return response()->json([
            'success'   => true,
            'message'   => 'Data tag berhasil diubah!',
            'data'      => new TagsResource($tag),
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
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return [
            'success'   => true,
            'message'   => 'Data tag berhasil dihapus',
        ];
    }
}
