<?php

namespace App\Http\Livewire\Homepage\Products;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Livewire\Homepage\Products\Concerns\ResolvesApplicantAccount;
use App\Models\VehiclePaperRenewal;
use App\Models\VehicleRenewalPrice;
use App\Models\Order;
use Illuminate\Support\Str;

class VehicleRenewal extends Component
{
    use WithFileUploads;
    use ResolvesApplicantAccount;

    public $step = 1;
    public $totalSteps = 6;

    // Contact Info
    public $full_name = '';
    public $phone     = '';
    public $email     = '';

    // Vehicle Info
    public $state        = '';
    public $vehicle_type = '';

    // Service selections (bool)
    public $svc_vehicle_license   = false;
    public $svc_road_worthiness   = false;
    public $svc_insurance         = false;
    public $svc_hackney           = false;
    public $svc_inspection        = false;
    public $svc_ownership         = false;
    public $svc_cmris             = false;

    // Document uploads (one per service)
    public $doc_vehicle_license;
    public $doc_road_worthiness;
    public $doc_insurance;
    public $doc_hackney;
    public $doc_inspection;
    public $doc_ownership;
    public $doc_cmris;

    // Payment & System
    public $process_id      = '';
    public $order_reference = '';
    public $is_authenticated = false;

    // Per-service prices loaded from DB (public so Livewire re-renders on change)
    public $service_prices = [
        'vehicle_license' => 0,
        'road_worthiness' => 0,
        'insurance'       => 0,
        'hackney'         => 0,
        'inspection'      => 0,
        'ownership'       => 0,
        'cmris'           => 0,
    ];

    protected $stateIds = [
        'Lagos'  => 1, 'Abuja' => 2, 'Abia'  => 3,
        'Rivers' => 4, 'Ogun'  => 5, 'Oyo'   => 6, 'Osun' => 7,
    ];

    protected $vehicleTypeIds = [
        'Saloon'          => 1,
        'SUV'             => 2,
        'Coaster'         => 3,
        'Truck - 15 Tons' => 4,
        'Truck - 20 Tons' => 5,
        'Truck - 30 Tons' => 6,
    ];

    // Maps our service keys to VehicleRenewalPrice column names
    protected $serviceDbColumns = [
        'vehicle_license' => 'vehicle_license',
        'road_worthiness' => 'road_worthiness',
        'insurance'       => 'third_party_insurance',
        'hackney'         => 'hackney_permit',
        'inspection'      => 'vehicle_inspection_pickanddrop',
        'ownership'       => 'proof_of_ownership',
        'cmris'           => 'police_cmris',
    ];

    public function getServicesProperty()
    {
        return [
            'vehicle_license' => ['label' => 'Vehicle License',                'price' => $this->service_prices['vehicle_license']],
            'road_worthiness' => ['label' => 'Road Worthiness',                'price' => $this->service_prices['road_worthiness']],
            'insurance'       => ['label' => 'Third Party Insurance',          'price' => $this->service_prices['insurance']],
            'hackney'         => ['label' => 'Hackney Permit',                 'price' => $this->service_prices['hackney']],
            'inspection'      => ['label' => 'Vehicle Inspection Pick & Drop', 'price' => $this->service_prices['inspection']],
            'ownership'       => ['label' => 'Proof of Ownership',             'price' => $this->service_prices['ownership']],
            'cmris'           => ['label' => 'Police CMRIS',                  'price' => $this->service_prices['cmris']],
        ];
    }

    public function getTotalProperty()
    {
        $total = 0;
        foreach ($this->getServicesProperty() as $key => $svc) {
            if ($this->{'svc_' . $key}) {
                $total += $svc['price'];
            }
        }
        return $total;
    }

    public function getSelectedServicesProperty()
    {
        $selected = [];
        foreach ($this->getServicesProperty() as $key => $svc) {
            if ($this->{'svc_' . $key}) {
                $selected[$key] = $svc;
            }
        }
        return $selected;
    }

    protected function rules()
    {
        $docRules = [];
        foreach ($this->getServicesProperty() as $key => $svc) {
            if ($this->{'svc_' . $key}) {
                $docRules["doc_{$key}"] = 'required|file|mimes:jpg,jpeg,png,pdf|max:2048';
            }
        }

        return array_merge([
            'full_name'    => 'required|string|max:255',
            'phone'        => 'required|string|min:11|max:15',
            'email'        => 'required|email|max:150',
            'state'        => 'required|string|max:100',
            'vehicle_type' => 'required|string|max:100',
        ], $docRules);
    }

    protected function messages()
    {
        return [
            'required'     => 'This field is required.',
            'phone.min'    => 'Phone number must be at least 11 digits.',
            'mimes'        => 'Allowed formats: JPG, PNG, PDF.',
            'max'          => 'File size cannot exceed 2MB.',
        ];
    }

