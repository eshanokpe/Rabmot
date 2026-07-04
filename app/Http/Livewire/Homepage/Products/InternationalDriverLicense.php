<?php

namespace App\Http\Livewire\Homepage\Products;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Livewire\Homepage\Products\Concerns\ResolvesApplicantAccount;
use App\Models\InternationalDriverLicense as InternationalDriverLicenseModel;
use App\Models\InternationalDriverLicensePrice;
use App\Models\Order;
use Illuminate\Support\Str;

class InternationalDriverLicense extends Component
{
    use WithFileUploads;
    use ResolvesApplicantAccount;

    public $step = 1;
    public $totalSteps = 5;

    // Personal Info
    public $firstname       = '';
    public $middlename      = '';
    public $lastname        = '';
    public $gender          = '';
    public $maritalstatus   = '';
    public $dateofbirth     = '';
    public $localgovtplaceofbirth = '';
    public $address         = '';
    public $state           = 'Lagos';
    public $localgovernment = '';
    public $phonenumber     = '';
    public $email           = '';
    public $country_destination = '';
    public $license_number  = '';
    public $license_expiry  = '';

    // Document
    public $passport;

    // Payment & System
    public $service_fee    = 0;
    public $processing_fee = 0;
    public $total          = 0;
    public $process_id     = '';
    public $order_reference = '';
    public $is_authenticated = false;
    public $lagos_lgas = [];

    protected function rules()
    {
        return [
            'firstname'           => 'required|string|max:100',
            'lastname'            => 'required|string|max:100',
            'middlename'          => 'nullable|string|max:100',
            'gender'              => 'required|in:Male,Female',
            'maritalstatus'       => 'required|in:Single,Married,Divorced,Widowed',
            'dateofbirth'         => 'required|date|before:today',
            'localgovtplaceofbirth' => 'required|string|max:100',
            'address'             => 'required|string|max:500',
            'localgovernment'     => 'required|string|max:100',
            'phonenumber'         => 'required|string|min:11|max:15',
            'email'               => 'required|email|max:150',
            'country_destination' => 'required|string|max:100',
            'license_number'      => 'required|string|max:50',
            'license_expiry'      => 'required|date|after:today',
            'passport'            => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    protected function messages()
    {
        return [
            'required'                 => 'This field is required.',
            'dateofbirth.before'       => 'Date of birth must be in the past.',
            'license_expiry.after'     => 'License expiry must be a future date.',
            'passport.mimes'           => 'Only JPG and PNG files are allowed.',
            'passport.max'             => 'Passport photo cannot exceed 2MB.',
            'phonenumber.min'          => 'Phone number must be at least 11 digits.',
        ];
    }

    public function mount()
    {
        $this->is_authenticated = Auth::check();
        if ($this->is_authenticated) {
            $user = Auth::user();
            $this->email      = $user->email;
            $this->phonenumber = $user->phone ?? '';
        }

        $this->lagos_lgas = [
            'Agege', 'Ajeromi-Ifelodun', 'Alimosho', 'Amuwo-Odofin', 'Apapa',
            'Eti-Osa', 'Ikeja', 'Ikorodu', 'Kosofe', 'Lagos Island',
            'Lagos Mainland', 'Mushin', 'Ojo', 'Oshodi-Isolo', 'Surulere',
        ];

        $priceRow = InternationalDriverLicensePrice::where('state_id', 1)->first();
        if ($priceRow) {
            $this->service_fee    = (int) $priceRow->amount;
            $this->processing_fee = 0;
            $this->total          = (int) $priceRow->amount;
        }
    }

    protected function getStepFields()
    {
        return [
            1 => [],
            2 => ['firstname', 'lastname', 'gender', 'maritalstatus', 'dateofbirth', 'localgovtplaceofbirth', 'address', 'localgovernment', 'phonenumber', 'email', 'country_destination', 'license_number', 'license_expiry'],
            3 => ['passport'],
            4 => [],
            5 => [],
        ];
    }

    protected function validateStep()
    {
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
        $this->process_id      = 'IDL-' . strtoupper(Str::random(10));
        $this->order_reference = 'IDL-' . strtoupper(Str::random(6));

        $userId = $this->resolveApplicantUserId(
            trim("{$this->firstname} {$this->lastname}"),
            $this->email,
            $this->phonenumber,
            "International Driver's License",
            $this->process_id,
            $this->total
        );

        if ($userId === null) {
            return;
        }

        if (!($this->passport instanceof \Livewire\TemporaryUploadedFile)) {
            session()->flash('error', "Your passport photograph upload didn't attach correctly. Please re-upload it and try again.");
            $this->goToStep(3);
            return;
        }

        try {
            $passportPath = $this->passport->store('uploads/intl_license', 'public');

            InternationalDriverLicenseModel::create([
                'process_id'           => $this->process_id,
                'process_type'         => "International Driver's License",
                'user_id'              => $userId,
                'user_email'           => $this->email,
                'userType'             => 'user',
                'firstname'            => $this->firstname,
                'middlename'           => $this->middlename,
                'lastname'             => $this->lastname,
                'gender'               => $this->gender,
                'maritalstatus'        => $this->maritalstatus,
                'dateofbirth'          => $this->dateofbirth,
                'localgovtplaceofbirth'=> $this->localgovtplaceofbirth,
                'address'              => $this->address,
                'state'                => $this->state,
                'localgovernment'      => $this->localgovernment,
                'phonenumber'          => $this->phonenumber,
                'email'                => $this->email,
                'passport'             => $passportPath,
                'totalAmount'          => $this->total,
            ]);

            Order::create([
                'user_id'        => $userId,
                'user_email'     => $this->email,
                'userType'       => 'user',
                'order_number'   => $this->order_reference,
                'process_id'     => $this->process_id,
                'product_name'   => "International Driver's License",
                'product_amount' => $this->service_fee,
                'product_qty'    => 1,
                'total'          => $this->total,
                'status'         => 'pending',
            ]);

            return redirect()->route('payment.initiate', [
                'orderNo'         => $this->order_reference,
                'total'           => $this->total,
                'fullname'        => trim("{$this->firstname} {$this->lastname}"),
                'email'           => $this->email,
                'process_id'      => $this->process_id,
                'process_type'    => "International Driver's License",
                'address'         => $this->address,
                'delivery_option' => 'email',
            ]);

        } catch (\Exception $e) {
            \Log::error('International License Error: ' . $e->getMessage());
            session()->flash('error', 'Could not submit your application. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.homepage.products.international-driver-license', [
            'lagos_lgas' => $this->lagos_lgas,
        ]);
    }
}
