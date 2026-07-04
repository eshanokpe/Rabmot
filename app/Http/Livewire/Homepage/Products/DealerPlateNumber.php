<?php

namespace App\Http\Livewire\Homepage\Products;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Livewire\Homepage\Products\Concerns\ResolvesApplicantAccount;
use App\Models\DealerPlateNumber as DealerPlateNumberModel;
use App\Models\DealersPlateNumberPrice;
use App\Models\Order;
use Illuminate\Support\Str;

class DealerPlateNumber extends Component
{
    use WithFileUploads;
    use ResolvesApplicantAccount;

    public $step = 1;
    public $totalSteps = 5;

    // Personal Info
    public $fullname        = '';
    public $gender          = '';
    public $dateofbirth     = '';
    public $placeofbirth    = '';
    public $phonenumber     = '';
    public $email           = '';
    public $state           = '';
    public $localgovernment = '';
    public $address         = '';

    // Company Info
    public $companyName = '';

    // Documents
    public $passport;
    public $caccertificate;
    public $companyletterhead;
    public $means_of_id;

    // Payment & System
    public $service_fee    = 0;
    public $processing_fee = 0;
    public $total          = 0;
    public $process_id     = '';
    public $order_reference = '';
    public $is_authenticated = false;

    protected function rules()
    {
        return [
            'fullname'        => 'required|string|max:255',
            'gender'          => 'required|in:Male,Female',
            'dateofbirth'     => 'required|date|before:today',
            'placeofbirth'    => 'required|string|max:100',
            'phonenumber'     => 'required|string|min:11|max:15',
            'email'           => 'required|email|max:150',
            'state'           => 'required|string|max:100',
            'localgovernment' => 'required|string|max:100',
            'address'         => 'required|string|max:500',
            'companyName'     => 'required|string|max:255',
            'passport'        => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'caccertificate'  => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'companyletterhead' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'means_of_id'     => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ];
    }

    protected function messages()
    {
        return [
            'required'           => 'This field is required.',
            'dateofbirth.before' => 'Date of birth must be in the past.',
            'phonenumber.min'    => 'Phone number must be at least 11 digits.',
            'mimes'              => 'Allowed formats: JPG, PNG, PDF.',
            'max'                => 'File size cannot exceed 2MB.',
        ];
    }

    protected $stateIds = [
        'Lagos'  => 1, 'Abuja' => 2, 'Abia'  => 3,
        'Rivers' => 4, 'Ogun'  => 5, 'Oyo'   => 6, 'Osun' => 7,
    ];

    public function mount()
    {
        $this->is_authenticated = Auth::check();
        if ($this->is_authenticated) {
            $user = Auth::user();
            $this->email      = $user->email;
            $this->phonenumber = $user->phone ?? '';
        }
    }

    public function updatedState($value)
    {
        $this->loadPrice();
    }

    protected function loadPrice()
    {
        $stateId = $this->stateIds[$this->state] ?? null;
        if (!$stateId) {
            $this->service_fee = 0;
            $this->total       = 0;
            return;
        }
        $row = DealersPlateNumberPrice::where('state_id', $stateId)->first();
        if ($row) {
            $this->service_fee    = (int) $row->amount;
            $this->processing_fee = 0;
            $this->total          = (int) $row->amount;
        }
    }

    protected function getStepFields()
    {
        return [
            1 => [],
            2 => ['fullname', 'gender', 'dateofbirth', 'placeofbirth', 'phonenumber', 'email', 'state', 'localgovernment', 'address', 'companyName'],
            3 => ['passport', 'caccertificate', 'companyletterhead', 'means_of_id'],
            4 => [],
            5 => [],
        ];
    }

