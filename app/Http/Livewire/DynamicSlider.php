<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DynamicSlider extends Component
{
    public $slides = [];
    public $currentSlide = 0;
    public $autoplay = true;
    public $interval = 5000;

    public function mount()
    {
        $this->slides = [
            [
                'image' => 'assets/img/Car_11.png',
                'title' => 'REGISTER AND RENEW YOUR GENUINE CAR PAPERS WITHIN',
                'highlight' => '72 HOURS',
                'subtitle' => '(With free doorstep delivery)',
                'bg_image' => 'assets-slide/img/bg/bg-01.png'
            ],
            [
                'image' => 'assets/img/Car_22.png',
                'title' => 'REGISTER AND RENEW YOUR GENUINE CAR PAPERS WITHIN',
                'highlight' => '72 HOURS',
                'subtitle' => '(With free doorstep delivery)',
                'bg_image' => 'assets-slide/img/bg/bg-01.png'
            ],
            [
                'image' => 'assets/img/Car_33.png',
                'title' => 'REGISTER AND RENEW YOUR GENUINE CAR PAPERS WITHIN',
                'highlight' => '72 HOURS',
                'subtitle' => '(With free doorstep delivery)',
                'bg_image' => 'assets-slide/img/bg/bg-01.png'
            ],
            [
                'image' => 'assets/img/Car_44.png',
                'title' => 'REGISTER AND RENEW YOUR GENUINE CAR PAPERS WITHIN',
                'highlight' => '72 HOURS',
                'subtitle' => '(With free doorstep delivery)',
                'bg_image' => 'assets-slide/img/bg/bg-01.png'
            ],
            [
                'image' => 'assets/img/Car_55.png',
                'title' => 'REGISTER AND RENEW YOUR GENUINE CAR PAPERS WITHIN',
                'highlight' => '72 HOURS',
                'subtitle' => '(With free doorstep delivery)',
                'bg_image' => 'assets-slide/img/bg/bg-01.png'
            ],
            [
                'image' => 'assets/img/Car_66.png',
                'title' => 'REGISTER AND RENEW YOUR GENUINE CAR PAPERS WITHIN',
                'highlight' => '72 HOURS',
                'subtitle' => '(With free doorstep delivery)',
                'bg_image' => 'assets-slide/img/bg/bg-01.png'
            ],
        ];
    }

    public function nextSlide()
    {
        $this->currentSlide = ($this->currentSlide + 1) % count($this->slides);
    }

    public function previousSlide()
    {
        $this->currentSlide = ($this->currentSlide - 1 + count($this->slides)) % count($this->slides);
    }

    public function goToSlide($index)
    {
        $this->currentSlide = $index;
    }

    public function toggleAutoplay()
    {
        $this->autoplay = !$this->autoplay;
    }

    public function getSlideStyles($slide)
    {
        return "background-image: url('" . asset($slide['bg_image']) . "'); background-size: cover; background-position: center;";
    }

    public function render()
    {
        return view('livewire.dynamic-slider');
    }
}