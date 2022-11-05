@section('title', 'Madjou | Tags')
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
                            <h4 class="card-title">Data blog</h4>
                            <button type="button" class="btn btn-inverse-success" data-bs-toggle="modal" id='btn-add'>
                                <i data-feather="plus"></i>
                                Add Data
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table data-url="{{ request()->url() }}" class="table-data table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Category Blog</th>
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th>Body</th>
                                        <th>Tags</th>
                                        <th>Author</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
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
                                                <label for="category_blog" class="form-label">Category blog </label>
                                                <select name="blog_category_id" id="blog_category_id" class="form-control">
                                                    <option value="" disabled selected>Select category</option>

                                                    @foreach ($category as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="text-danger" id="error-category_blog"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Title </label>
                                                <input type="text" class="form-control" id="title" name="title"
                                                    placeholder="Input title blog..." value="">
                                                <div class="text-danger" id="error-title"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="slug" class="form-label">Slug </label>
                                                <input type="text" class="form-control" id="slug" name="slug"
                                                    placeholder="Input slug blog..." value="">
                                                <div class="text-danger" id="error-slug"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="body" class="form-label">Content </label>
                                                <textarea class="form-control" id="body" name="body"
                                                    placeholder="Input konten blog..." value="">
                                                </textarea>
                                                <div class="text-danger" id="error-body"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tags" class="form-label">Tags </label>
                                                <select name="tags" id="tags" class="form-control" multiple="">
                                                    <option value="" disabled selected>Selected tags</option>
                                                    @foreach ($tag as $tag)
                                                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="text-danger" id="error-title"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="author" class="form-label">Author </label>
                                                <input type="text" class="form-control" id="author" name="author"
                                                    placeholder="Input author blog..." value="">
                                                <div class="text-danger" id="error-author"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Image </label>
                                                <input type="file" class="form-control" id="image" name="image"
                                                    value="">
                                                <div class="text-danger" id="error-image"></div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-inverse-primary" id="btn-save"
                                            value="add">Simpan data</button>
                                        <input type="hidden" id="tag_id" name="id" value="0">
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
        let showData;
        $(() => {
            $('#btn-add').click(function (e) { 
                e.preventDefault();
                $("#title").html("Add data blog");
                $("#btn-save").val("add");
                $("#put").html("");
                $("#modalFormData").trigger("reset");
                $("#tagEditorModal").modal("show");
                $("#modalFormData").attr('action', "{{ route('blogs.store') }}");
            });
            // datatable
            showData = $('.table-data').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: $('.table-data').data('url'),
                order: [
                    [1, 'DESC'],
                ],
                columnDefs: [{
                        orderable: false,
                        searchable: false,
                        targets: [0, 8],
                        className: 'text-center'
                    },
                    {
                        visible: false,
                        targets: []
                    },
                    {
                        className: 'w-5 pr-0',
                        targets: [1, 2]
                    }
                ],
                columns: [{
                    name: 'DT_RowIndex',
                    data: 'DT_RowIndex',
                    render: (DT_RowIndex) => {
                        return DT_RowIndex + '.';
                    }
                }, {
                    data: 'getCategory',
                    name: 'getCategory',
                }, {
                    data: 'title',
                    name: 'title',
                }, {
                    data: 'slug',
                    name: 'slug',
                }, {
                    data: 'body',
                    name: 'body',
                }, {
                    data: 'getTags',
                    name: 'getTags',
                }, {
                    data: 'author',
                    name: 'author',
                }, {
                    data: 'image',
                    name: 'image',
                }, {
                    data: 'id',
                    name: 'id',
                    render: (id, type, row) => {
                        const button_edit = $('<button>', {
                            html: $('<i>', {
                                class: 'fa fa-pencil'
                            }).prop('outerHTML'),
                            class: 'btn btn-secondary btn-edit',
                            'data-id': id,
                            title: `Edit Data`,
                        })
                        const button_delete = $('<button>', {
                            html: $('<i>', {
                                class: 'fa fa-trash'
                            }).prop('outerHTML'),
                            class: 'btn btn-danger btn-remove',
                            'data-id': id,
                            title: `Hapus Data`,
                        })
                        const button_group = $('<div>', {
                            class: 'btn-group btn-group-sm',
                            role: 'group',
                            html: () => {
                                return [button_edit, button_delete]
                            }
                        })
                        return button_group.prop('outerHTML')
                    }
                }]
            })
            // edit
            $('.table-data').on('click', '.btn-edit', function() {
                let row = showData.row($(this).closest('tr')).data();
                let url = "{{ route('tags.update',':id') }}"
                    url = url.replace(':id', row.id);
                $("#modalFormData").attr('action', url);
                $("#title").html("Edit "+ row.name);
                $("#put").html('<input type="hidden" name="_method" value="put">');
                $("#type").val(row.type);
                $("#name").val(row.name);
                $('.error').empty();
                $('#tagEditorModal').modal('show');
            })
            // Delete
            $('.table-data').on('click', '.btn-remove', function() {
                let row = showData.row($(this).closest('tr')).data();
                let url = "{{ route('tags.destroy',':id') }}"
                    url = url.replace(':id', row.id);
                
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data "+row.name+" akan terhapus!",
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
                                    row.name,
                                    'Data berhasil di hapus.',
                                    'success'
                                )
                                showData.ajax.reload();
                            } else {
                                swal({
                                    type: 'error',
                                    text: res.mssg
                                });
                            }
                        })
                    }
                })
            })
        })
    </script>
    @endpush
</x-app-layout>