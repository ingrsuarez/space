@extends('layouts.login')

@section('content')
<div class="col-sm px-5">
    <div class="card mb-3" style="max-width: 20rem;">
        <a class="btn btn-success text-white" href="{{ route('confirmed.serviceAppointment',[$appointment,$confirmation]) }}" >Confirmar turno</a>

    </div>
</div>


@endsection