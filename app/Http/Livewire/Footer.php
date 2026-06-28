<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Footer extends Component
{
    public $currentYear;

    public function mount()
    {
        $this->currentYear = date('Y');
    }

    public function render()
    {
        return view('livewire.footer');
    }
}