<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryBlogResource;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CategoryBlogController extends Controller
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
            $dataCatBlog = BlogCategory::latest()->get();
            return DataTables::of($dataCatBlog)
                ->addIndexColumn()
                ->make(true);
        }

        return view('pages.category-blogs.index')->with('category-blogs');
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
        $data = Validator::make($request->all(),[
            'name'  => 'required|string|unique:blog_categories'
        ],[
            'name.required' => 'Nama tidak boleh kosong!',
            'name.unique'   => 'Nama sudah digunakan!'
        ]);

        if($data->fails())
        {
            return response()->json([
                'status'    => false,
                'errors'    => $data->getMessageBag()->toArray()
            ]);
        }

        $dataCatBlog = BlogCategory::create([
            'name'  => $request->name,
        ]);

        return [
            'success'   => true,
            'message'   => 'Data kategori blog berhasil ditambahkan!',
            'data'      => new CategoryBlogController($dataCatBlog),
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
        $data = Validator::make($request->all(),[
            'name'  => 'required|string|unique:blog_categories,id,'. $id
        ],[
            'name.required' => 'Nama tidak boleh kosong!',
            'name.unique'   => 'Nama sudah digunakan!'
        ]);

        if($data->fails())
        {
            return response()->json([
                'status'    => false,
                'errors'    => $data->getMessageBag()->toArray()
            ]);
        }

        $dataCatBlog = BlogCategory::findOrFail($id);
        $dataCatBlog->update([
            'name'  => $request->name,
        ]);

        return [
            'success'   => true,
            'message'   => 'Data kategori blog berhasil diubah!',
            'data'      => new CategoryBlogResource($dataCatBlog)
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
        $dataCatBlog = BlogCategory::findOrFail($id);
        $dataCatBlog->delete();

        return [
            'success'   => true,
            'message'   => 'Data kategori blog berhasil dihapus!'
        ];
    }
}
