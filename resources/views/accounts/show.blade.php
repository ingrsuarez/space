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
                  Movimiento de cajas: <strong>{{strtoupper($institution->name)}}</strong>
              </div>
            </button>
          </h2>
          <div id="WatingList-collapseOne" class="accordion-collapse collapse show" aria-labelledby="WatingList-headingOne">
            <div class="accordion-body">
              @if(isset($institution))
                  <div class="input-group mb-3">
                    <table class="table">
                      <thead class="table-light">
                          <th>Profesional</th>
                          <th class="d-none d-lg-table-cell">Especialidad</th>
                          
                          <th></th>
                      </thead>
                      <tbody>
                        @foreach($institution->users as $professional)
                          @if($professional->hasRole('profesional'))
                          <form id="f{{$professional->id}}" action="{{route('accounts.balance')}}" method="POST">
                            @csrf
                            {{-- @method('put') --}}
                            <tr>
                              <td>
                                  <input type="hidden" name="institution_id" form="f{{$professional->id}}" value="{{$institution->id}}">
                                  <input type="hidden" name = 'user_id' form="f{{$professional->id}}" value="{{$professional->id}}">
                                  {{strtoupper($professional->lastName.' '.$professional->name)}}
                              </td>
                              <td class="d-none d-lg-table-cell">
                                @foreach($professional->professions as $profession)
                                    <strong>{{strtoupper($profession->name.' ')}}</strong>
                                @endforeach
                              </td>
                              
                              
                              <td><button type="submit" form="f{{$professional->id}}" class="btn btn-sm btn-primary text-white shadow">Movimientos</button></td>
                            </tr>
                          </form>
                        @endif
                      @endforeach  
                    </tbody>
                  </table> 
                    {{-- <select class="form-select" name = 'user_id' autofocus>
                      @foreach($institution->users as $professional)
                        @if($professional->hasRole('profesional'))
                          <option value="{{$professional->id}}">{{strtoupper($professional->lastName).' '.strtoupper($professional->name)}}</option>
                        @endif
                      @endforeach   
                    </select>  
        
                    <button type="submit" class="btn btn-sm btn-primary text-white">Seleccionar</button> --}}
                      
                  </div>
                                     

                </form>
              @endif
            </div>    
          </div>

        </div>
      </div>
    </div>
  @endif
  



@endsection