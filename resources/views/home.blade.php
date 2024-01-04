@extends('layouts.app')

@section('content')

    @if (session('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ session('message') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container">
        @livewire('show-patients',['wating_institution' => $wating_institution])   

    </div>
@endsection
@section('scripts')
    <script>
    //     window.livewire.onError(statusCode => {
    //     return false
    // })

    </script>
    

@endsection



