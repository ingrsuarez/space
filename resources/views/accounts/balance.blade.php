@extends('layouts.app')

@section('content')
  @if (session('error'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>{{ session('error') }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif


    <div class="container-fluid">
        <div class="row justify-content-center mb-4 " style="max-width: 50rem;">
                
            @can('accounts.show')
                
                @livewire('show-movements',['institution' => $institution, 'balance' => $balance, 'professional' => $professional])    
            @endcan
        </div> 
    </div>

    {{-- @foreach($balance as $move)
   <div> {{$move->description}}</div>
    @endforeach
   <div>{{$institution->name}}</div>

   <div>{{$professional->name}}</div> --}}





@endsection