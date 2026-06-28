<?php

namespace App\Http\Livewire\Homepage;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\NewDriverLicense;
use App\Models\Order;
use Illuminate\Support\Str;

class DriverLicenseApplication extends Component
{
    // Form Steps
    public $step = 1;
    public $totalSteps = 6;
    
    // Personal Info (Step 1)
    public $surname = '';
    public $firstname = '';
    public $othername = '';
    public $gender = '';
    public $dob = '';
    public $place_of_birth = '';
    public $marital_status = '';
    public $nationality = 'Nigerian';
    public $address = '';
    
    // Personal Info Part 2 (Step 2)
    public $state_origin = '';
    public $lga_origin = '';
    public $phone = '';
    public $email = '';
    public $nin = '';
    public $occupation = '';
    public $mother_maiden_name = '';
    
    // Physical Info (Step 3)
    public $blood_group = '';
    public $height = '';
    
    // Next of Kin (Step 4)
    public $nok_phone = '';
    public $nok_nationality = 'Nigerian';
    
    // Payment
    public $service_fee = 15000;
    public $processing_fee = 0;
    public $total = 15000;
    public $order_reference = '';
    public $process_id = '';
    public $show_signup_prompt = false;
    
    // System State
    public $is_authenticated = false;
    public $all_lgas = [];
    public $filtered_lgas = [];

    // --------------------------
    // Validation Rules
    // --------------------------
    protected $rules = [
        'surname'              => 'required|string|max:100',
        'firstname'            => 'required|string|max:100',
        'othername'            => 'nullable|string|max:100',
        'gender'               => 'required|in:Male,Female',
        'dob'                  => 'required|date|before:today',
        'place_of_birth'       => 'required|string|max:100',
        'marital_status'       => 'required|in:Single,Married,Divorced,Widowed',
        'nationality'          => 'required|string|max:100',
        'address'              => 'required|string|max:500',
        'state_origin'         => 'required|string|max:100',
        'lga_origin'           => 'required|string|max:100',
        'phone'                => 'required|string|min:11|max:15',
        'email'                => 'required|email|max:100',
        'nin'                  => 'required|string|size:11',
        'occupation'           => 'required|string|max:100',
        'mother_maiden_name'   => 'required|string|max:100',
        'blood_group'          => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
        'height'               => 'required|numeric|min:50|max:250',
        'nok_phone'            => 'required|string|min:11|max:15',
        'nok_nationality'      => 'required|string|max:100',
    ];

    // Custom Messages
    protected $messages = [
        'required'          => 'This field is required.',
        'nin.size'          => 'NIN must be exactly 11 digits.',
        'dob.before'        => 'Date of birth must be in the past.',
        'height.min'        => 'Height must be at least 50cm.',
        'height.max'        => 'Height cannot exceed 250cm.',
        'phone.min'         => 'Phone number must be at least 11 digits.',
        'email.email'       => 'Please enter a valid email address.',
    ];

    // --------------------------
    // Real-Time Validation
    // --------------------------
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->is_authenticated = Auth::check();
        
        if ($this->is_authenticated) {
            $this->loadUserData();
        }

        // Initialize States & LGAs
        $this->all_lgas = [
            'Lagos'   => ['Agege', 'Ajeromi-Ifelodun', 'Alimosho', 'Amuwo-Odofin', 'Apapa', 'Eti-Osa', 'Ikeja', 'Ikorodu', 'Kosofe', 'Lagos Island', 'Lagos Mainland', 'Mushin', 'Ojo', 'Oshodi-Isolo', 'Surulere'],
            'Ogun'    => ['Abeokuta North', 'Abeokuta South', 'Ado-Odo/Ota', 'Ijebu North', 'Ijebu Ode', 'Ifo', 'Sagamu'],
            'Oyo'     => ['Ibadan North', 'Ibadan South-West', 'Ogbomosho North', 'Oyo East', 'Oyo West'],
            'Osun'    => ['Osogbo', 'Ilesa East', 'Ife Central', 'Ede North'],
            'Abia'    => ['Aba North', 'Aba South', 'Umuahia North', 'Umuahia South'],
            'Abuja'   => ['Abaji', 'Bwari', 'Gwagwalada', 'Kuje', 'Kwali', 'Municipal Area Council'],
            'Rivers'  => ['Port Harcourt', 'Obio-Akpor', 'Eleme', 'Ikwerre', 'Okrika'],
        ];

