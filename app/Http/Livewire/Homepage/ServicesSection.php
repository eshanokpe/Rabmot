<?php

namespace App\Http\Livewire\Homepage;

use Livewire\Component;

class ServicesSection extends Component
{
    public $services = [];

    public function mount()
    {
        $this->services = [
            [
                'id' => 'driver-license',
                'title' => "Driver's License",
                'icon' => 'fa-id-card',
                'route' => 'driver-license',
                'description' => 'Get your driver\'s license processed quickly'
            ],
            [
                'id' => 'vehicle-registration',
                'title' => 'Vehicle Registration',
                'icon' => 'fa-car',
                'route' => '#',
                'description' => 'Register your vehicle with ease'
            ],
            [
                'id' => 'change-ownership',
                'title' => 'Change Ownership',
                'icon' => 'fa-exchange-alt',
                'route' => '#',
                'description' => 'Transfer vehicle ownership smoothly'
            ],
            [
                'id' => 'international-license',
                'title' => 'International License',
                'icon' => 'fa-globe',
                'route' => 'int-drivers-license',
                'description' => 'Get your international driving permit'
            ],
            [
                'id' => 'dealer-plate',
                'title' => 'Dealer Plate Number',
                'icon' => 'fa-tags',
                'route' => 'dealer-plate-number',
                'description' => 'Get dealer plate numbers for your business'
            ],
            [
                'id' => 'vehicle-renewal',
                'title' => 'Vehicle Renewal',
                'icon' => 'fa-sync-alt',
                'route' => 'vehicle-renewal',
                'description' => 'Renew your vehicle registration'
            ],
        ];
    }

    public function render()
    {
        return view('livewire.homepage.services-section');
    }
}