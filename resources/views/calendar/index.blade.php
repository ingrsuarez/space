@extends('layouts.app')

@section('content')
  @if (session('error'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>{{ session('error') }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
  @if($user->hasRole('administrativo'))
    <div class="col-sm px-5 mb-3" style="max-width: 50rem;">
      <div class="accordion" id="accordionWatingList">
        <div class="accordion-item">
          <h2 class="accordion-header" id="WatingList">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#WatingList-collapseOne" aria-expanded="true" aria-controls="WatingList-collapseOne">
            <div class="">
                Seleccionar profesional: <strong>{{strtoupper($institution->name)}}</strong>
            </div>
          </button>
          </h2>
          <div id="WatingList-collapseOne" class="accordion-collapse collapse show" aria-labelledby="WatingList-headingOne">
            <div class="accordion-body">
              @if(isset($institution))
                <form id="wating" action="{{route('appointment.show')}}" method="POST">
                  @csrf
                  {{-- @method('put') --}}
                  <div class="input-group mb-3">
                    <input type="hidden" name="institution_id" value="{{$institution->id}}">
                    <select class="form-select" name = 'user_id' autofocus>
                      @foreach($institution->users as $professional)
                        @if($professional->hasRole('profesional'))
                          <option value="{{$professional->id}}">{{strtoupper($professional->name)}}</option>
                        @endif
                      @endforeach   
                    </select>  
        
                    <button type="submit" class="btn btn-sm btn-primary text-white">Seleccionar</button>
                      
                  </div>
                                     

                </form>
              @endif
            </div>    
          </div>

        </div>
      </div>
    </div>
  @endif
  @if($user->hasRole('profesional'))
    

  @endif

@endsection