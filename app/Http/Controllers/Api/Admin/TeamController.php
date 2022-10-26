<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeamResource;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataTeam = Team::with('getTeam')->latest()->paginate(10);

        return response()->json([
            'success'   => true,
            'message'   => 'Data team berhasil ditampilkan!',
            'data'      => TeamResource::collection($dataTeam),
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
            'name'                  => 'required|string|max:50|unique',
            'category_team_id'      => 'required|exist:team_categories',
            'image'                 => 'required|image|mime:jpg,jpeg,png|max:2048',
            'position'              => 'required|string|max:50',
        ]);

        if($image = $request->file('image'))
        {
            $path           = 'team/';
            $teamImage      = $image->getClientOriginalName();
            $image->move($path, $teamImage);
            $data['image']  = $teamImage;
        }

        $team = Team::create([
            'name'              => $request->name,
            'category_team_id'  => $request->category_team_id,
            'image'             => $request->image,
            'position'          => $request->position,
        ]);

        return response()->json([
            'success'   => true,
            'message'   => 'Data team berhasil ditambahkan!',
            'data'      => new TeamResource($team),
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
        $request->validate([
            'name'                  => 'required|string|max:50|unique',
            'category_team_id'      => 'required|exist:team_categories',
            'image'                 => 'required|image|mime:jpg,jpeg,png|max:2048',
            'position'              => 'required|string|max:50',
        ]);

        $team = Team::findOrFail($id);

        if($request->hasFile('image') && $request->file('image') != null)
        {
            $imagePath = public_path().'/team/'.$team->image;
            if(File::exists($imagePath))
            {
                unlink($imagePath);
            }

            $image      = $request->file('image');
            $path       = 'team/';
            $teamImage  = $image->getClientOriginalName();
            $image->move($path, $teamImage);
            $data['image']  = $teamImage;
        }

        $team->update([
            'name'              => $request->name,
            'category_team_id'  => $request->category_team_id,
            'image'             => $request->image,
            'position'          => $request->position,
        ]);

        return response()->json([
            'success'   => true,
            'message'   => 'Data team berhasil diubah!',
            'data'      => new TeamResource($team),
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
        $team = Team::findOrFail($id);
        $path = public_path().'/team/'.$team->image;
        unlink($path);

        $team->delete();

        return response()->json([
            'success'       => true,
            'message'       => 'Data team berhasil dihapus!',
        ], 200);
    }
}
