@extends('layouts.app')

@section('content')

    @if (session('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ session('message') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container">
        @livewire('show-reports',['institution' => $institution, 'user' => $user, 'professionals' => $professionals])   
        
    </div>
@endsection
@section('scripts')

    

@endsection