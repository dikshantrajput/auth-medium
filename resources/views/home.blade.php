@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    {{ auth()->user()->name_mobile }}
                </div>
                <div class="user__info p-3">
                    <small class="error text-danger mb-2 d-block"></small>
                </div>
                <button class="btn btn-primary" data-id="{{ auth()->id() }}" onclick="fetchData(this)">
                    Fetch My Data
                </button>
                <a href="{{ route('age.restricted.page') }}" class="btn btn-danger" >
                    Age Restricted Page
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    function fetchData(e){
        let id = e.dataset.id
        $.ajax({
            type:'POST',
            url:"{{ route('user.data') }}",
            data:{
                id,
            },
            success:function(data){
                $('.user__info').html(data)
            },
            error:function(err){
                const error = JSON.parse(err.responseText).message
                console.log(error)
                $('.error').html(error)
            }
        })
    }
</script>
@endpush