<?php

namespace App\Http\Livewire\Homepage\Products;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Models\ChangeOfOwnership;
use App\Models\Order;

class ChangeOfOwnershipService extends Component
{
    use WithFileUploads;

    // Step control
    public $step = 1;
    public $totalSteps = 8;

    // Step 2: New Owner Info
    public $fullname = '';
    public $date_of_birth = '';
    public $place_of_birth = '';
    public $address = '';
    public $lga = '';
    public $state = 'Lagos';
    public $phonenumber = '';
    public $emailaddress = '';

    // Step 3: Vehicle Info
    public $chassis_number = '';
    public $engine_number = '';
    public $vehicle_make = '';
    public $vehicle_color = '';

    // Step 4: Documents
    public $proofofownership;
    public $vehiclelicensepapers;
    public $road_worthiness_paper;
    public $agreement;
    public $chassis_image;
    public $nin_slip;

    // System & Pricing
    public $process_id = '';
    public $order_reference = '';
    public $service_fee = 39500;
    public $processing_fee = 2500;
    public $totalamount = 42000;
    public $is_authenticated = false;
    public $show_signup_prompt = false;
    public $lagos_lgas = [];
    public $vehicle_makes = [];

    /**
     * Validation Rules
     */
    protected function rules()
    {
        return [
            'fullname'        => 'required|string|max:255',
            'date_of_birth'   => 'required|date|before:today',
            'place_of_birth'  => 'required|string|max:100',
            'address'         => 'required|string|max:500',
            'lga'             => 'required|string|max:100',
            'state'           => 'required|string|max:50',
            'phonenumber'     => 'required|string|min:11|max:20',
            'emailaddress'    => 'required|email|max:150',

            'chassis_number'  => 'required|string|min:6|max:100',
            'engine_number'   => 'required|string|min:6|max:100',
            'vehicle_make'    => 'required|string|max:100',
            'vehicle_color'   => 'required|string|max:50',

            'proofofownership'       => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'vehiclelicensepapers'   => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'road_worthiness_paper'  => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'agreement'              => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'chassis_image'          => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'nin_slip'               => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ];
    }

    /**
     * Custom Messages
     */
    protected function messages()
    {
        return [
            'required'          => 'This field is required.',
            'emailaddress.email' => 'Please enter a valid email address.',
            'phonenumber.min'   => 'Phone number must be at least 11 digits.',
            'date_of_birth.before' => 'Date of birth must be in the past.',
            'mimes'             => 'Allowed formats: JPG, PNG, PDF.',
            'max'               => 'File size cannot exceed 2MB.',
        ];
    }

    public function mount()
    {
        $this->is_authenticated = Auth::check();
        if ($this->is_authenticated) {
            $user = Auth::user();
            $this->emailaddress = $user->email;
            $this->phonenumber = $user->phone ?? '';
        }

        // Lagos LGAs
        $this->lagos_lgas = [
            'Agege', 'Ajeromi-Ifelodun', 'Alimosho', 'Amuwo-Odofin', 'Apapa',
            'Eti-Osa', 'Ikeja', 'Ikorodu', 'Kosofe', 'Lagos Island',
            'Lagos Mainland', 'Mushin', 'Ojo', 'Oshodi-Isolo', 'Surulere'
        ];

        // Vehicle Makes
        $this->vehicle_makes = [
            'Toyota', 'Honda', 'Nissan', 'Mitsubishi', 'Ford', 'Hyundai',
            'Kia', 'Volkswagen', 'Mercedes-Benz', 'Lexus', 'Chevrolet', 'Peugeot', 'Other'
        ];
    }