    public function mount()
    {
        $this->is_authenticated = Auth::check();
        if ($this->is_authenticated) {
            $user       = Auth::user();
            $this->email = $user->email;
            $this->phone = $user->phone ?? '';
        }
    }

    public function updatedState($value)
    {
        $this->loadPricesFromDb();
    }

    public function updatedVehicleType($value)
    {
        $this->loadPricesFromDb();
    }

    protected function loadPricesFromDb()
    {
        $stateId       = $this->stateIds[$this->state]              ?? null;
        $vehicleTypeId = $this->vehicleTypeIds[$this->vehicle_type] ?? null;

        if (!$stateId || !$vehicleTypeId) return;

        $row = VehicleRenewalPrice::where('state_id', $stateId)
                                   ->where('vehicleType_id', $vehicleTypeId)
                                   ->first();

        if ($row) {
            $prices = [];
            foreach ($this->serviceDbColumns as $key => $col) {
                $prices[$key] = (int) $row->{$col};
            }
            $this->service_prices = $prices;
        }
    }

    protected function validateStep()
    {
        $stepFields = [
            1 => [],
            2 => ['full_name', 'phone', 'email'],
            3 => ['state', 'vehicle_type'],
            4 => array_map(fn($k) => "doc_{$k}", array_keys($this->getSelectedServicesProperty())),
            5 => [],
            6 => [],
        ];

        $fields = $stepFields[$this->step] ?? [];

        // Step 3 also needs at least one service selected
        if ($this->step === 3 && count($this->getSelectedServicesProperty()) === 0) {
            session()->flash('error', 'Please select at least one renewal service.');
            return false;
        }

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
        $this->process_id      = 'VPR-' . strtoupper(Str::random(10));
        $this->order_reference = 'VPR-' . strtoupper(Str::random(6));

        $userId = $this->resolveApplicantUserId(
            $this->full_name,
            $this->email,
            $this->phone,
            'Vehicle Papers Renewal',
            $this->process_id,
            $this->total
        );

        if ($userId === null) {
            return;
        }

        foreach ($this->getSelectedServicesProperty() as $key => $svc) {
            if (!($this->{'doc_' . $key} instanceof \Livewire\TemporaryUploadedFile)) {
                session()->flash('error', "Your upload for {$svc['label']} didn't attach correctly. Please re-upload it and try again.");
                $this->goToStep(4);
                return;
            }
        }

        try {
            $paths = [];
            foreach ($this->getServicesProperty() as $key => $svc) {
                if ($this->{'svc_' . $key} && $this->{'doc_' . $key}) {
                    $paths[$key] = $this->{'doc_' . $key}->store('uploads/vehicle_renewal', 'public');
                }
            }

            VehiclePaperRenewal::create([
                'process_id'                  => $this->process_id,
                'process_type'                => 'Vehicle Papers Renewal',
                'user_id'                     => $userId,
                'user_email'                  => $this->email,
                'userType'                    => 'user',
                'vehicleCategory'             => $this->vehicle_type,
                'vehicleType'                 => $this->state,
                'vehicleLicense'              => $paths['vehicle_license'] ?? null,
                'roadWorthiness'              => $paths['road_worthiness'] ?? null,
                'thirdPartyInsurance'         => $paths['insurance'] ?? null,
                'hackneyPermit'               => $paths['hackney'] ?? null,
                'vehicleInspectionPickanddrop'=> $paths['inspection'] ?? null,
                'proofOfOwnership'            => $paths['ownership'] ?? null,
                'policeCMRIS'                 => $paths['cmris'] ?? null,
                'payment_status'              => 'unpaid',
                'totalamount'                 => $this->total,
            ]);

            Order::create([
                'user_id'        => $userId,
                'user_email'     => $this->email,
                'userType'       => 'user',
                'order_number'   => $this->order_reference,
                'process_id'     => $this->process_id,
                'product_name'   => 'Vehicle Papers Renewal',
                'product_amount' => $this->total,
                'product_qty'    => 1,
                'total'          => $this->total,
                'status'         => 'pending',
            ]);

            return redirect()->route('payment.initiate', [
                'orderNo'         => $this->order_reference,
                'total'           => $this->total,
                'fullname'        => $this->full_name,
                'email'           => $this->email,
                'process_id'      => $this->process_id,
                'process_type'    => 'Vehicle Papers Renewal',
                'address'         => '',
                'delivery_option' => 'email',
            ]);

        } catch (\Exception $e) {
            \Log::error('Vehicle Renewal Error: ' . $e->getMessage());
            session()->flash('error', 'Could not submit your application. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.homepage.products.vehicle-renewal', [
            'services'         => $this->getServicesProperty(),
            'selectedServices' => $this->getSelectedServicesProperty(),
            'total'            => $this->total,
        ]);
    }
}
