@section('title', 'Madjou | Permission')

<x-app-layout>
    <div class="page-content">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tabel User</h4>
                        <div class="form-check mb-2">
                            @foreach ($permission as $perm)
                            <input type="checkbox" class="form-check-input" id="checkDefault">
                                <label class="form-check-label" for="checkDefault">
                                    {{$perm->name}}
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        
</x-app-layout>
