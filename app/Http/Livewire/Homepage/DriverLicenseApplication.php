<?php

namespace App\Http\Livewire\Homepage;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use App\Models\NewDriverLicense;
use App\Models\Order;
use Illuminate\Support\Str;

class DriverLicenseApplication extends Component
{
    private const NIGERIAN_STATES = [
        'Abia', 'Adamawa', 'Akwa Ibom', 'Anambra', 'Bauchi', 'Bayelsa', 'Benue',
        'Borno', 'Cross River', 'Delta', 'Ebonyi', 'Edo', 'Ekiti', 'Enugu',
        'Federal Capital Territory', 'Gombe', 'Imo', 'Jigawa', 'Kaduna', 'Kano',
        'Katsina', 'Kebbi', 'Kogi', 'Kwara', 'Lagos', 'Nasarawa', 'Niger',
        'Ogun', 'Ondo', 'Osun', 'Oyo', 'Plateau', 'Rivers', 'Sokoto', 'Taraba',
        'Yobe', 'Zamfara',
    ];

    // Form Steps
    public $step = 1;
    public $totalSteps = 6;
    
    // Personal Info (Step 1)
    public $surname = '';
    public $firstname = '';
    public $middlename = '';
    public $gender = '';
    public $dob = '';
    public $place_of_birth_state = '';
    public $lga_place_of_birth = '';
    public $marital_status = '';
    public $nationality = 'Nigerian';
    public $address = '';
    public $address_localgovernment = '';
    
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
    // --------------------------
    // Validation Rules
    // --------------------------
    protected function rules(): array
    {
        return [
            'surname'                 => 'required|string|max:100',
            'firstname'               => 'required|string|max:100',
            'middlename'              => 'nullable|string|max:100',
            'gender'                  => 'required|in:Male,Female',
            'dob'                     => 'required|date|before:today',
            'place_of_birth_state'    => ['required', Rule::in(self::NIGERIAN_STATES)],
            'state_origin'            => ['required', Rule::in(self::NIGERIAN_STATES)],
            'lga_place_of_birth'      => 'required|string|max:100',
            'marital_status'          => 'required|in:Single,Married,Divorced,Widowed',
            'nationality'             => 'required|string|max:100',
            'address'                 => 'required|string|max:500',
            'address_localgovernment' => 'required|string|max:100',
            'lga_origin'              => 'required|string|max:100',
            'phone'                   => 'required|string|min:11|max:15',
            'email'                   => 'required|email|max:100',
            'nin'                     => 'required|string|size:11',
            'occupation'              => 'required|string|max:100',
            'mother_maiden_name'      => 'required|string|max:100',
            'blood_group'             => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'height'                  => 'required|numeric|min:50|max:250',
            'nok_phone'               => 'required|string|min:11|max:15',
            'nok_nationality'         => 'required|string|max:100',
        ];
    }

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

    }

    public function loadUserData()
    {
        $user = Auth::user();
        $profile = $user->profile ?? null;

        if ($profile) {
            $this->fill($profile->only(array_keys($this->rules())));
        }

        $this->email = $user->email;
    }

    public function getStepFields()
    {
        return [
            1 => ['surname', 'firstname', 'middlename', 'gender', 'dob', 'place_of_birth_state', 'lga_place_of_birth', 'marital_status', 'nationality', 'address', 'address_localgovernment'],
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
            $this->validate(collect($this->rules())->only($fields)->toArray());
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
    // FIXED PAYMENT LOGIC
    // --------------------------
    public function processPayment()
    {
        $this->validate();

        $this->order_reference = 'DL-' . strtoupper(Str::random(8));
        $this->process_id = 'NDL-' . strtoupper(Str::random(10));

        NewDriverLicense::create([
            'user_id'                  => $this->is_authenticated ? Auth::id() : null,
            'user_email'               => $this->email,
            'userType'                 => $this->is_authenticated ? 'user' : 'guest',
            'process_id'               => $this->process_id,
            'process_type'             => 'New Driver License',
            'firstname'                => $this->firstname,
            'middlename'               => $this->middlename,
            'lastname'                 => $this->surname,
            'mothermaidenname'         => $this->mother_maiden_name,
            'email'                    => $this->email,
            'nationality'              => $this->nationality,
            'occupation'               => $this->occupation,
            'gender'                   => $this->gender,
            'dateofbirth'              => $this->dob,
            'maritalstatus'            => $this->marital_status,
            'nin'                      => $this->nin,
            'state'                    => $this->state_origin,
            'localgovernment'          => $this->lga_origin,
            'placeofbirthstate'        => $this->place_of_birth_state,
            'localgovtplaceofbirth'    => $this->lga_place_of_birth,
            'address'                  => $this->address,
            'addresslocalgovernment'   => $this->address_localgovernment,
            'phonenumber'              => $this->phone,
            'bloodgroup'               => $this->blood_group,
            'height'                   => $this->height,
            'nextofkinphonenumber'     => $this->nok_phone,
            'totalamount'              => $this->total,
            'payment_status'           => 0,
            'status'                   => 'pending',
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

        // Store the order reference and process ID in session for the payment callback
        session([
            'pending_order_ref' => $this->order_reference,
            'pending_process_id' => $this->process_id,
            'pending_service' => 'New Driver License',
            'pending_amount' => $this->total,
        ]);

        // Redirect to payment page
        return redirect()->route('payment.initiate', [
            'orderNo'         => $this->order_reference,
            'total'           => $this->total,
            'fullname'        => trim($this->surname . ' ' . $this->firstname . ' ' . $this->middlename),
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
            'all_states' => self::NIGERIAN_STATES,
        ]);
    }
}