@extends('layouts.app')
@section('title', 'Madjou | Langganan')
@section('content')
<div class="row">
    <div class="card">
        <div class="card-header">
            <h4>Produk</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive mb-5">
                <table data-url="{{ route('sync_product.data') }}?id={{ $product->id }}" class="product table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Url</th>
                            <th>Key</th>
                            <th>Gambar</th>
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
                    <span id="title"></span>
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
                        <label for="programing" class="form-label">Pemrograman </label>
                        <input type="text" class="form-control" id="programings" name="programing"
                            placeholder="Masukkan jenis pemrograman projek..." value="">
                        <div class="text-danger" id="error-programing"></div>
                    </div>
                    <div class="mb-3">
                        <label for="body" class="form-label">Konten </label>
                        <textarea type="text" name="body" id="body" cols="30" rows="10" class="form-control" value=""
                            placeholder="Masukkan konten projek..."></textarea>
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
                        <label for="location" class="form-label">Gambar </label>
                        <input type="file" class="form-control" id="location" name="image"
                            placeholder="Masukkan lokasi projek..." value="">
                        <div class="text-danger" id="error-location"></div>
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
    let product;
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
            product = $('.product').DataTable({
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
                    data: 'url',
                    name: 'url',
                },{
                    data: 'key',
                    name: 'key',
                },{
                    data: 'image',
                    name: 'image',
                },{
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
            $('.product').on('click', '.btn-edit', function() {
                let row = product.row($(this).closest('tr')).data();
                let url = "{{ route('data-product.update',':id') }}"
                    url = url.replace(':id', row.id);
                $("#modalFormData").attr('action', url);
                $("#title").html("Edit "+ row.title);
                $("#put").html('<input type="hidden" name="_method" value="put">');
                $("#type").val(row.type);
                $("#name").val(row.name);
                $('.error').empty();
                $('#tagEditorModal').modal('show');
            })
            // Delete
            $('.product').on('click', '.btn-remove', function() {
                let row = product.row($(this).closest('tr')).data();
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
                                product.ajax.reload();
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