    protected function validateStep()
    {
        // Step 3: files are already validated by Livewire at upload time.
        // Just confirm all four are present.
        if ($this->step === 3) {
            $errors = [];
            if (!$this->passport)          $errors['passport']          = 'Passport photograph is required.';
            if (!$this->caccertificate)    $errors['caccertificate']    = 'CAC Certificate is required.';
            if (!$this->companyletterhead) $errors['companyletterhead'] = 'Company Letterhead is required.';
            if (!$this->means_of_id)       $errors['means_of_id']       = 'Means of Identification is required.';

            if (!empty($errors)) {
                $this->setErrorBag($errors);
                return false;
            }
            return true;
        }

        $fields = $this->getStepFields()[$this->step] ?? [];
        if (empty($fields)) return true;

        try {
            $this->validate(collect($this->rules())->only($fields)->toArray(), $this->messages());
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
        if ($this->step > 1) $this->step--;
    }

    public function goToStep($step)
    {
        if ($step >= 1 && $step <= $this->totalSteps) {
            $this->step = $step;
        }
    }

    public function processPayment()
    {
        $this->process_id      = 'DPN-' . strtoupper(Str::random(10));
        $this->order_reference = 'DPN-' . strtoupper(Str::random(6));

        $userId = $this->resolveApplicantUserId(
            $this->fullname,
            $this->email,
            $this->phonenumber,
            "Dealer's Plate Number",
            $this->process_id,
            $this->total
        );

        if ($userId === null) {
            return;
        }

        $documents = [
            'passport'          => 'Passport photograph',
            'caccertificate'    => 'CAC certificate',
            'companyletterhead' => 'Company letterhead',
            'means_of_id'       => 'Means of identification',
        ];

        foreach ($documents as $prop => $label) {
            if (!($this->{$prop} instanceof \Livewire\TemporaryUploadedFile)) {
                session()->flash('error', "Your $label upload didn't attach correctly. Please re-upload it and try again.");
                $this->goToStep(3);
                return;
            }
        }

        try {
            $passportPath     = $this->passport->store('uploads/dealer_plate', 'public');
            $cacPath          = $this->caccertificate->store('uploads/dealer_plate', 'public');
            $letterheadPath   = $this->companyletterhead->store('uploads/dealer_plate', 'public');
            $meansOfIdPath    = $this->means_of_id->store('uploads/dealer_plate', 'public');

            DealerPlateNumberModel::create([
                'process_id'       => $this->process_id,
                'process_type'     => "Dealer's Plate Number",
                'user_id'          => $userId,
                'user_email'       => $this->email,
                'userType'         => 'user',
                'fullname'         => $this->fullname,
                'gender'           => $this->gender,
                'dateofbirth'      => $this->dateofbirth,
                'placeofbirth'     => $this->placeofbirth,
                'phonenumber'      => $this->phonenumber,
                'email'            => $this->email,
                'state'            => $this->state,
                'localgovernment'  => $this->localgovernment,
                'address'          => $this->address,
                'companyName'      => $this->companyName,
                'passport'         => $passportPath,
                'caccertificate'   => $cacPath,
                'companyletterhead'=> $letterheadPath,
                'payment_status'   => 'unpaid',
                'totalamount'      => $this->total,
            ]);

            Order::create([
                'user_id'        => $userId,
                'user_email'     => $this->email,
                'userType'       => 'user',
                'order_number'   => $this->order_reference,
                'process_id'     => $this->process_id,
                'product_name'   => "Dealer's Plate Number",
                'product_amount' => $this->service_fee,
                'product_qty'    => 1,
                'total'          => $this->total,
                'status'         => 'pending',
            ]);

            return redirect()->route('payment.initiate', [
                'orderNo'         => $this->order_reference,
                'total'           => $this->total,
                'fullname'        => $this->fullname,
                'email'           => $this->email,
                'process_id'      => $this->process_id,
                'process_type'    => "Dealer's Plate Number",
                'address'         => $this->address,
                'delivery_option' => 'email',
            ]);

        } catch (\Exception $e) {
            \Log::error('Dealer Plate Number Error: ' . $e->getMessage());
            session()->flash('error', 'Could not submit your application. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.homepage.products.dealer-plate-number');
    }
}
