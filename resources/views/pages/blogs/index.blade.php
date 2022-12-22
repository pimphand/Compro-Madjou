@extends('layouts.app')

@section('title', 'Madjou | Blogs')
@section('content')
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
                        <button type="button" class="btn btn-inverse-success"
                        data-bs-target="#tagEditorModal" data-bs-toggle="modal" id='btn-add'>
                            <i data-feather="plus"></i>
                            Tambah Data
                        </button>
                    </div>
                    
                    <div class="mb-3">
                        <label for="search" class="form-label">Cari : </label>
                        <input type="text" class="form-control" id="search" name="search">
                    </div>

                    {{-- card list --}}
                    <div class="row row-cols-2 row-cols-md-3 g-4 show-datas">
        
                    </div>


                    {{-- modal store / edit --}}
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
                                            <label for="blog_category_id" class="form-label">Kategori blog </label>
                                            <select name="blog_category_id" id="blog_category_id" class="form-control" value="">
                                                <option value="" disabled selected>Pilih kategori</option>
                                                @foreach ($category as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="text-danger" id="error-category_blog"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Judul </label>
                                            <input type="text" class="form-control" id="titles" name="title"
                                                placeholder="Masukkan judul blog...">
                                            <div class="text-danger" id="error-title"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="body" class="form-label">Konten </label>
                                            <textarea class="form-control" id="body" name="body"
                                                placeholder="Masukkan konten blog..." value=""></textarea>
                                                <input type="hidden" name="body" class="body">
                                            <div class="text-danger" id="error-body"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tags" class="form-label">Tags </label>
                                            <select name="tags[]" id="tags" class="form-control" multiple="">
                                                <option value="" disabled selected>Selected tags</option>
                                                @foreach ($tag as $tag)
                                                <option value="{{$tag->name}}">{{$tag->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="text-danger" id="error-title"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="lang" class="form-label">Bahasa </label>
                                            <select name="lang" id="lang" class="form-control">
                                                <option value="" disabled selected>Pilih bahasa</option>
                                                <option value="id">Indonesia</option>
                                                <option value="en">English</option>
                                            </select>
                                            <div class="text-danger" id="error-lang"></div>
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
                                    <button type="button" class="btn btn-inverse-primary" id="btn-sv"
                                        value="add">Simpan data</button>
                                    <input type="hidden" id="blog_id" name="id" value="">
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Modal view -->
                    <div class="modal fade bd-example-modal-xl" id="viewModal" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="varyingModalLabel">
                                        <span id="titleBlog"></span>
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="btn-close"></button>
                                </div>
                                <div class="modal-body d-flex align-items-start">
                                    <div id="imageBlog"></div>
                                    <p id="bodyBlog"></p>
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
    

    @push('js')
    <script src="https://cdn.tiny.cloud/1/wwx0cl8afxdfv85dxbyv3dy0qaovbhaggsxpfqigxlxw8pjx/tinymce/6/tinymce.min.js"
    referrerpolicy="origin"></script>
    <script>
       $(document).ready(function() {
        let showData;
            
        $('#btn-add').click(function (e) { 
                e.preventDefault();
                $("#title").html("Tambah data kategori blog");
                $("#btn-sv").val("add");
                $("#put").html("");
                $("#modalFormData").trigger("reset");
                $("#tagEditorModal").modal("show");
                $("#modalFormData").attr('action', "{{ route('blogs.store') }}");
                console.log('click')
        });
        
        $('.modal-form #btn-sv').on('click', function () {
            var form = $('#modalFormData')[0];
            var formData = new FormData(form);
            $.ajax({
                url: form.action,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                if (data.success == true) {
                        // sweetalert
                        $('.modal-form').modal('hide');
                        Swal.fire({
                            title: 'Berhasil',
                            // text: data.message,
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        })
                        setInterval(() => {
                                    location.reload();
                                    
                                }, 2000);
                       
                    }else{
                        $.each(data.errors, function (key, value) {
                            //   show errors
                            console.log(key);
                            $('#' + key).addClass('is-invalid');
                            $('#' +'error-' + key ).html(value);
                            // hide error
                            $('#' + key).on('keyup', function () {
                                $('#' + key).removeClass('is-invalid');
                                $('#' +'error-' + key ).html('');
                            });
                        });
                    }
                }
            });
        })

        // search data
        $('#search').on('keyup', function(){
            displayData(search);
        });
        displayData();

               

        function displayData() {
            $.ajax({
                // show data  on page reload
                type: "GET",
                url: "{{route('blogs.index')}}",
                dataype: 'json',
                data: {
                    search: $('#search').val(),
                },
                success: function (response) {
                    $('.show-datas').html('');
                        $.each(response.data, function (key, item) {
                             $('.show-datas').append(
                                        "<div class='col'>"+
                                        "<div class='card'>"+
                                            "<img src='{{url('storage/blogs')}}/"+item.image+"' class='card-img-top' height='200px' alt=''>"+
                                            "<div class='card-body'>"+
                                                    "<h5 class='card-title'>"+item.title+"</h5>"+
                                                        "<span class='badge bg-light text-dark'>"+item.tags+"</span>"+
                                                    "<p class='card-text mt-2 mb-2'>"+"</p>"+
                                                "<div class='btn-group btn-group-sm' role='group' aria-label='Basic example'>"+
                                                    "<button type='button' name='id' class='btn btn-primary btn-view' id='"+item.id+"' data-toggle='modal' data-target='#viewModal' value='"+item.id+"'>"+
                                                        "View blogs"+
                                                    "</button>"+
                                                    "<button type='button' name='id' class='btn btn-secondary btn-edit' id='"+item.id+"' data-toggle='modal' value='"+item.id+"'>"+
                                                        "Edit blogs"+
                                                    "</button>"+
                                                    "<button type='button' name='id' class='btn btn-danger btn-remove' id='"+item.id+"' data-toggle='modal' data-target='#viewModal' value='"+item.id+"'>"+
                                                        "Delete blogs"+
                                                    "</button>"+
                                                "</div>"+
                                            "</div>"+
                                            "<div class='card-footer'>"+
                                                "<p class='card-text' style='font-size:10px;text-align:left;'>Publish : "
                                                    +item.created+
                                                "</p>"+
                                                "<p class='card-text' style='font-size:10px;text-align:left;'>Created by : "
                                                    +item.author.name+
                                                "</p>"+
                                            "</div>"+
                                        "</div>"+
                                        "</div>"
                                );
                            //    console.log(item.author.name)
                        });

                    }
                });
                
            }

            // show detail
            $('.show-datas').on('click', '.btn-view', function(){
                let id = $(this).attr('id');
                let url = "{{route('blogs.show',':id')}}";
                    url = url.replace(':id', id);
                $.ajax({
                    type: 'GET',
                    url:  url,
                    data:{
                        id:id
                    },
                    success: function(data){
                        $("#titleBlog").html(data.data.title);
                        $('#imageBlog').html("<img src='{{asset('storage/blogs')}}/"+data.data.image+"' class='align-self-start wd-100 wd-sm-150 me-3   '  alt=''>");
                        // $('#image').attr('src', '{{asset("storage/blogs")}}/,'+data.img);
                        $("#bodyBlog").html(data.data.body);
                        $('#viewModal').modal('show');
                    }
                });         
            });

            // edit blog
            function htmlDecode(input){
                var e = document.createElement('p');
                e.innerHTML = input;
                return e.childNodes.length === 0 ? "" : e.childNodes[0].nodeValue;
            }
             $('.show-datas').on('click', '.btn-edit', function(){
                 let id = $(this).attr('id');
                 let url = "{{route('blogs.update',':id')}}";
                 url = url.replace(':id', id);
                $('#tagEditorModal').modal('show');
                $.ajax({
                    type: 'GET',
                    url:  url,
                    data:{
                        id:id
                    },
                    success: function(data){
                        // $("#content").val(editorData);
                        $("#modalFormData").attr('action', url);
                        $("#title").html("Edit "+ data.data.title);
                        $("#put").html('<input type="hidden" name="_method" value="put">');
                        $("#blog_category_id").val(data.data.blog_category_id);
                        $("#titles").val(data.data.title);
                        var body = htmlDecode(data.data.body);
                        tinyMCE.activeEditor.setContent(data.data.body);
                        $("#tags").val(data.data.tags);
                        $('#lang').val(data.data.lang);
                        $('.error').empty();
                        $('#tagEditorModal').modal('show');
                        
                    }
                });        
                
            });

            //  delete blog

            $('.show-datas').on('click', '.btn-remove', function() {
                let id = $(this).attr('id');
                let url = "{{ route('blogs.destroy',':id') }}"
                    url = url.replace(':id', id);
                    $.ajax({
                    type: 'GET',
                    url:  url,
                    data:{
                        id:id
                    },
                    success: function(data){
                    Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data "+data.data.title+" akan terhapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya!',
                    cancelButtonText: 'Batal!'
                }).then((result) => {
                    if (result.value) {
                        $.post(url, {
                            _token:"{{ csrf_token() }}",
                            _method: 'delete'
                        }).done((res) => {
                            if (res.success == true) {
                                Swal.fire(
                                    data.data.title,
                                    'Data berhasil di hapus.',
                                    'success'
                                )
                                setInterval(() => {
                                    location.reload();
                                    
                                }, 2000);
                            } else {
                                swal({
                                    type: 'error',
                                    text: res.mssg
                                });
                            }
                        })
                    }
                })
                        
                    }
                });        

                
            })
});

    // text editor
    tinymce.init({
                selector: 'textarea',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace tablevisualblockswordcount',toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | linkimage media table | alignlineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                init_instance_callback: function(editor) {
                    editor.on('keyup', function(e) {
                        $(".body").val(editor.getContent())
                    });
                }
            });
</script>
@endpush








