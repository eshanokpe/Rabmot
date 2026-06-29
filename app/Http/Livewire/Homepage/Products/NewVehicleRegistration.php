<?php

namespace App\Http\Livewire\Homepage\Products;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\VehicleRegistration;
use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class NewVehicleRegistration extends Component
{
    use WithFileUploads;

    // Step control
    public $step = 1;
    public $totalSteps = 6;

    // Owner Info
    public $surname = '';
    public $firstname = '';
    public $othername = '';
    public $gender = '';
    public $marital_status = '';
    public $dob = '';
    public $address = '';
    public $lga = '';
    public $state = 'Lagos';
    public $phone = '';
    public $email = '';
    public $nin = '';

    // Vehicle Info
    public $chassis_number = '';
    public $engine_number = '';
    public $vehicle_make = '';
    public $vehicle_model = '';
    public $year = '';
    public $color = '';
    public $fuel_type = '';

    // Documents
    public $doc_custom_papers;
    public $doc_chassis_photo;
    public $doc_nin_slip;
    public $doc_address_proof;

    // Payment & System
    public $service_fee = 35000;
    public $processing_fee = 2500;
    public $total = 37500;
    public $order_reference = '';
    public $process_id = '';
    public $show_signup_prompt = false;
    public $is_authenticated = false;
    public $lagos_lgas = [];
    public $vehicle_makes = [];

    /**
     * Validation Rules
     */
    protected function rules()
    {
        return [
            'surname'              => 'required|string|max:100',
            'firstname'            => 'required|string|max:100',
            'othername'            => 'nullable|string|max:100',
            'gender'               => 'required|in:Male,Female',
            'marital_status'       => 'required|in:Single,Married,Divorced,Widowed',
            'dob'                  => 'required|date|before:today',
            'address'              => 'required|string|max:500',
            'lga'                  => 'required|string|max:100',
            'state'                => 'required|string|max:50',
            'phone'                => 'required|string|min:11|max:15',
            'email'                => 'required|email|max:100',
            'nin'                  => 'required|string|size:11',

            'chassis_number'       => 'required|string|min:6|max:50',
            'engine_number'        => 'required|string|min:6|max:50',
            'vehicle_make'         => 'required|string|max:100',
            'vehicle_model'        => 'required|string|max:100',
            'year'                 => 'required|digits:4|max:' . date('Y'),
            'color'                => 'required|string|max:50',
            'fuel_type'            => 'required|in:Petrol,Diesel,Electric,Hybrid',

            'doc_custom_papers'    => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'doc_chassis_photo'    => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'doc_nin_slip'         => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'doc_address_proof'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ];
    }

    /**
     * ✅ FIXED: Use method instead of property to allow dynamic values
     */
    protected function messages()
    {
        return [
            'required'          => 'This field is required.',
            'nin.size'          => 'NIN must be exactly 11 digits.',
            'dob.before'        => 'Date of birth must be in the past.',
            'year.max'          => 'Year cannot be later than ' . date('Y'),
            'doc_custom_papers.max' => 'File size cannot exceed 2MB.',
            'mimes'             => 'Only JPG, PNG and PDF files are allowed.',
        ];
    }

    public function mount()
    {
        $this->is_authenticated = Auth::check();

        if ($this->is_authenticated) {
            $user = Auth::user();
            $this->email = $user->email;
            $this->phone = $user->phone ?? '';
        }

        $this->lagos_lgas = [
            'Agege', 'Ajeromi-Ifelodun', 'Alimosho', 'Amuwo-Odofin', 'Apapa',
            'Eti-Osa', 'Ikeja', 'Ikorodu', 'Kosofe', 'Lagos Island',
            'Lagos Mainland', 'Mushin', 'Ojo', 'Oshodi-Isolo', 'Surulere'
        ];

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
            2 => ['surname', 'firstname', 'gender', 'marital_status', 'dob', 'address', 'lga', 'state', 'phone', 'email', 'nin'],
            3 => ['chassis_number', 'engine_number', 'vehicle_make', 'vehicle_model', 'year', 'color', 'fuel_type'],
            4 => ['doc_custom_papers', 'doc_chassis_photo', 'doc_nin_slip', 'doc_address_proof'],
            5 => [],
            6 => [],
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

    public function processPayment()
    {
        $this->order_reference = 'VR-LAG-' . strtoupper(Str::random(6));
        $this->process_id = 'VR-LAG-' . strtoupper(Str::random(10));

        try {
            $customPath = $this->doc_custom_papers->store('uploads/vehicle_reg', 'public');
            $chassisPath = $this->doc_chassis_photo->store('uploads/vehicle_reg', 'public');
            $ninPath = $this->doc_nin_slip->store('uploads/vehicle_reg', 'public');
            $addressPath = $this->doc_address_proof ? $this->doc_address_proof->store('uploads/vehicle_reg', 'public') : null;

            VehicleRegistration::create([
                'process_id'           => $this->process_id,
                'process_type'         => 'New Vehicle Registration (Lagos)',
                'user_id'              => $this->is_authenticated ? Auth::id() : null,
                'user_email'           => $this->email,
                'userType'             => $this->is_authenticated ? 'user' : 'guest',
                'totalamount'          => $this->total,
                'payment_status'       => 'unpaid',
                'status'               => 'pending',

                'fullname'             => trim($this->surname . ' ' . $this->firstname . ' ' . $this->othername),
                'gender'               => $this->gender,
                'marital_status'       => $this->marital_status,
                'dob'                  => $this->dob,
                'address'              => $this->address,
                'lga'                  => $this->lga,
                'state'                => $this->state,
                'phone'                => $this->phone,
                'email'                => $this->email,
                'nin'                  => $this->nin,
                'chassis_number'       => $this->chassis_number,
                'engine_number'        => $this->engine_number,
                'vehicle_make'         => $this->vehicle_make,
                'vehicle_model'        => $this->vehicle_model,
                'year'                 => $this->year,
                'color'                => $this->color,
                'fuel_type'            => $this->fuel_type,
                'doc_custom_papers'    => $customPath,
                'doc_chassis_photo'    => $chassisPath,
                'doc_nin_slip'         => $ninPath,
                'doc_address_proof'    => $addressPath,
            ]);

            Order::create([
                'user_id'         => $this->is_authenticated ? Auth::id() : null,
                'user_email'      => $this->email,
                'userType'        => $this->is_authenticated ? 'user' : 'guest',
                'order_number'    => $this->order_reference,
                'process_id'      => $this->process_id,
                'product_name'    => 'New Vehicle Registration (Lagos)',
                'product_amount'  => $this->service_fee,
                'product_qty'     => 1,
                'total'           => $this->total,
                'status'          => 'pending',
            ]);

            return redirect()->route('payment.initiate', [
                'orderNo'         => $this->order_reference,
                'total'           => $this->total,
                'fullname'        => trim($this->surname . ' ' . $this->firstname . ' ' . $this->othername),
                'email'           => $this->email,
                'process_id'      => $this->process_id,
                'process_type'    => 'New Vehicle Registration (Lagos)',
                'address'         => $this->address,
                'delivery_option' => 'email',
            ]);

        } catch (\Exception $e) {
            \Log::error('Vehicle Registration Error: ' . $e->getMessage());
            session()->flash('error', 'We could not submit your application. Please check your details and try again.');
            return redirect()->back();
        }
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
        return view('livewire.homepage.products.new-vehicle-registration', [
            'lagos_lgas'     => $this->lagos_lgas,
            'vehicle_makes'  => $this->vehicle_makes,
        ]);
    } 
}