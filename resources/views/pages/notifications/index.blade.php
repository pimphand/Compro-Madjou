@extends('layouts.app')
@section('title', 'Madjou | Notifikasi')
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
                    <h4 class="card-title">Table data notifikasi</h4>
                    <button type="button" class="btn btn-inverse-success" data-bs-toggle="modal"
                        data-bs-target="#tagEditorModal" id='btn-add'>
                        <i data-feather="plus"></i>
                        Tambah Data
                    </button>
                </div>
                <div class="table-responsive">
                    <table data-url="{{ request()->url() }}" class="table-data table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>E-mail</th>
                                <th>Body</th>
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
                                <form id="modalFormData" name="modalFormData" class="form-horizontal" novalidate="">
                                    @csrf
                                    <div id="put"></div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Judul </label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Masukkan title..." value="">
                                        <div class="text-danger" id="error-name"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Email </label>
                                        <input type="text" class="form-control" id="email" name="email"
                                            placeholder="Masukkan email..." value="">
                                        <div class="text-danger" id="error-name"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="body" class="form-label">Body </label>
                                        <textarea type="text" class="form-control" id="body"
                                            placeholder="Masukkan body pesan..."></textarea>
                                        <input type="hidden" name="body" class="body">
                                        <div class="text-danger" id="error-body"></div>
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
                                        <input type="file" name="image" id="image" class="form-control" value="">
                                        <div class="text-danger" id="error-image"></div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-inverse-primary" id="btn-save" value="add">Simpan
                                    data</button>
                                <input type="hidden" id="notif_id" name="id" value="0">
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
                $("#title").html("Buat notifikasi");
                $("#btn-save").val("add");
                $("#put").html("");
                $("#modalFormData").trigger("reset");
                $("#tagEditorModal").modal("show");
                $("#modalFormData").attr('action', "{{ route('notifications.store') }}");
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
                        targets: [0, 5],
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
                },{
                    data: 'name',
                    name: 'name',
                }, {
                    data: 'email',
                    name: 'email',
                }, {
                    data: 'body',
                    name: 'body',
                    render: function ( data) {
                        return htmlDecode(data);
                    },
                }, {
                    data: 'lang',
                    name: 'lang',
                }, {
                    data: 'image',
                    name: 'image',
                    render: function ( data) {
              return `<img src="{{asset('storage/notifications')}}/${data}" width="40px">`;},
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
                let url = "{{ route('notifications.update',':id') }}"
                    url = url.replace(':id', row.id);
                $("#modalFormData").attr('action', url);
                $("#title").html("Edit "+ row.name);
                $("#put").html('<input type="hidden" name="_method" value="put">');
                $("#email").val(row.email);
                $("#name").val(row.name);
                var body = htmlDecode(row.body);
                tinyMCE.activeEditor.setContent(body);
                $('#lang').val(row.lang);
                $('.error').empty();
                $('#tagEditorModal').modal('show');
            })
            // Delete
            $('.table-data').on('click', '.btn-remove', function() {
                let row = showData.row($(this).closest('tr')).data();
                let url = "{{ route('notifications.destroy',':id') }}"
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