<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminStaffController extends Controller
{
    public function index()
    {
        $items = Admin::latest()->paginate(20);

        return view('admin.pages.staff.index', compact('items'));
    }

    public function create()
    {
        return view('admin.pages.staff.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email',
            'phone' => 'required|string|max:255',
            'password' => 'required|string|min:7|confirmed',
            'role' => 'required|in:super_admin,finance_admin,operations_admin,support_admin',
        ]);

        Admin::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'status' => 'active',
        ]);

        return redirect()->route('admin.staff.index')->with('success', 'Admin account created successfully.');
    }

    public function edit($id)
    {
        $item = Admin::find(decrypt($id));

        if (!$item) {
            return redirect()->route('admin.staff.index')->with('error', 'Admin account not found.');
        }

        return view('admin.pages.staff.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Admin::find(decrypt($id));

        if (!$item) {
            return redirect()->route('admin.staff.index')->with('error', 'Admin account not found.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('admins', 'email')->ignore($item->id)],
            'phone' => 'required|string|max:255',
            'role' => 'required|in:super_admin,finance_admin,operations_admin,support_admin',
            'password' => 'nullable|string|min:7|confirmed',
        ]);

        $item->name = $validated['name'];
        $item->email = $validated['email'];
        $item->phone = $validated['phone'];
        $item->role = $validated['role'];

        if (!empty($validated['password'])) {
            $item->password = Hash::make($validated['password']);
        }

        $item->save();

        return redirect()->route('admin.staff.index')->with('success', 'Admin account updated successfully.');
    }

    public function toggleStatus($id)
    {
        $item = Admin::find(decrypt($id));

        if (!$item) {
            return redirect()->route('admin.staff.index')->with('error', 'Admin account not found.');
        }

        if ($item->id === Auth::guard('admin')->user()->id) {
            return redirect()->back()->with('error', 'You cannot deactivate your own account.');
        }

        $item->status = $item->status === 'active' ? 'inactive' : 'active';
        $item->save();

        return redirect()->back()->with('success', 'Admin account ' . ($item->status === 'active' ? 'activated' : 'deactivated') . ' successfully.');
    }
}
