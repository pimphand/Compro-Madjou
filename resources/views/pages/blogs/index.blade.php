@section('title', 'Madjou | Blogs')
<x-app-layout>
    <div class="page-content">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                @if( Session::has("success") )
                <div class="alert alert-success alert-block" role="alert">
                    <button class="close" data-dismiss="alert"></button>
                    {{ Session::get("success") }}
                </div>
                @endif
                @if( Session::has("error") )
                <div class="alert alert-danger alert-block" role="alert">
                    <button class="close" data-dismiss="alert"></button>
                    {{ Session::get("error") }}
                </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h4 class="card-title">Tabel data blog</h4>
                            <button type="button" class="btn btn-inverse-success" data-bs-toggle="modal" id='btn-add'>
                                <i data-feather="plus"></i>
                                Tambah Data
                            </button>
                        </div>
                        
                        <div class="mb-3">
                            <label for="search" class="form-label">Cari : </label>
                            <input type="text" class="form-control" id="search" name="search"></input>
                        </div>

                        {{-- card list --}}
                        <div class="row row-cols-2 row-cols-md-4 g-4 show-data">
                            
                        </div>


                        {{-- modal --}}
                        <div class="modal fade modal-form" id="tagEditorModal" tabindex="-1"
                            aria-labelledby="varyingModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="varyingModalLabel">
                                            <span id="title"></span>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="btn-close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="modalFormData" name="modalFormData" class="form-horizontal"
                                            novalidate="">
                                            @csrf
                                            <div id="put"></div>
                                            <div class="mb-3">
                                                <label for="category_blog" class="form-label">Kategori blog </label>
                                                <select name="blog_category_id" id="blog_category_id" class="form-control">
                                                    <option value="" disabled selected>Pilih kategori</option>

                                                    @foreach ($category as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="text-danger" id="error-category_blog"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Judul </label>
                                                <input type="text" class="form-control" id="title" name="title"
                                                    placeholder="Masukkan judul blog..." value="">
                                                <div class="text-danger" id="error-title"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="body" class="form-label">Konten </label>
                                                <textarea class="form-control" id="body" name="body"
                                                    placeholder="Masukkan konten blog..." value="">
                                                </textarea>
                                                <div class="text-danger" id="error-body"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tags" class="form-label">Tags </label>
                                                <select name="tags" id="tags" class="form-control" multiple="">
                                                    <option value="" disabled selected>Selected tags</option>
                                                    @foreach ($tag as $tag)
                                                    <option value="{{$tag->name}}">{{$tag->name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="text-danger" id="error-title"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Gambar </label>
                                                <input type="file" class="form-control" id="image" name="image"
                                                    value="">
                                                <div class="text-danger" id="error-image"></div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-inverse-primary" id="btn-save"
                                            value="add">Simpan data</button>
                                        <input type="hidden" id="blog_id" name="id" value="0">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <script>
       $(document).ready(function() {
          // clear button
                $('#search').on('keyup', function(){
                    showData().val('#search');
                });
                showData();
        function showData() {
            $.ajax({
                // show data  on page reload
                type: "GET",
                url: "{{route('blogs.index')}}",
                data: {
                    'search': $('#search').val(),
                },
                success: function (response) {
                    $('.show-data').html();
                    $.each(response.data, function (key, item) {
                      $('.show-data').append(
                                    "<div class='col'>"+
                                      "<div class='card'>"+
                                        "<img src='{{asset('storage/blogs')}}/"+item.image+"' class='card-img-top' alt=''>"+
                                        "<div class='card-body'>"+
                                          "<h5 class='card-title'>"+item.title+"</h5>"+
                                          "<p class='card-text'>"+item.body+"</p>"+
                                        "</div>"+
                                      "</div>"+
                                    "</div>"
                                );
                  });
              }
            });
        }
    });

    </script>
    @endpush
</x-app-layout>