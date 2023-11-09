@extends('layouts.app')

@section('content')
	@if (session('success'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="col-sm px-5">
        <div class="card mb-3">
            <div class="card-header text-white bg-primary">
                Convenios:    
            </div>
            <div class="card-body"> 
                <table class="table">
                    <thead class="table-light">
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Coseguro Paciente</th>
                        <th colspan="2"></th>
                    </thead>
                    <tbody>
                        @foreach($insurances as $insurance)
                            @if($user->hasInsurance($insurance->id))
                            <?php $myInsurance = $user->insurances()->where('insurance_id', $insurance->id)->first() ?>
                            <tr>
                                <td>{{ucfirst($insurance->name)}}</td>
                                <td class="w-25">{{$myInsurance->pivot->price}}</td>
                                <td class="w-25">
                                    <form class="input-group mb-3" action="{{ route('insurance.patient_charge') }}" method="POST">
                                        @csrf
                                        <span class="input-group-text">$</span>
						                <input type="number" step="1000" class="form-control" aria-label="charge" id="charge" 
                                        name="patient_charge" value="{{floatval($myInsurance->pivot->patient_charge)}}">
                                        <input type="hidden" name="myInsurance" value="{{$myInsurance->id}}">
                                        <button class="btn btn-outline-success " type="submit">Guardar</button>
                                    </form>
                                </td>
                                <td width="10px">   
                                    <a class="btn btn-danger text-white" href="{{ route('insurance.detach',[$insurance,$user]) }}">Quitar</a>
                                </td>
                                
                            </tr>
                            @else
                            <tr>
                                <td>{{ucfirst($insurance->name)}}</td>
                                <td></td>
                                <td></td>
                                <td width="10px">
                                    <a class="btn btn-info text-white" 
                                    href="{{ route('insurance.attach',[$insurance,$user]) }}">
                                        Agregar</a>  
                                </td>   
                            </tr>
                            @endif   
                        @endforeach
                  
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
    {{--         @if(isset($roles))
             {!!$roles->links()!!}

            @endif --}}
            </div>
        </div>    
    </div>

@endsection
