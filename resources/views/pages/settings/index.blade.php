@section('title', 'Madjou | Langganan')
<x-app-layout>
    <div class="page-content">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="example">
                          <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="home-line-tab" data-bs-toggle="tab" href="#line-home" role="tab" aria-controls="line-home" aria-selected="true">Home</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="profile-line-tab" data-bs-toggle="tab" href="#line-profile" role="tab" aria-controls="line-profile" aria-selected="false">Profile</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="contact-line-tab" data-bs-toggle="tab" href="#line-contact" role="tab" aria-controls="line-contact" aria-selected="false">Contact</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link disabled" id="disabled-line-tab" data-bs-toggle="tab" href="#line-disabled" role="tab" aria-controls="line-disabled" aria-selected="false">Disabled</a>
                            </li>
                          </ul>
                          <div class="tab-content mt-3" id="lineTabContent">
                            <div class="tab-pane fade show active" id="line-home" role="tabpanel" aria-labelledby="home-line-tab">
                              <h6 class="mb-1">Home</h6>
                              <p></p>
                            </div>
                            <div class="tab-pane fade" id="line-profile" role="tabpanel" aria-labelledby="profile-line-tab">
                              <h6 class="mb-1">Profile</h6>
                              <p></p>
                            </div>
                            <div class="tab-pane fade" id="line-contact" role="tabpanel" aria-labelledby="contact-line-tab">
                              <h6 class="mb-1">Contact</h6>
                              <p</p>
                            </div>
                            <div class="tab-pane fade" id="line-disabled" role="tabpanel" aria-labelledby="disabled-line-tab">
                              <h6 class="mb-1">disabled</h6>
                            </div>
                          </div>
                        </div>
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
                                                <label for="type" class="form-label">Jenis tags </label>
                                                    <select name="type" id="type" class="form-control">
                                                        <option value="" selected disabled hidden>Pilih jenis tags</option>
                                                        <option value="blog">Blog</option>
                                                        <option value="service">Service</option>
                                                        <option value="all">All</option>
                                                    </select>
                                                <div class="text-danger" id="error-type"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Nama </label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="Masukkan nama tag..." value="">
                                                <div class="text-danger" id="error-name"></div>
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
                        targets: [0, 3],
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
                    data: 'email',
                    name: 'email',
                }, {
                    data: 'status',
                    name: 'status',
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
                $("#title").html("Edit "+ row.title);
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