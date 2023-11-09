<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Institution;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class ShowRooms extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $institution;
    public $rooms;
    
    public function mount(Institution $institution)
    {
        $this->institution = $institution;

    }

    public function render()
    {

           
    }
}
