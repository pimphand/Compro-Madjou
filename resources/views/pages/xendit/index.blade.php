@extends('layouts.app')
@section('title', 'Madjou | Dashboard Xendit')
@section('content')
        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                       <div class="card-title">Balance Xendit</div>
                        <div class="showData"></div>
                            
                       

                    </div>
                </div>
            </div>
        </div>
 @endsection

    @push('js')
    <script>
        let showData;
        $(() => {
            // console.log(displayData())

                $.ajax({
                    type: 'GET',
                    url: "{{route('xendit.index')}}",
                    success: function(balance){
                        console.log(balance);
                        $('.showData').html('');
                        $('.showData').append(
                            "<p>Rp "+balance.data.balance+"</p>" )
                        }
                    })
                });
    </script>
    @endpush