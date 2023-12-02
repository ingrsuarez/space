<div>
    
    <form id="wating" action="{{route('wating.attach',['paciente'=>$paciente,'institution'=>$institution])}}" method="POST">
        @csrf
        {{-- @method('put') --}}
        <div class="input-group mb-3">
            <select class="form-select" name = 'user_id' wire:change="changeEvent($event.target.value)">
                @foreach($institution->users as $user)
                    @if($user->hasRole('profesional'))
                        <option value="{{$user->id}}">{{strtoupper($user->lastName).' '.strtoupper($user->name)}}</option> 
                    @endif
                @endforeach   
            </select> 
        </div>
        <div class="input-group mb-3">

            <select class="form-select" name = 'payment'>
                <option value="cash">Efectivo</option>
            </select>
            <span class="input-group-text">$</span>
            <input type="number" name="amount" class="form-control" aria-label="Amount (to the nearest dollar)">
            <span class="input-group-text">.00</span>

        </div>
        <div class="d-grid gap-2 col-4 ms-auto py-2">
            <button type="submit" class="btn btn-sm btn-primary text-white">ENVIAR</button>                    
        </div>
    </form>
    
</div>
