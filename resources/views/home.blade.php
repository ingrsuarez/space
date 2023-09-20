@extends('layouts.app')

@section('content')
<div class="container">


@livewire('show-patients',['wating_institution' => $wating_institution])   

</div>
@endsection
