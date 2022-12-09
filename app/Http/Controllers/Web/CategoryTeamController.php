<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryTeamResource;
use App\Models\TeamCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class CategoryTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) 
        {
            $dataCatTeam    = TeamCategory::latest()->get();
            return DataTables::of($dataCatTeam)
                ->addIndexColumn()
                ->make(true);
        }
        return view('pages.category-teams.index')->with('category-teams');
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
        $data   = Validator::make($request->all(),[
            'name'  => 'required|max:50',
            'lang'  => 'required',
        ],[
            'name.required' => 'Nama tidak boleh kosong!',
            'name.max'      => 'Nama terlalu panjang!',
            'lang.required' => 'Bahasa tidak boleh kosong!',
        ]);

        if($data->fails())
        {
            return response()->json([
                'status'    => false,
                'errors'    => $data->getMessageBag()->toArray()
            ]);
        }

        
        $dataCategoryTeam = TeamCategory::create([
            'name'  => $request->name,
            'lang'  => $request->lang,
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
        $data   = Validator::make($request->all(),[
            'name'  => 'required|max:50',
            'lang'  => 'required',
        ],[
            'name.required' => 'Nama tidak boleh kosong!',
            'name.max'      => 'Nama terlalu panjang!',
            'lang.required' => 'Bahasa tidak boleh kosong!',
        ]);

        if($data->fails())
        {
            return response()->json([
                'status'    => false,
                'errors'    => $data->getMessageBag()->toArray()
            ]);
        }


        $categoryTeam = TeamCategory::findOrFail($id);

        $categoryTeam->update([
            'name'  => $request->name,
            'lang'  => $request->lang,
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
