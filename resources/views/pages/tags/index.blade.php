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
                        <h4 class="card-title">Tabel Tags</h4>
                            <button type="button" class="btn btn-inverse-success" data-bs-toggle="modal" data-bs-target="#varyingModal" id='btn-add'>
                                <i data-feather="plus"></i>
                                Tambah Data 
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Type</th>
                                  <th>Name</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                  @forelse ($tags as $tag)
                                      <tr>
                                          <td></td>
                                          <td>{{$tag->type}}</td>
                                          <td>{{$tag->name}}</td>
                                          <td>
                                            <button class="btn btn-info open-modal" value="{{$tag->id}}">Edit
                                            </button>
                                            <button class="btn btn-danger delete-link" value="{{$tag->id}}">Delete
                                            </button>
                                          </td>
                                      </tr>
                                  @empty
                                  <tr>
                                      <td colspan="4" class="text-center">
                                          Data Kosong
                                      </td>
                                  </tr>
                                  @endforelse
                               
                              </tbody>
                            </table>
                          </div>

                          {{-- modal --}}
                          

                            <div class="modal fade" id="tagEditorModal" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="varyingModalLabel">Tambah data tag</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="modalFormData" name="modalFormData" class="form-horizontal" novalidate="">
                                        @csrf
                                    <div class="mb-3">
                                        <label for="type" class="form-label">Type </label>
                                        <input type="text" class="form-control" id="type" name="type" placeholder="Input type tag..." value="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name </label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Input name tag..." value="">
                                    </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-inverse-primary" id="btn-save" value="add">Simpan data</button>
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

       
</x-app-layout>