<?php

namespace App\Http\Livewire\Homepage;

use Livewire\Component;

class WhyChooseUs extends Component
{
    public $features = [];

    public function mount()
    {
        $this->features = [
            [
                'id' => 'vehicle-papers',
                'title' => "Vehicles Papers",
                'icon' => 'assets/img/car1.png',
                'route' => 'pricing#vpr',
                'description' => 'Fast and reliable vehicle documentation'
            ],
            [
                'id' => 'drivers-license',
                'title' => "Driver's License",
                'icon' => 'assets/img/car2.png',
                'route' => 'pricing#ndl',
                'description' => 'Professional license processing'
            ],
            [
                'id' => 'change-ownership',
                'title' => "Change of Ownership",
                'icon' => 'assets/img/car3.png',
                'route' => 'pricing#coo',
                'description' => 'Seamless ownership transfer'
            ],
        ];
    }

    public function render()
    {
        return view('livewire.homepage.why-choose-us');
    }
}