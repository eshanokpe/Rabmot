<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Admin > Vehicles: one "Client Vehicles" table across the three added-vehicle
 * services (renewal, new registration, change of ownership).
 */
class VehiclesController extends Controller
{
    public const SERVICES = [
        'renewal' => [
            'label'      => 'Vehicle Renewal',
            'view_route' => 'admin.vehicle.renewals.view',
            'add_route'  => 'admin.vehicle.renewal.add',
        ],
        'registration' => [
            'label'      => 'New Vehicle Registration',
            'view_route' => 'admin.vehicle.registrations.view',
            'add_route'  => 'admin.vehicle.registration.new',
        ],
        'ownership' => [
            'label'      => 'Change of Ownership',
            'view_route' => 'admin.changeOfOwnership.view',
            'add_route'  => 'admin.vehicle.changeOfOwnership.add',
        ],
    ];

    public function index(Request $request)
    {
        $filters = $request->validate([
            'service' => 'nullable|in:' . implode(',', array_keys(self::SERVICES)),
            'search' => 'nullable|string|max:100',
        ]);
        $service = $filters['service'] ?? null;
        $search = trim($filters['search'] ?? '');

        $counts = [
            'all' => 0,
            'renewal' => DB::table('addvehiclerenewals')->count(),
            'registration' => DB::table('add_vehicle_registrations')->count(),
            'ownership' => DB::table('add_vehicle_ownerships')->count(),
        ];
        $counts['all'] = $counts['renewal'] + $counts['registration'] + $counts['ownership'];

        $query = DB::query()
            ->fromSub($this->allVehicles(), 'v')
            ->leftJoin('vehicle_types as vt', 'vt.id', '=', 'v.category')
            ->select('v.*', 'vt.name as category_name')
            ->when($service, fn ($q) => $q->where('v.service', $service))
            ->when($search !== '', function ($q) use ($search) {
                $like = '%' . $search . '%';
                $digits = preg_replace('/\D+/', '', $search);
                $q->where(function ($q) use ($like, $digits) {
                    $q->where('v.owner_name', 'like', $like)
                        ->orWhere('v.email', 'like', $like)
                        ->orWhere('v.platenumber', 'like', $like)
                        ->orWhere('v.chassisnumber', 'like', $like)
                        ->orWhere('v.vehiclemake', 'like', $like)
                        ->orWhere('v.vehiclemodel', 'like', $like);
                    if (strlen($digits) >= 4) {
                        $q->orWhereRaw("REPLACE(REPLACE(REPLACE(v.phone, ' ', ''), '-', ''), '+', '') like ?", ['%' . $digits . '%']);
                    }
                });
            })
            ->orderByDesc('v.created_at')
            ->orderByDesc('v.id');

        $vehicles = $query->paginate(20)->withQueryString();

        $data = [
            'vehicles' => $vehicles,
            'counts' => $counts,
            'service' => $service,
            'search' => $search,
            'services' => self::SERVICES,
        ];

        // Tabs, search and pagination swap just the table in place
        if ($request->ajax()) {
            return view('admin.pages.vehicles._table', $data);
        }

        return view('admin.pages.vehicles.index', $data);
    }

    /**
     * The shared columns of all three vehicle tables as one result set.
     */
    private function allVehicles()
    {
        $common = fn (string $service) => [
            DB::raw("'{$service}' as service"),
            'id', 'userType', 'user_email', 'category', 'vehiclemake', 'vehiclemodel',
            'vehiclecolor', 'chassisnumber', 'created_at',
        ];

        $renewals = DB::table('addvehiclerenewals')->select(array_merge($common('renewal'), [
            DB::raw('ownerfullname as owner_name'),
            DB::raw('ownersphonenumber as phone'),
            DB::raw("COALESCE(NULLIF(owneremail, ''), emailAddress) as email"),
            DB::raw('year0fmake as year'),
            'platenumber',
        ]));

        $registrations = DB::table('add_vehicle_registrations')->select(array_merge($common('registration'), [
            DB::raw("COALESCE(NULLIF(ownerfullname, ''), applicantfullname) as owner_name"),
            DB::raw('phonenumber as phone'),
            DB::raw("COALESCE(NULLIF(owneremail, ''), emailaddress) as email"),
            DB::raw('year_of_make as year'),
            DB::raw('NULL as platenumber'),
        ]));

        $ownerships = DB::table('add_vehicle_ownerships')->select(array_merge($common('ownership'), [
            DB::raw("COALESCE(NULLIF(ownerfullname, ''), ownersfullname) as owner_name"),
            DB::raw('phonenumber as phone'),
            DB::raw("COALESCE(NULLIF(ownersemail, ''), emailaddress) as email"),
            DB::raw('yearofmake as year'),
            'platenumber',
        ]));

        return $renewals->unionAll($registrations)->unionAll($ownerships);
    }
}
