<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryTeamResource;
use App\Models\TeamCategory;
use Illuminate\Http\Request;

class CategoryTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataCategoryTeam = TeamCategory::latest()->paginate(10);

        return response()->json([
            'success'   => true,
            'message'   => 'Data kategori team berhasil ditampilkan',
            'data'      => CategoryTeamResource::collection($dataCategoryTeam),
        ], 200);
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
            'name'  => 'required|string|max:50',
        ]);

        $dataCategoryTeam = TeamCategory::create([
            'name'  => $request->name,
        ]);

        return response()->json([
            'success'   => true,
            'message'   => 'Data kategori team berhasil ditambah!',
            'data'      => new CategoryTeamResource($dataCategoryTeam),
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
        $dataCategoryTeam = TeamCategory::findOrFail($id);

        return response()->json([
            'success'   => true,
            'message'   => 'Data kategori team berhasil ditampilkan!',
            'data'      => new CategoryTeamResource($dataCategoryTeam),
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
            'name'  => 'required|string|max:50',
        ]);

        $categoryTeam = TeamCategory::findOrFail($id);

        $categoryTeam->update([
            'name'  => $request->name,
        ]);

        return response()->json([
            'success'   => true,
            'message'   => 'Data kategori team berhasil diubah!',
            'data'      => new CategoryTeamResource($categoryTeam),
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
        $categoryTeam = TeamCategory::findOrFail($id);

        $categoryTeam->delete();

        return response()->json([
            'success'   => true,
            'message'   => 'Data kategori team berhasil di hapus!',
        ], 200);
    }
}
