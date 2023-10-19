@extends('layouts.login')

@section('content')
<a class="btn btn-success text-white" href="{{ route('confirmed.appointment',[$appointment,$confirmation]) }}" >Confirmar turno</a>


@endsection