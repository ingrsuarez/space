<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Institution;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ShowInstitution extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $name;
    public $lastName;
    public $institution;
    public $userInstitutions;
    
    public function mount()
    {
        $this->institution = User::find(Auth::user()->id)->currentInstitution;
        $user = User::find(Auth::user()->id);        
        $this->userInstitutions = $user->institutions;
    }

    public function render()
    {
        if($this->name <> ''){

            $users = User::where('name','LIKE','%'.$this->name.'%')->paginate(10);
            return view('livewire.show-institution',compact('users'));
        }elseif($this->lastName <> ''){
            $users = User::where('lastName','LIKE','%'.$this->lastName.'%')->paginate(10);
            return view('livewire.show-institution',compact('users'));
        }elseif(isset($this->institution)){
            $users = $this->institution->users()->paginate(10);
            return view('livewire.show-institution',compact('users'));
        }
           
    }

    public function changeEvent($value)
    {

        $user = Auth::user();
        $user->institution_id = $value;
        try 
        {
            
            $user->save();
            return redirect()->route('institution.show')->with('message', 'Institución actualizada correctamente!');
        
        } catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
               return back()->with('error', 'Especialidad ya existente!');
            }
            else{
             return back()->with('error', $e->getMessage());
            }
        }
    }



}
