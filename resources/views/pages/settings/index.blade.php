@extends('layouts.app')
@section('title', 'Madjou | Pengaturan')

@section('content')
    
        {{-- show data setting --}}
        <div class="row">
            
                
                
                <div class="card">
                    <div class="card-body">
                        
                        <div class="example">
                          <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
                            
                            
                          </ul>
                          <div class="tab-content mt-3" id="lineTabContent">
                            <div class="tab-pane fade show active" id="line-contact" role="tabpanel" aria-labelledby="contact-line-tab">
                                <div class="table-responsive">
                                    <table data-url="{{ route('contacts.index') }}" class="table-data table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Url</th>
                                                <th>Gambar</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="line-header" role="tabpanel" aria-labelledby="header-line-tab">
                                {{-- add code head --}}
                                <div class="formCode">
                                    <form id="modalFormCode" name="modalFormCode" class="form-horizontal"
                                    novalidate="" enctype="multipart/form-data">
                                    @csrf
                                        <div id="put"></div>
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Url </label>
                                            <textarea type="text" class="form-control" id="code" name="code"
                                                placeholder="Masukkan code..." value=""></textarea>
                                            <div class="text-danger" id="error-code"></div>
                                        </div>
                                        <button type="button" class="btn btn-inverse-primary" id="btn-save"
                                        value="add">Simpan</button>
                                    </form>
                                </div>
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

                     

                       

                    </div>
                </div>
            </div>  
            
        </div>

        {{-- edit contact --}}
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
                        novalidate="" enctype="multipart/form-data">
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
                            <input type="text" class="form-control" id="url" name="url"
                                placeholder="Masukkan url kontak..." value="">
                            <div class="text-danger" id="error-url"></div>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar </label>
                            <input type="file" name="images" id="images" class="form-control"
                                value="">
                            <div class="text-danger" id="error-images"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-inverse-primary" id="btn-save"
                        value="add">Simpan data</button>
                    <input type="hidden" id="service_id" name="id" value="0">
                </div>
            </div>
        </div>
    </div>

        

        @endsection
   
    @push('js')
    <script>
       let showData;
        $(document).ready(function(){
            showSetting();
            dataContact();
            header();

            function showSetting(){
                $.ajax({
                    // show data
                    type: "GET",
                    url: "{{route('settings.index')}}",
                    success: function(response){
                       $('#lineTab').html(response.data);
                       $.each(response.data, function (key, item){
                        $('#lineTab').append(`<li class="nav-item">
                              <a class="nav-link" id="`+item.name+`-line-tab"
                               data-bs-toggle="tab"
                                href="#line-`+item.name+`"
                                 role="tab" 
                                 aria-controls="line-`+item.name+`" 
                                 aria-selected="true">`+item.name+`</a>
                            </li>`);
                        console.log(item.name)
                       })
                    }
                })
            }

            
            function dataContact(){
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
                        data: 'image',
                        name: 'image',
                        render: function ( data) {
                            return `<img src="{{asset('storage/contact')}}/${data}" width="40px">`;
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
            }

           
    })

    </script>
    @endpush
   