<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeamResource;
use App\Models\Team;
use App\Models\TeamCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TeamCategory::all();

        if (request()->ajax()) {
            $dataTeam    = Team::with('getTeam')->latest()->get();
            return DataTables::of($dataTeam)
                ->addColumn('getTeam', function($data) {
                    return $data->getTeam->name;
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('pages.teams.index',[
            'data'  => $data
        ])->with('teams');
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
            'category_team_id'  => 'required',
            'name'              => 'required|string|max:50|unique:teams',
            'image'             => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'position'          => 'required|string|max:50',
        ], [
            'name.required'     => 'Nama tidak boleh kosong',
            'name.unique'       => 'Nama sudah digunakan',
            'category_team_id.required'  => 'Kategori tim tidak boleh kosong',
            'image.required'    => 'Gambar tidak boleh kosong',
            'position.required' => 'Posisi tidak boleh kosong',
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
            $fileNameWithExt   = $image->getClientOriginalName();
            $fileName          = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $ext               = $image->getClientOriginalExtension();
            $fileNameSave      = Str::uuid();
            $path              = $image->storeAs('public/teams', $fileNameSave);

        }

        $team = Team::create([
            'name'              => $request->name,
            'category_team_id'  => $request->category_team_id,
            'image'             => $fileNameSave,
            'position'          => $request->position,
        ]);

        return [
            'success'   => true,
            'message'   => 'Data team berhasil ditambahkan!',
            'data'      => new TeamResource($team),
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
        $team = Team::findOrFail($id);

        return response()->json([
            'success'   => true,
            'message'   => 'Data team berhasil ditampilkan!',
            'data'      => new TeamResource($team),
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
            'category_team_id'  => 'required',
            'name'              => 'required|string|max:50|unique:teams,id,'. $id,
            'image'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'position'          => 'required|string|max:50',
        ],[
            'name.required'     => 'Nama tidak boleh kosong',
            'name.unique'       => 'Nama sudah digunakan',
            'category_team_id.required'  => 'Kategori tim tidak boleh kosong',
            'position.required' => 'Posisi tidak boleh kosong',
        ]);

        if($data->fails())
        {
            return response()->json([
                'status'    => false,
                'errors'    => $data->getMessageBag()->toArray(),
            ]);
        }

        $team = Team::findOrFail($id);

        if($request->hasFile('image') && $request->file('image') != null)
        {
            Storage::delete('public/teams/'.$team->image);
            
            $fileNameWithExt   = $request->file('image')->getClientOriginalName();
            $fileName          = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $ext               = $request->file('image')->getClientOriginalExtension();
            $fileNameSave      = Str::uuid();
            $path               = $request->file('image')->storeAs('public/teams', $fileNameSave);
        }
        
        $team->update([
            'name'              => $request->name,
            'category_team_id'  => $request->category_team_id,
            'image'             => $fileNameSave ?? $team->image,
            'position'          => $request->position,
        ]);

        return [
            'success'   => true,
            'message'   => 'Data team berhasil diubah!',
            'data'      => new TeamResource($team),
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
        $team = Team::findOrFail($id);
        Storage::delete('public/teams/'.$team->image);

        $team->delete();

        return [
            'success'       => true,
            'message'       => 'Data team berhasil dihapus!',
        ];
    }
}
