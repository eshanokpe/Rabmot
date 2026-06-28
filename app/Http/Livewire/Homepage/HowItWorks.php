<?php

namespace App\Http\Livewire\Homepage;

use Livewire\Component;

class HowItWorks extends Component
{
    public $steps = [];

    public function mount()
    {
        $this->steps = [
            [
                'id' => 1,
                'step' => 'Step 1',
                'title' => 'SIGN UP/LOGIN',
                'description' => 'Login to your dashboard on www.rabmotlicensing.com',
                'color' => 'red'
            ],
            [
                'id' => 2,
                'step' => 'Step 2',
                'title' => 'SELECT ANY OF OUR SERVICES',
                'description' => 'Select from any of our services ranging from new vehicle registration, renewal of vehicle particulars, change of ownership, driver\'s license registration, customize plate number registration, dealer plate number registration, and other vehicle documents, and our platform automatically calculates the cost for your specific paperwork needs.',
                'color' => 'yellow'
            ],
            [
                'id' => 3,
                'step' => 'Step 3',
                'title' => 'PROVIDE THE NECESSARY DETAILS',
                'description' => 'Provide your vehicle type from saloon cars, SUVs, Pick Ups, Trucks, and a few other details.',
                'color' => 'green'
            ],
            [
                'id' => 4,
                'step' => 'Step 4',
                'title' => 'ADD TO CART',
                'description' => 'Add your order to the cart, to see the final estimated price.',
                'color' => 'blue'
            ],
            [
                'id' => 5,
                'step' => 'Step 5',
                'title' => 'CHECK OUT & PAYMENT',
                'description' => 'Proceed to check out and easily pay for your vehicle papers online using your card or via bank transfer, and rest assured that you\'re covered by our 100% MONEY-BACK guarantee. Once payment is confirmed, we\'ll process your papers within 24 - 48 hours, with proof of completion provided, and typically deliver within 72 hours.',
                'color' => 'indigo'
            ],
        ];
    }

    /**
     * Get the color code for a step
     */
    public function getStepColor($color)
    {
        $colors = [
            'red' => '#EF4444',
            'yellow' => '#FBBF24',
            'green' => '#10B981',
            'blue' => '#3B82F6',
            'indigo' => '#6366F1',
        ];
        return $colors[$color] ?? '#142444';
    }

    /**
     * Get the gradient style for step number
     */
    public function getStepGradient($color)
    {
        $gradients = [
            'red' => 'linear-gradient(135deg, #142444, #EF4444)',
            'yellow' => 'linear-gradient(135deg, #142444, #FBBF24)',
            'green' => 'linear-gradient(135deg, #142444, #10B981)',
            'blue' => 'linear-gradient(135deg, #142444, #3B82F6)',
            'indigo' => 'linear-gradient(135deg, #142444, #6366F1)',
        ];
        return $gradients[$color] ?? 'linear-gradient(135deg, #142444, #FBBF24)';
    }

    public function render()
    {
        return view('livewire.homepage.how-it-works');
    }
}