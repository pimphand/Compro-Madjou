@extends('layouts.app')
@section('title', 'Madjou | Projek')
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
                    <h4 class="card-title">Tabel data projek</h4>
                    <button type="button" class="btn btn-inverse-success" data-bs-toggle="modal"
                        data-bs-target="#tagEditorModal" id='btn-add'>
                        <i data-feather="plus"></i>
                        Tambah Data
                    </button>
                </div>
                <div class="table-responsive">
                    <table data-url="{{ request()->url() }}" class="table-data table" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis projek</th>
                                <th>Pemrograman</th>
                                <th>Judul</th>
                                <th>Konten</th>
                                <th>Alamat url</th>
                                <th>Lokasi</th>
                                <th>Bahasa</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

                {{-- modal --}}

                <div class="modal fade modal-form" id="tagEditorModal" tabindex="-1" aria-labelledby="varyingModalLabel"
                    aria-hidden="true">
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
                                <form id="modalFormData" name="modalFormData" enctype="multipart/form-data"
                                    class="form-horizontal" novalidate="">
                                    @csrf
                                    <div id="put"></div>
                                    <div class="mb-3">
                                        <label for="project_type" class="form-label">Jenis projek </label>
                                        <select name="project_type_id" id="project_type_id" class="form-control">
                                            <option value="" selected disabled>Pilih jenis projek</option>

                                            @foreach ($projectType as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="text-danger" id="error-project_type_id"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="titles" class="form-label">Judul </label>
                                        <input type="text" class="form-control" id="titles" name="title"
                                            placeholder="Masukkan judul projek..." value="">
                                        <div class="text-danger" id="error-title"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Harga subscribe </label>
                                        <input type="text" class="form-control" id="price" name="price"
                                            placeholder="Masukkan subscribe..." value="">
                                        <div class="text-danger" id="error-price"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="programing" class="form-label">Pemrograman </label>
                                        <input type="text" class="form-control" id="programings" name="programing"
                                            placeholder="Masukkan jenis pemrograman projek..." value="">
                                        <div class="text-danger" id="error-programing"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="body" class="form-label">Konten </label>
                                        <textarea type="text" class="form-control" id="body"
                                            placeholder="Masukkan konten project..."></textarea>
                                        <input type="hidden" name="body" class="body">
                                        <div class="text-danger" id="error-body"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="url" class="form-label">Alamat url </label>
                                        <input type="text" class="form-control" id="url" name="url"
                                            placeholder="Masukkan alamat projek ..." value="">
                                        <div class="text-danger" id="error-url"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="location" class="form-label">Lokasi </label>
                                        <input type="text" class="form-control" id="location" name="location"
                                            placeholder="Masukkan lokasi projek..." value="">
                                        <div class="text-danger" id="error-location"></div>
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
                                        <label for="image" class="form-label">Gambar </label>
                                        <input type="file" class="form-control" id="image" name="image"
                                            placeholder="Masukkan gambar..." value="">
                                        <div class="text-danger" id="error-image"></div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-inverse-primary" id="btn-save" value="add">Simpan
                                    data</button>
                                <input type="hidden" id="project_id" name="id" value="0">
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
    let showData;
        $(() => {
            $('#btn-add').click(function (e) { 
                e.preventDefault();
                $("#title").html("Tambah data projek");
                $("#btn-save").val("add");
                $("#put").html("");
                $("#modalFormData").trigger("reset");
                $("#tagEditorModal").modal("show");
                $("#modalFormData").attr('action', "{{ route('project.store') }}");
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
                    data: 'getType',
                    name: 'getType',
                }, {
                    data: 'programing',
                    name: 'programing',
                }, {
                    data: 'title',
                    name: 'title',
                }, {
                    data: 'body',
                    name: 'body',
                    render: function ( data) {
                        return htmlDecode(data);
                    }
                }, {
                    data: 'url',
                    name: 'url',
                }, {
                    data: 'location',
                    name: 'location',
                }, {
                    data: 'lang',
                    name: 'lang',
                }, {
                    data: 'image',
                    name: 'image',
                    render: function ( data) {
              return `<img src="{{asset('storage/project')}}/${data}" width="40px">`;},
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
            function htmlDecode(input){
                var e = document.createElement('p');
                e.innerHTML = input;
                return e.childNodes.length === 0 ? "" : e.childNodes[0].nodeValue;
            }
            $('.table-data').on('click', '.btn-edit', function() {
                let row = showData.row($(this).closest('tr')).data();
                let url = "{{ route('project.update',':id') }}"
                    url = url.replace(':id', row.id);
                $("#modalFormData").attr('action', url);
                $("#title").html("Edit "+ row.title);
                $("#put").html('<input type="hidden" name="_method" value="put">');
                $("#project_type_id").val(row.project_type_id);
                $("#titles").val(row.title);
                $("#programings").val(row.programing);
                var body = htmlDecode(row.body);
                tinyMCE.activeEditor.setContent(row.body);
                $("#url").val(row.url);
                $("#location").val(row.location);
                $('#lang').val(row.lang);
                $('.error').empty();
                $('#tagEditorModal').modal('show');
            })
            // Delete
            $('.table-data').on('click', '.btn-remove', function() {
                let row = showData.row($(this).closest('tr')).data();
                let url = "{{ route('project.destroy',':id') }}"
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