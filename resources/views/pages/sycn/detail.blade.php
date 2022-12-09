@extends('layouts.app')
@section('title', 'Madjou | Langganan')
@section('content')
<div class="row">
    <div class="card">
        <div class="card-header">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h4 class="card-title">Produk : {{ $product->name }}</h4>
                <button type="button" class="btn btn-inverse-success" data-bs-toggle="modal"
                    data-bs-target="#tagEditorModal" id='btn-add'>
                    <i data-feather="plus"></i>
                    Tambah Data
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive mb-5">
                <table data-url="{{ route('sync_product.data',$product->id) }}" class="product table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Expired</th>
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
                <form id="modalFormData" action="{{ route('sync_product.store', $product->id) }}" name="modalFormData"
                    enctype="multipart/form-data" class="form-horizontal" novalidate="">
                    @csrf
                    <div id="put"></div>
                    <div class="mb-3">
                        <label for="titles" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Masukkan judul projek..." value="">
                        <div class="text-danger" id="error-title"></div>
                    </div>
                    <div class="mb-3">
                        <label for="titles" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Masukkan judul projek..." value="">
                        <div class="text-danger" id="error-title"></div>
                    </div>
                    <div class="mb-3">
                        <label for="titles" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Masukkan judul projek..." value="">
                        <div class="text-danger" id="error-title"></div>
                    </div>
                    <div class="mb-3">
                        <label for="titles" class="form-label">Expired</label>
                        <select name="expired" class="form-control" id="expired">
                            <option value="7">7 Hari</option>
                            <option value="14">14 Hari</option>
                            <option value="21">21 Hari</option>
                            <option value="30">30 Hari</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-inverse-primary" id="save" value="add">Simpan
                    data</button>
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
                    name: 'id',
                    data: 'id',
                }, {
                    data: 'name',
                    name: 'name',
                }, {
                    data: 'email',
                    name: 'email',
                },{
                    data: 'madjou.expired_at',
                    name: 'madjou.expired_at',
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
                        const button_invoice = $('<button>', {
                            html: $('<i>', {
                                class: 'fa fa-file-invoice'
                            }).prop('outerHTML'),
                            class: 'btn btn-info btn-invoice',
                            'data-id': id,
                            title: `Tambah Invoice`,
                        })
                        const button_group = $('<div>', {
                            class: 'btn-group btn-group-sm',
                            role: 'group',
                            html: () => {
                                return [button_edit, button_delete,button_invoice]
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
                $("#type").val(row.type);
                $("#name").val(row.name);
                $('.error').empty();
                $('#tagEditorModal').modal('show');
            })

            $('.product').on('click', '.btn-invoice', function() {
                let row = showData.row($(this).closest('tr')).data();
                let url = "{{ route('data-product.update',':id') }}"
                    url = url.replace(':id', row.id);
                $("#invoice").attr('action', url);
                $('.error').empty();
                $('#tagEditorModal').modal('show');
            })
            // Delete
            $('.product').on('click', '.btn-remove', function() {
                let row = showData.row($(this).closest('tr')).data();
                let url = "{{ route('sync_product.delete',':id') }}"
                    url = url.replace(':id', "{{ $product->id }}");
                
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
                            id : row.id,
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

        $('.modal-form #save').on('click', function () {
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
                        }).then((result) => {
                            if (result.value) {
                                // show data
                            }
                        });
                        showData.ajax.reload();
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
</script>
@endpush