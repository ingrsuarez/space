<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Sheet;
use App\Models\Service;
use App\Models\Institution;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EditInstitution extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $name;
    public $lastName;
    public $email;
    public $institution;
    public $userInstitutions;
    public $sheet_name;
    public $sheets;
    public $services;
    
    public function mount(Institution $institution)
    {
        $this->institution = $institution;
        $user = User::find(Auth::user()->id);        
        $this->userInstitutions = $user->institutions;
    }

    public function render()
    {
        if($this->name <> ''){

            $users = User::where('name','LIKE','%'.$this->name.'%')->paginate(10);
            return view('livewire.edit-institution',compact('users'));
        }elseif($this->lastName <> ''){
            $users = User::where('lastName','LIKE','%'.$this->lastName.'%')->paginate(10);
            return view('livewire.edit-institution',compact('users'));

        }elseif($this->email <> ''){
            $users = User::where('email','LIKE','%'.$this->email.'%')->paginate(10);
            return view('livewire.edit-institution',compact('users'));

        }elseif(isset($this->institution)){
            $users = $this->institution->users()->paginate(10);
            return view('livewire.edit-institution',compact('users'));
        }

        if($this->sheet_name <> ''){

            $sheets = Sheet::where('name','LIKE','%'.$this->sheet_name.'%')->paginate(15);
            return view('livewire.edit-institution',compact('sheets'));
        }
           
    }
    
}
