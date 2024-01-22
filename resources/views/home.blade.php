@extends('layouts.app')

@section('content')

    @if (session('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ session('message') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @push('meta')
        <meta http-equiv="refresh" content="30">
    @endpush
    <div class="container">
        @livewire('show-patients',['wating_institution' => $wating_institution, 'user' => $user])   
        
    </div>
@endsection
@section('scripts')

    

@endsection



