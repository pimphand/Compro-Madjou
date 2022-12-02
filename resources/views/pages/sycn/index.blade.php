@extends('layouts.app')
@section('title', 'Madjou | Langganan')
@section('content')
<div class="row">
    <div class="card">
        <div class="card-header">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h4 class="card-title">Data Produk</h4>
                <button type="button" class="btn btn-inverse-success" data-bs-toggle="modal"
                    data-bs-target="#tagEditorModal" id='btn-add'>
                    <i data-feather="plus"></i>
                    Tambah Data
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive mb-5">
                <table data-url="{{ route('data-product.index') }}" class="product table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Url</th>
                            <th>Key</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-form" id="tagEditorModal" tabindex="-1" aria-labelledby="varyingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="varyingModalLabel">
                    <span id="title">Tambah Produk</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <form id="modalFormData" name="modalFormData" enctype="multipart/form-data" class="form-horizontal"
                    novalidate="">
                    @csrf
                    <div id="put"></div>
                    <div class="mb-3">
                        <label for="titles" class="form-label">Nama Product </label>
                        <input type="text" class="form-control" id="titles" name="title"
                            placeholder="Masukkan judul projek..." value="">
                        <div class="text-danger" id="error-title"></div>
                    </div>
                    <div class="mb-3">
                        <label for="titles" class="form-label">List </label>
                        <input type="text" class="form-control" id="url_list" name="url_list" placeholder="Masukkan url"
                            value="">
                        <div class="text-danger" id="error-url_list"></div>
                    </div>
                    <div class="mb-3">
                        <label for="titles" class="form-label">Store </label>
                        <input type="text" class="form-control" id="url_store" name="url_store"
                            placeholder="Masukkan url" value="">
                        <div class="text-danger" id="error-url_store"></div>
                    </div>
                    <div class="mb-3">
                        <label for="titles" class="form-label">Update </label>
                        <input type="text" class="form-control" id="url_update" name="url_update"
                            placeholder="Masukkan url" value="">
                        <div class="text-danger" id="error-url_update"></div>
                    </div>
                    <div class="mb-3">
                        <label for="titles" class="form-label">Delete </label>
                        <input type="text" class="form-control" id="url_delete" name="url_delete"
                            placeholder="Masukkan url" value="">
                        <div class="text-danger" id="error-url_delete"></div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-inverse-primary" id="btn-save" value="add">Simpan
                    data</button>
                <input type="hidden" id="project_type_id" name="id" value="0">
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    let showData;
        $(() => {
            // $('#btn-add').click(function (e) { 
            //     e.preventDefault();
            //     $("#title").html("Tambah data tag");
            //     $("#btn-save").val("add");
            //     $("#put").html("");
            //     $("#modalFormData").trigger("reset");
            //     $("#tagEditorModal").modal("show");
            //     $("#modalFormData").attr('action', "{{ route('tags.store') }}");
            // });
            
            // datatable
            showData = $('.product').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: $('.product').data('url'),
                order: [
                    [1, 'DESC'],
                ],
                columnDefs: [{
                        orderable: false,
                        searchable: false,
                        // targets: [0, 3],
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
                    data: 'id',
                    name: 'id',
                    render: (id,full,data) => {
                        return `
                            List : ${data.url_list} <br>
                            Create : ${data.url_store} <br>
                            Update : ${data.url_update} <br>
                            delete : ${data.url_delete} <br>
                        `
                    }
                },{
                    data: 'key',
                    name: 'key',
                },{
                    data: 'id',
                    name: 'id',
                    render: (id,full,data) => {
                        
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
                        const button_details = $('<button>', {
                            html: $('<i>', {
                                class: 'fa fa-info-circle'
                            }).prop('outerHTML'),
                            class: 'btn btn-info btn-details',
                            'data-id': data.name,
                            title: `Detail Data`,
                        })
                        const button_group = $('<div>', {
                            class: 'btn-group btn-group-sm',
                            role: 'group',
                            html: () => {
                                return [button_edit, button_delete,button_details]
                            }
                        })
                        return button_group.prop('outerHTML')
                    }
                }]
            })
            // edit
            $('.product').on('click', '.btn-edit', function() {
                let row = showData.row($(this).closest('tr')).data();
                let url = "{{ route('data-product.update',':id') }}"
                    url = url.replace(':id', row.id);
                $("#modalFormData").attr('action', url);
                $("#title").html("Edit "+ row.title);
                $("#put").html('<input type="hidden" name="_method" value="put">');
               
                $('#url_list').val();
                $('#url_store').val();
                $('#url_update').val();
                $('#url_delete').val();
                
                $('.error').empty();
                $('#tagEditorModal').modal('show');
            })
            
            $('.product').on('click', '.btn-details', function() {
                let row = showData.row($(this).closest('tr')).data();
                let url = "{{ route('data-product.show',':id') }}"
                    url = url.replace(':id', row.id);
                window.location.href = url;
            })
            // Delete
            $('.product').on('click', '.btn-remove', function() {
                let row = showData.row($(this).closest('tr')).data();
                let url = "{{ route('data-product.destroy',':id') }}"
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