        if ($this->state_origin && isset($this->all_lgas[$this->state_origin])) {
            $this->filtered_lgas = $this->all_lgas[$this->state_origin];
        }
    }

    public function updatedStateOrigin($value)
    {
        $this->filtered_lgas = $this->all_lgas[$value] ?? [];
        $this->lga_origin = '';
        $this->resetErrorBag('lga_origin');
    }

    public function loadUserData()
    {
        $user = Auth::user();
        $profile = $user->profile ?? null;
        
        if ($profile) {
            $this->fill($profile->only(array_keys($this->rules)));
            $this->email = $user->email;
            
            if ($this->state_origin && isset($this->all_lgas[$this->state_origin])) {
                $this->filtered_lgas = $this->all_lgas[$this->state_origin];
            }
        }
    }

    public function getStepFields()
    {
        return [
            1 => ['surname', 'firstname', 'gender', 'dob', 'place_of_birth', 'marital_status', 'nationality', 'address'],
            2 => ['state_origin', 'lga_origin', 'phone', 'email', 'nin', 'occupation', 'mother_maiden_name'],
            3 => ['blood_group', 'height'],
            4 => ['nok_phone', 'nok_nationality'],
            5 => [],
            6 => [],
        ];
    }

    public function validateStep()
    {
        $fields = $this->getStepFields()[$this->step] ?? [];
        
        if (empty($fields)) return true;

        try {
            $this->validate(collect($this->rules)->only($fields)->toArray());
            return true;
        } catch (ValidationException $e) {
            return false;
        }
    }

    public function nextStep()
    {
        if ($this->validateStep()) {
            if ($this->step < $this->totalSteps) {
                $this->step++;
            }
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

    // --------------------------
    // UPDATED PAYMENT LOGIC
    // --------------------------
        public function processPayment()
{
    $this->order_reference = 'DL-' . strtoupper(Str::random(8));
    $this->process_id = 'NDL-' . strtoupper(Str::random(10));

    // Save application
    $application = NewDriverLicense::create([
        'process_id'           => $this->process_id,
        'surname'              => $this->surname,
        'firstname'            => $this->firstname,
        'othername'            => $this->othername,
        'gender'               => $this->gender,
        'dob'                  => $this->dob,
        'place_of_birth'       => $this->place_of_birth,
        'marital_status'       => $this->marital_status,
        'nationality'          => $this->nationality,
        'address'              => $this->address,
        'state_origin'         => $this->state_origin,
        'lga_origin'           => $this->lga_origin,
        'phone'                => $this->phone,
        'email'                => $this->email,
        'nin'                  => $this->nin,
        'occupation'           => $this->occupation,
        'mother_maiden_name'   => $this->mother_maiden_name,
        'blood_group'          => $this->blood_group,
        'height'               => $this->height,
        'nok_phone'            => $this->nok_phone,
        'nok_nationality'      => $this->nok_nationality,
        'totalamount'          => $this->total,
        'status'               => 'pending',
    ]);

    // Save order
    $order = Order::create([
        'user_id'         => $this->is_authenticated ? Auth::id() : null,
        'user_email'      => $this->email,
        'userType'        => $this->is_authenticated ? 'user' : 'guest',
        'order_number'    => $this->order_reference,
        'process_id'      => $this->process_id,
        'product_name'    => 'New Driver License',
        'product_amount'  => $this->service_fee,
        'product_qty'     => 1,
        'total'           => $this->total,
        'status'          => 'pending',
    ]);

    // Redirect to payment
    return redirect()->route('payment.initiate', [
        'orderNo'         => $this->order_reference,
        'total'           => $this->total,
        'fullname'        => trim($this->surname . ' ' . $this->firstname . ' ' . $this->othername),
        'email'           => $this->email,
        'process_id'      => $this->process_id,
        'process_type'    => 'New Driver License',
        'address'         => $this->address,
        'delivery_option' => 'email',
    ]);
}

    public function skipSignup()
    {
        $this->show_signup_prompt = false;
    }

    public function createAccount()
    {
        return redirect()->route('signup', [
            'email'           => $this->email,
            'surname'         => $this->surname,
            'firstname'       => $this->firstname,
            'order_reference' => $this->order_reference
        ]);
    }

    public function render()
    {
        return view('livewire.homepage.driver-license-application', [
            'lgas'       => $this->filtered_lgas,
            'all_states' => array_keys($this->all_lgas),
        ]);
    }
}