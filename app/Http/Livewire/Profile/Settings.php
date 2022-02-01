<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;

class Settings extends Component
{
    public $email, $profile_pic_url;

    public function mount()
    {
        
    }


    public function render()
    {
        return view('livewire.profile.settings');
    }
}
