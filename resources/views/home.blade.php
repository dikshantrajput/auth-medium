@extends('layouts.app')

@section('content')

@if(Session::has('error-message'))
    <div class="alert alert-warning">
        {{ Session::get('error-message') }}
    </div>
@endif

@if(Session::has('success-message'))
    <div class="alert alert-success">
        {{ Session::get('success-message') }}
    </div>
@endif

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
                @if(auth()->user()->avatar)
                    <h5 class="m-3">Uploaded avatar</h5>
                    <img class="m-3" src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="user avatar" width="100" height="100" />
                @endif
                <div class="form-group p-3 my-4">
                    <h3>Upload Avatar</h3>
                    <form action="{{ route('user.avatar.upload') }}" method="post" enctype="multipart/form-data">
                    @csrf
                        <input type="file" name="avatar" accept="image/*">
                        <input type="submit" class="btn btn-primary">
                    </form>
                </div>
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