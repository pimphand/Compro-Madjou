<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagsResource;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dataTag    = Tag::latest()->paginate(10);

        return view('pages.tags.index')->with('tags', $dataTag);
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
        $request->validate([
            'type'  => 'required|string',
            'name'  => 'required|string|unique:tags'
        ]);

        if ($data->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $data->getMessageBag()->toArray()
            ]);
        }

        if($data->fails())
        {
            return response()->json([
                'status'    => false,
                'errors'    => $data->getMessageBag()->toArray()
            ]);
        }

        $tag    = Tag::create([
            'type'      => $request->type,
            'name'      => $request->name,
        ]);

        $request->session()->flash('message' , 'Data tag berhasil ditambahkan!');

        return response()->json([
            'success'   => true,
            'message'   => 'Data tag berhasil ditambahkan',
            'data'      => new TagsResource($tag)
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
        $request->validate([
            'type'  => 'required|string',
            'name'  => 'required|string|unique'
        ]);

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

        return response()->json([
            'success'   => true,
            'message'   => 'Data tag berhasil dihapus',
        ], 200);
    }
}
