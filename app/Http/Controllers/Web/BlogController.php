<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category   = BlogCategory::all();
        $tag        = Tag::all();
        
        if(request()->ajax())
        {
            $data = Blog::with('getCategories', 'getUsers')
                    ->where('title','like','%'.substr($request->search, 2).'%')
                    ->latest()->paginate(10);
            return response()->json([
                'success'   => true,
                'message'   => 'Data blog berhasil ditampilkan',
                'data'      => BlogResource::collection($data),
            ]);
        }

        return view('pages.blogs.index',[
            'category'  => $category,
            'tag'       => $tag
        ]);
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
            'body'              => 'required|string|',
            'image'             => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'lang'              => 'required'
        ], [
            'blog_category_id.required'     => 'Kategori blog tidak boleh kosong!',
            'title.required'                => 'Judul tidak boleh kosong!',
            'body.required'                 => 'Konten tidak boleh kosong!',
            'image.required'                => 'Gambar tidak boleh kosong!',
            'lang.required'                 => 'Bahasa tidak boleh kosong!',     
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
            $fileNameWithExt   = $image->getClientOriginalName();
            $fileName          = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $ext               = $image->getClientOriginalExtension();
            $fileNameSave      = Str::uuid();
            $path              = $image->storeAs('public/blogs', $fileNameSave);  
        }

        $dataBlog = Blog::create([
            'blog_category_id'      => $request->blog_category_id,
            'title'                 => $request->title,
            'slug'                  => Str::slug($request->title),
            'body'                  => $request->body,
            'tags'                  => $request->tags,
            'author'                => Auth::user()->id,
            'image'                 => $fileNameSave,
            'lang'                  => $request->lang,
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
        $blog = Blog::findOrFail($id);

        return response()->json([
            'success'   => true,
            'message'   => 'Data blog berhasil ditampilkan',
            'data'      => new BlogResource($blog)
        ]);
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
            'blog_category_id'  => 'required|',
            'title'             => 'required|string|max:50',
            'body'              => 'required|string|',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'lang'              => 'required',
        ], [
            'blog_category_id.required'     => 'Kategori blog tidak boleh kosong!',
            'title.required'                => 'Judul tidak boleh kosong!',
            'body.required'                 => 'Konten tidak boleh kosong!',
            'image.required'                => 'Gambar tidak boleh kosong!',
            'lang.required'                 => 'Bahasa tidak boleh kosong!',     
        ]);

        if($data->fails())
        {
            return response()->json([
                'status'        => false,
                'message'       => $data->getMessageBag()->toArray()
            ]);
        }

        $blog    = Blog::findOrFail($id);

        if($request->hasFile('image') && $request->file('image') != null)
        {
            Storage::delete('public/blogs/'.$blog->image);
            

            $fileNameWithExt    = $request->file('image')->getClientOriginalName();
            $fileName           = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $ext                = $request->file('image')->getClientOriginalExtension();
            $fileNameSave       = Str::uuid();
            $path               = $request->file('image')->storeAs('public/service', $fileNameSave);
        }

        $blog->update([
            'blog_category_id'      => $blog->blog_category_id ?? $request->blog_category_id,
            'title'                 => $request->title,
            'slug'                  => Str::slug($request->title),
            'body'                  => $request->body,
            'tags'                  => $request->tags,
            'author'                => Auth::user()->id,
            'image'                 => $fileNameSave ?? $blog->image,
            'lang'                  => $request->lang,
        ]);

        return [
            'success'   => true,
            'message'   => 'Data blog berhasil diubah',
            'data'      => new BlogResource($blog)
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
        $blog    = Blog::findOrFail($id);
        Storage::delete('public/blog/'.$blog->image);
        $blog->delete();

        return [
            'success'   => true,
            'message'   => 'Data blog berhasil dihapus!',
        ];
    }
}
