<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class StaffModeToggle extends Component
{
    public $mode = 0;

    public $role;

    public function mount()
    {
        if(session()->exists('mode'))
        {
            $this->mode = 1;
        }

        // if(empty($role))
        // {
        //     session()->forget('mode');
        //     $this->emit('refresh-navigation-menu');
        // }
    }

    public function determineRole()
    {
        $user = Auth::user();

        if($user->hasRole('administrator'))
        { 
            $this->role = 'Administrator'; 
        }
        if($user->hasRole('moderator'))
        { 
            $this->role = 'Moderator'; 
        }
        if($user->hasRole('support')) 
        { 
            $this->role = 'Support'; 
        }

        return $this->role;
    }

    public function updatedMode()
    {
        if($this->mode == 1)
        {
            switch($this->role) {
                case 'Administrator' :
                    session(['mode' => 'administrator']);
                    break;
                case 'Moderator' :
                    session(['mode' => 'moderator']);
                    break;
                case 'Support' :
                    session(['mode' => 'support']);
                    break;
            }
        }
        else
        {
            session()->forget('mode');
        }

        $this->emit('refresh-navigation-menu');
        
    }

    public function render()
    {
        return view('livewire.staff-mode-toggle', [
            'role' => $this->determineRole()
        ]);
    }
}
