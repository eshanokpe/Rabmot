<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminServicePricingController extends Controller
{
    public function index()
    {
        $items = Service::latest()->paginate(20);

        return view('admin.pages.services.index', compact('items'));
    }

    public function create()
    {
        return view('admin.pages.services.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateService($request);

        $validated['commission_eligible'] = $request->boolean('commission_eligible');
        $validated['created_by'] = Auth::guard('admin')->user()->id;
        $validated['updated_by'] = Auth::guard('admin')->user()->id;

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit($id)
    {
        $item = Service::find(decrypt($id));

        if (!$item) {
            return redirect()->route('admin.services.index')->with('error', 'Service not found.');
        }

        return view('admin.pages.services.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Service::find(decrypt($id));

        if (!$item) {
            return redirect()->route('admin.services.index')->with('error', 'Service not found.');
        }

        $validated = $this->validateService($request);
        $validated['commission_eligible'] = $request->boolean('commission_eligible');
        $validated['updated_by'] = Auth::guard('admin')->user()->id;

        $item->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function toggleStatus($id)
    {
        $item = Service::find(decrypt($id));

        if (!$item) {
            return redirect()->route('admin.services.index')->with('error', 'Service not found.');
        }

        $item->status = $item->status === 'active' ? 'inactive' : 'active';
        $item->updated_by = Auth::guard('admin')->user()->id;
        $item->save();

        return redirect()->back()->with('success', 'Service ' . ($item->status === 'active' ? 'enabled' : 'disabled') . ' successfully.');
    }

    private function validateService(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
            'commission_rate_override' => 'nullable|numeric|min:0|max:100',
            'effective_date' => 'nullable|date',
        ]);
    }
}
