<?php

namespace App\Http\Livewire\Homepage;

use Livewire\Component;

class Testimonials extends Component
{
    public $testimonials = [];
    public $currentSlide = 0;
    public $slidesPerView = 2;

    public function mount()
    {
        $this->testimonials = [
            [
                'id' => 1,
                'name' => 'Mr. Gaklime Keputda',
                'designation' => 'Entrepreneur',
                'image' => 'assets/img/mrge.jpg',
                'review' => 'Service was very good and fast. Would recommend them to anyone looking to renew their papers.'
            ],
            [
                'id' => 2,
                'name' => 'Ms Bunmi',
                'designation' => 'Entrepreneur',
                'image' => 'assets/img/msBunm.jpg',
                'review' => 'Rabmot licensing is very good at what they do. Their delivery time is good and they carry you along the process. And it is also affordable.'
            ],
            [
                'id' => 3,
                'name' => 'Ms. Precious Afinni',
                'designation' => 'Realtor',
                'image' => 'assets/img/MsaffP.jpg',
                'review' => 'Amazing job, well done despite not meeting you physically my documents was delivered to me.'
            ],
            [
                'id' => 4,
                'name' => 'Ms. George Oyindamola',
                'designation' => 'Telecom Infrastructure Specialist',
                'image' => 'assets/img/msOyin.jpg',
                'review' => 'Saves the hassle and stress of thinking of how to get your car papers done. Super efficient and also the issue of having to go to the LACVIS office is solved by their Pick and Drop Service.'
            ],
            [
                'id' => 5,
                'name' => 'Mr. Olamilekan',
                'designation' => 'Entrepreneur',
                'image' => 'assets/img/mrOla.jpg',
                'review' => 'Top notch service. They handled my drivers license from start to finish and delivered on time.'
            ],
            [
                'id' => 6,
                'name' => 'Mr. Williams Oyindamola',
                'designation' => 'Auto Dealer',
                'image' => 'assets/img/WillOyin.jpg',
                'review' => 'Amazing job, well done despite not meeting you physically my documents was delivered to me.'
            ],
            [
                'id' => 7,
                'name' => 'Mr. Shoyode Abdelaziz',
                'designation' => 'Entrepreneur',
                'image' => 'assets/img/Mr.sha.jpg',
                'review' => 'Your company is doing a great job which I really love you guys for that…and I\'m happy to know you and I\'m glad working with you guys keep the good work I will keep recommending you guys.'
            ],
            [
                'id' => 8,
                'name' => 'Mrs. Erhabor Precious',
                'designation' => 'Beautician',
                'image' => 'assets/img/Mrs.EP.jpg',
                'review' => 'Always on time, I was shocked to know I could get my papers in 2 days, something I usually beg and fight other vendors for months. Really amazing people here.'
            ],
            [
                'id' => 9,
                'name' => 'Mr. Akintayo Peters',
                'designation' => 'Engineer',
                'image' => 'assets/img/akinP.jpg',
                'review' => 'Service was very good and fast. Would recommend them to anyone looking to renew their papers.'
            ],
            [
                'id' => 10,
                'name' => 'Wiz Writer',
                'designation' => 'Copy Writer',
                'image' => 'assets/img/2nnd.jpg',
                'review' => 'Good service with good communication.'
            ],
            [
                'id' => 11,
                'name' => 'Donald Asakitikp',
                'designation' => 'Veterinary Doctor',
                'image' => 'assets/img/mrDonald.jpg',
                'review' => 'Service is prompt. Customer feedback is instant. Professionalism is evident and packaging is top notch. Will easily recommend this service provider to anyone.'
            ],
        ];
    }

    public function nextSlide()
    {
        $totalSlides = ceil(count($this->testimonials) / $this->slidesPerView);
        $this->currentSlide = ($this->currentSlide + 1) % $totalSlides;
    }

    public function previousSlide()
    {
        $totalSlides = ceil(count($this->testimonials) / $this->slidesPerView);
        $this->currentSlide = ($this->currentSlide - 1 + $totalSlides) % $totalSlides;
    }

    public function goToSlide($index)
    {
        $this->currentSlide = $index;
    }

    public function getVisibleTestimonials()
    {
        $start = $this->currentSlide * $this->slidesPerView;
        return array_slice($this->testimonials, $start, $this->slidesPerView);
    }

    public function render()
    {
        return view('livewire.homepage.testimonials', [
            'visibleTestimonials' => $this->getVisibleTestimonials(),
            'totalSlides' => ceil(count($this->testimonials) / $this->slidesPerView)
        ]);
    }
}