    /**
     * Real-time validation
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, $this->rules(), $this->messages());
    }

    public function getStepFields()
    {
        return [
            1 => [],
            2 => ['fullname', 'date_of_birth', 'place_of_birth', 'address', 'lga', 'state', 'phonenumber', 'emailaddress'],
            3 => ['chassis_number', 'engine_number', 'vehicle_make', 'vehicle_color'],
            4 => ['proofofownership', 'vehiclelicensepapers', 'road_worthiness_paper', 'agreement', 'chassis_image', 'nin_slip'],
            5 => [],
            6 => [],
            7 => [],
            8 => [],
        ];
    }

    public function validateStep()
    {
        $fields = $this->getStepFields()[$this->step] ?? [];
        if (empty($fields)) return true;

        try {
            $stepRules = collect($this->rules())->only($fields)->toArray();
            $this->validate($stepRules, $this->messages());
            return true;
        } catch (ValidationException $e) {
            return false;
        }
    }

    public function nextStep()
    {
        if ($this->validateStep() && $this->step < $this->totalSteps) {
            $this->step++;
        }
    }

    public function previousStep()
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function goToStep($step)
    {
        if ($step < 1 || $step > $this->totalSteps) return;
        if ($step > $this->step && !$this->validateStep()) return;
        $this->step = $step;
    }

    public function proceedToReview()
    {
        if ($this->validateStep()) {
            $this->step = 5;
        }
    }

    public function processPayment()
    {
        $this->process_id = 'COO-LAG-' . Str::upper(Str::random(10));
        $this->order_reference = 'COO-LAG-' . Str::upper(Str::random(6));

        try {
            // Store files
            $proofPath = $this->proofofownership->store('uploads/coo', 'public');
            $licensePath = $this->vehiclelicensepapers->store('uploads/coo', 'public');
            $roadworthyPath = $this->road_worthiness_paper->store('uploads/coo', 'public');
            $agreementPath = $this->agreement->store('uploads/coo', 'public');
            $chassisImgPath = $this->chassis_image->store('uploads/coo', 'public');
            $ninPath = $this->nin_slip->store('uploads/coo', 'public');

            // Save application
            ChangeOfOwnership::create([
                'process_id'           => $this->process_id,
                'process_type'         => 'Change of Ownership & Re-Registration',
                'user_id'              => $this->is_authenticated ? Auth::id() : null,
                'user_email'           => $this->emailaddress,
                'userType'             => $this->is_authenticated ? 'user' : 'guest',
                'fullname'             => $this->fullname,
                'date_of_birth'        => $this->date_of_birth,
                'place_of_birth'       => $this->place_of_birth,
                'address'              => $this->address,
                'lga'                  => $this->lga,
                'state'                => $this->state,
                'phonenumber'          => $this->phonenumber,
                'emailaddress'         => $this->emailaddress,
                'chassis_number'       => $this->chassis_number,
                'engine_number'        => $this->engine_number,
                'vehicle_make'         => $this->vehicle_make,
                'vehicle_color'        => $this->vehicle_color,
                'proofofownership'     => $proofPath,
                'vehiclelicensepapers' => $licensePath,
                'road_worthiness_paper'=> $roadworthyPath,
                'agreement'            => $agreementPath,
                'chassis_image'        => $chassisImgPath,
                'nin_slip'             => $ninPath,
                'totalamount'          => $this->totalamount,
                'payment_status'       => 'unpaid',
                'status'               => 'pending',
            ]);

            // Create order
            Order::create([
                'user_id'        => $this->is_authenticated ? Auth::id() : null,
                'user_email'     => $this->emailaddress,
                'order_number'   => $this->order_reference,
                'process_id'     => $this->process_id,
                'product_name'   => 'Change of Ownership & Re-Registration',
                'product_amount' => $this->service_fee,
                'total'          => $this->totalamount,
                'status'         => 'pending',
            ]);

            // Go to payment step
            $this->step = 6;

        } catch (\Exception $e) {
            \Log::error('COO Error: ' . $e->getMessage());
            session()->flash('error', 'Could not submit application. Please check your details.');
        }
    }

    public function paymentSuccessful()
    {
        $this->step = 7; // Show sign-up prompt
    }

    public function skipSignup()
    {
        $this->show_signup_prompt = false;
        $this->step = 8; // Go to confirmation
    }

    public function createAccount()
    {
        return redirect()->route('signup', [
            'email'     => $this->emailaddress,
            'fullname'  => $this->fullname,
            'order_ref' => $this->order_reference
        ]);
    }

    public function render()
    {
        
        return view('livewire.homepage.products.change-of-ownership', [
            'lagos_lgas'    => $this->lagos_lgas,
            'vehicle_makes' => $this->vehicle_makes,
        ]);
    }
}