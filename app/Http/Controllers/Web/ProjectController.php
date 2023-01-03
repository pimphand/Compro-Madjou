<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Madjou\Product;
use App\Models\ProgramingLanguage;
use App\Models\Project;
use App\Models\ProjectType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projectType = ProjectType::all();
        $programming = ProgramingLanguage::all();

        if (request()->ajax()) {
            $dataProject    = Project::latest()->get();

            return DataTables::of($dataProject)
                ->addColumn('getType', function ($type) {
                    return $type->getType->name;
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('pages.projects.index', [
            'projectType'   => $projectType,
            'programming'   => $programming, 
        ])->with('projects');
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
        $data   = Validator::make($request->all(), [
            'title'             => 'required',
            // 'programing'       => 'required',
            'body'              => 'required',
            'url'               => 'required',
            'location'          => 'required',
            'image'             => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'lang'              => 'required',
            'logo'              => 'nullable',
            'years'             => 'required',
            'client_about'      => 'required',
        ], [
            'title.required'    => 'Judul tidak boleh kosong!',
            // 'programing.required'  => 'Programming tidak boleh kosong!',
            'body.required'         => 'Konten tidak boleh kosong!',
            'url.required'          => 'Alamat url tidak boleh kosong!',
            'location.requried'     => 'Alamat lokasi tidak boleh kosong!',
            'image.required'        => 'Gambar tidak boleh kosong!',
            'lang.required'         => 'Bahasa tidak boleh kosong!',
            'years.required'        => 'Tahun tidak boleh kosong!',
            'client_about.required'        => 'Tentang client tidak boleh kosong!',
        ]);

        if ($data->fails()) {
            return response()->json([
                'status'    => false,
                'errors'    => $data->getMessageBag()->toArray(),
            ]);
        }

        if ($image = $request->file('image')) {
            $fileNameSave      = Str::uuid();
            $image->storeAs('public/project', $fileNameSave);
        }
        if ($logo = $request->file('logo')) {
            $logoName      = Str::uuid();
            $logo->storeAs('public/project-logo', $logoName);
        }

        try {
            DB::beginTransaction();
            $project = Project::create([
                'project_type_id'   => $request->project_type_id,
                'title'             => $request->title,
                'slug'              => Str::slug($request->title),
                'programing'        => $request->programing,
                'body'              => $request->body,
                'url'               => $request->url,
                'location'          => $request->location,
                'image'             => $fileNameSave,
                'logo'              => $logoName ?? null,
                'lang'              => $request->lang,
                'years'             => $request->years,
                'client_about'      => $request->client_about ?? " ",
            ]);

            if ($request->gallery) {
                foreach ($request->gallery as $key => $value) {
                    $fileNameSave      = Str::uuid();
                    $value->storeAs('public/project-gallery', $fileNameSave);
                    $project->gallery()->create([
                        'image' => $fileNameSave
                    ]);
                }
            }

            if ($request->development) {
                foreach ($request->development as $key => $dev) {
                    $project->development()->create([
                        'title' => $dev
                    ]);
                }
            }

            Product::create([
                "name" => $request->title,
                "image" => $fileNameSave,
                "price" => $request->price,
                "url" => "",
                "key" => Hash::make($request->title),
            ]);
            DB::commit();

            return [
                'success'   => true,
                'message'   => 'Data projek berhasil disimpan',
                'data'      => new ProjectResource($project),
            ];
        } catch (\Throwable $th) {
            return [
                'success'   => false,
                'message'   => 'Data projek gagal disimpan',
                'error'   => $th->getMessage(),
            ];
        }
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
        $data   = Validator::make($request->all(), [
            'title'             => 'required',
            'programing'       => 'required',
            'body'              => 'required',
            'url'               => 'required',
            'location'          => 'required',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'client_about'      => 'required',
            'logo'              => 'nullable',
            'lang'              => 'required',
            'years'             => 'required',
        ], [
            'title.required'    => 'Judul tidak boleh kosong!',
            'programing.required'  => 'Programming tidak boleh kosong!',
            'body.required'         => 'Konten tidak boleh kosong!',
            'url.required'          => 'Alamat url tidak boleh kosong!',
            'image.requrired'       => 'Gambar tidak boleh kosong!',
            'location.requried'              => 'Alamat lokasi tidak boleh kosong!',
            'years.required'        => 'Tahun tidak boleh kosong!',
        ]);

        if ($data->fails()) {
            return response()->json([
                'status'    => false,
                'errors'    => $data->getMessageBag()->toArray(),
            ]);
        }

        if ($image = $request->file('image')) {
            $fileNameWithExt   = $image->getClientOriginalName();
            $fileName          = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $ext               = $image->getClientOriginalExtension();
            $fileNameSave      = Str::uuid();
            $path              = $image->storeAs('public/project', $fileNameSave);
        }

        if ($logo = $request->file('logo')) {
            $logoName      = Str::uuid();
            $logo->storeAs('public/project-logo', $logoName);
        }

        $project = Project::findOrFail($id);

        $project->update([
            'project_type_id'   => $request->project_type_id,
            'title'         => $request->title,
            'slug'          => Str::slug($request->title),
            'programing'    => $request->programing,
            'body'          => $request->body,
            'image'         => $fileNameSave ?? $project->image,
            'url'           => $request->url,
            'location'      => $request->location,
            'lang'          => $request->lang,
            'logo'              => $logoName ?? $project->logo,
            'years'             => $request->years,
            'client_about'      => $request->client ?? " ",
        ]);

        return [
            'success'   => true,
            'message'   => 'Data projek berhasil diubah',
            'data'      => new ProjectResource($project),
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
        $project = Project::findOrFail($id);
        $project->delete();

        return [
            'success'   => true,
            'message'   => 'Data projek berhasil dihapus',
        ];
    }
}
