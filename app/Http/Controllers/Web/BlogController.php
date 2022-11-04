<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category   = BlogCategory::all();
        $tag        = Tag::all();

        if(request()->ajax())
        {
            $dataBlog = Blog::with('getCategories', 'getTags')->latest()->get();
            return DataTables::of($dataBlog)
                    ->addColumn('getCategory', function($dataCat){
                        return $dataCat->getCategory->name;
                    })
                    ->addColumn('getTags', function($dataTag){
                        return $dataTag->getTags->name;
                    })
                    ->addIndexColumn()
                    ->make(true);
        }


        return view('pages.blogs.index',[
            'category'  => $category,
            'tag'       => $tag,
        ])->with('blogs');
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
            'blog_category_id'  => 'required|',
            'title'             => 'required|string|max:50',
            'slug'              => 'required|string|',
            'body'              => 'required|string|',
            'tags'              => 'required|',
            'author'            => 'required|string|',
            'image'             => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'blog_category_id.required'     => 'Kategori blog tidak boleh kosong!',
            'title.required'                => 'Judul tidak boleh kosong!',
            'slug.required'                 => 'Slug tidak boleh kosong!',
            'body.required'                 => 'Konten tidak boleh kosong!',
            'tags.required'                 => 'Tags tidak boleh kosong!',
            'author.required'               => 'Penulis tidak boleh kosong!',
            'image.required'                => 'Gambar tidak boleh kosong!',     
        ]);

        if($data->fails())
        {
            return response()->json([
                'status'        => false,
                'message'       => $data->getMessageBag()->toArray()
            ]);
        }

        if($image = $request->file('image'))
        {
            $path           = 'storage/blogs';
            $blogImage      = $image->getClientOriginalName();
            $image->move($path, $blogImage);
            $request->image  = $blogImage;
        }

        $dataBlog = Blog::create([
            'blog_category_id'      => $request->blog_category_id,
            'title'                 => $request->title,
            'slug'                  => $request->slug,
            'body'                  => $request->body,
            'tags'                  => $request->tags,
            'author'                => $request->author,
            'image'                 => $blogImage,
        ]);

        return [
            'success'   => true,
            'message'   => 'Data blog berhasil disimpan!',
            'data'      => new BlogResource($dataBlog)
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
