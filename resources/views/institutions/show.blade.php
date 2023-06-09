@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center mb-4">
              
        @can('institution.show')
            
            @livewire('show-institution')    
        @endcan
    </div> 
</div>




@endsection