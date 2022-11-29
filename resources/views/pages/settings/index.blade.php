@extends('layouts.app')
@section('title', 'Madjou | Pengaturan')

@section('content')

{{-- show data setting --}}
<div class="row">
    <div class="card">
        <div class="card-header">
            <h4>Setting</h4>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab"
                        aria-controls="home" aria-selected="true">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-line-tab" data-bs-toggle="tab" href="#script" role="tab"
                        aria-controls="profile" aria-selected="false">Script</a>
                </li>
            </ul>
            <div class="tab-content mt-3" id="lineTabContent">
                <div class="tab-pane fade show active" id="contact" role="tabpanel" aria-labelledby="contact">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h4 class="card-title">Tabel data Contact</h4>
                        <button type="button" class="btn btn-inverse-success" data-bs-toggle="modal"
                            data-bs-target="#tagEditorModal" id='btn-add'>
                            <i data-feather="plus"></i>
                            Tambah Data
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table data-url="{{route('contacts.index')}}" class="table-data table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Url</th>
                                    <th>Image</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="script" role="tabpanel" aria-labelledby="script-line-tab">
                    <form action="">
                        <div class="mb-3">
                            <label for="script" class="form-label">
                                <h4>Header script</h4>
                            </label>
                            <textarea type="text" class="form-control" id="header" name="header"
                                aria-describedby="script" rows="3" placeholder="Tambahkan script disini!"></textarea>
                            <input type="hidden" name="script" class="script">

                        </div>
                        <div class="mb-3">
                            <label for="script" class="form-label">
                                <h4>Footer script</h4>
                            </label>
                            <textarea type="text" class="form-control" id="footer" name="footer"
                                aria-describedby="script" rows="3" placeholder="Tambahkan script disini!"></textarea>
                            <input type="hidden" name="script" class="script">

                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- store/edit contact --}}
<div class="modal fade modal-form" id="tagEditorModal" tabindex="-1" aria-labelledby="varyingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="varyingModalLabel">
                    <span id="title"></span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <form id="modalFormData" name="modalFormData" class="form-horizontal" novalidate=""
                    enctype="multipart/form-data">
                    @csrf
                    <div id="put"></div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Nama </label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Masukkan judul kontak..." value="">
                        <div class="text-danger" id="error-name"></div>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Url </label>
                        <input type="text" class="form-control" id="url" name="url" placeholder="Masukkan url kontak..."
                            value="">
                        <div class="text-danger" id="error-url"></div>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar </label>
                        <input type="file" name="images" id="images" class="form-control" value="">
                        <div class="text-danger" id="error-images"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-inverse-primary" id="btn-save" value="add">Simpan data</button>
                <input type="hidden" id="contacts_id" name="id" value="0">
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
         // add data contact
         $('#btn-add').click(function (e) { 
                e.preventDefault();
                $("#title").html("Tambah data kontak");
                $("#btn-save").val("add");
                $("#put").html("");
                $("#modalFormData").trigger("reset");
                $("#tagEditorModal").modal("show");
                $("#modalFormData").attr('action', "{{ route('contacts.store') }}");
            });

        $(document).ready(function(){
            // show data contact
            $('#contactTab').ready(function(){
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
                            targets: [0, 4],
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
                        data: 'name',
                        name: 'name',
                    }, {
                        data: 'url',
                        name: 'url',
                    }, {
                        data: 'images',
                        name: 'images',
                        render: function ( data) {
                            return `<img src="{{asset('storage/contacts')}}/${data}" width="40px">`;
                        }
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
                    let url = "{{ route('contacts.update',':id') }}"
                        url = url.replace(':id', row.id);
                    $("#modalFormData").attr('action', url);
                    $("#title").html("Edit " + row.name);
                    $("#put").html('<input type="hidden" name="_method" value="put">');
                    $("#name").val(row.name);
                    $("#url").val(row.url);
                    $('.error').empty();
                    $('#tagEditorModal').modal('show');
                })

                // Delete Contact
                $('.table-data').on('click', '.btn-remove', function() {
                    let row = showData.row($(this).closest('tr')).data();
                    let url = "{{ route('contacts.destroy',':id') }}"
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
  
        })

        function htmlDecode(input){
                var e = document.createElement('p');
                e.innerHTML = input;
                return e.childNodes.length === 0 ? "" : e.childNodes[0].nodeValue;
            }
        $('#script').on('click', function(){
            tinyMCE.activeEditor.setContent(script);

        })
        
        $.ajax({
            type: "get",
            url: "{{ route('settings.data') }}",
            success: function (data) {
                $.each(data.data, function (i, v) { 
                    if(v.code == "script-header"){
                        $('#header').val(v.code);
                    }
                    if(v.code == "script-footer"){
                        $('#footer').val(v.code);
                    }
                });
            }
        });
</script>
@endpush