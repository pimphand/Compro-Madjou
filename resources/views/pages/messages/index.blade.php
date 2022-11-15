@section('title', 'Madjou | Pesan')
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
                            <h4 class="card-title">Tabel data pesan</h4>
                           
                        </div>
                        <div class="table-responsive">
                            <table data-url="{{ request()->url() }}" class="table-data table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Email</th>
                                        <th>Perusahaan</th>
                                        <th>Telpon</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                        {{-- modal show --}}


                        <div class="modal fade bd-example-modal-xl" id="showMail" tabindex="-1"
                            aria-labelledby="varyingModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="varyingModalLabel">
                                            <span>Detail Message</span>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="btn-close"></button>
                                        </div>
                                    <div class="modal-body">
                                        <p class="text-left" id="email" value=""></p>
                                        <p class="text-left" id="company" value=""></p>
                                        <p class="text-left" id="phone" value=""></p>
                                        <p class="text-left" id="req" value=""></p>
                                        <hr>

                                        <p class="text-left" id="text"></p>

                                    </div>
                                   
                                </div>
                            </div>
                        </div>


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
                                                <label for="email" class="form-label">Kirim ke </label>
                                                <input type="email" class="form-control" id="emails" name="email"
                                                    placeholder="Masukkan email..." value="" disabled>
                                                <div class="text-danger" id="error-email"></div>
                                            </div>
                                            <div class="mb-3">
                                                <input type="text" class="form-control" id="message_id" name="message_id"
                                                    placeholder="Input id..." value="" disabled hidden>
                                                <div class="text-danger" id="error-email"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="subject" class="form-label">Subjek </label>
                                                <input type="text" class="form-control" id="subject" name="subject"
                                                    placeholder="Masukkan subjek..." value="">
                                                <div class="text-danger" id="error-subject"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="text" class="form-label">Pesan </label>
                                                <textarea type="text" class="form-control" id="comment" name="comment"
                                                    placeholder="Masukkan pesan..." value=""></textarea>
                                                <div class="text-danger" id="error-comment"></div>
                                            </div>
                                          
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-inverse-primary" id="btn-save"
                                            value="add">Kirim email</button>
                                        <input type="hidden" id="message_id" name="id" value="0">
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
                    data: 'email',
                    name: 'email',
                }, {
                    data: 'company',
                    name: 'company',
                }, {
                    data: 'phone',
                    name: 'phone',
                },{
                    data: 'id',
                    name: 'id',
                    render: (id, type, row) => {
                        const button_show = $('<button>', {
                            html: $('<i>', {
                                class: 'fa-solid fa-eye'
                            }).prop('outerHTML'),
                            class: 'btn btn-success btn-show',
                            'data-id': id,
                            title: `Show Data`,
                        })
                        const button_edit = $('<button>', {
                            html: $('<i>', {
                                class: 'fa fa-reply'
                            }).prop('outerHTML'),
                            class: 'btn btn-secondary btn-edit',
                            'data-id': id,
                            title: `Balas Pesan`,
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
                                return [button_edit, button_show, button_delete]
                            }
                        })
                        return button_group.prop('outerHTML')
                    }
                }]
            })

            // show
            $('.table-data').on('click', '.btn-show', function() {
                let row = showData.row($(this).closest('tr')).data();
                let url = "{{ route('messages.show',':id') }}"
                    url = url.replace(':id', row.id);
                $("#modalFormData").attr('action', url);
                $("#email").text("From : " + row.email);
                $("#company").text("Company : " + row.company);
                $("#req").text("Requirement : " + row.requirement);
                $("#text").text(row.text);
                $('.error').empty();
                $('#showMail').modal('show');
            })

             // edit
             $('.table-data').on('click', '.btn-edit', function() {
                
                let row = showData.row($(this).closest('tr')).data();
                let url = "{{ route('messages.update',':id') }}"
                    url = url.replace(':id', row.id);
                $("#modalFormData").attr('action', url);
                $("#title").html("Reply message");
                $("#put").html('<input type="hidden" name="_method" value="put">');
                $("#message_id").val(row.id);
                $("#emails").val(row.email);
                $("subjects").val();
                $("comment").val();
                $('.error').empty();
                $('#tagEditorModal').modal('show');
                console.log(row.id);
            })

            // Delete
            $('.table-data').on('click', '.btn-remove', function() {
                let row = showData.row($(this).closest('tr')).data();
                let url = "{{ route('messages.destroy',':id') }}"
                    url = url.replace(':id', row.id);
                
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data akan terhapus!",
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
         new EasyMDE({
        autoDownloadFontAwesome: false,
        element: document.getElementById('comment'),
        });

    </script>
    @endpush
</x-app-layout>