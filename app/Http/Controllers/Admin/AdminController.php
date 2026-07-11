<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('admin.permission:manage_admins');
    }

    public function index()
    {
        $admins = Admin::latest()->get();
        return view('admin.pages.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.pages.admins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:admins',
            'phone'    => 'nullable|string',
            'password' => 'required|min:6|confirmed',
            'role'     => 'required|in:super_admin,admin'
        ]);

        Admin::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
            'role'     => $request->role
        ]);

        return redirect()->route('admin.admins.index')->with('success', 'Admin created successfully.');
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail(decrypt($id));
        return view('admin.pages.admins.edit', compact('admin'));
    }

    // Update admin details
    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail(decrypt($id));

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => [
                'required',
                'email',
                Rule::unique('admins')->ignore($admin->id)
            ],
            'phone'    => 'nullable|string|max:20',
            'role'     => 'required|in:super_admin,admin',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $admin->name  = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->role  = $request->role;

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->route('admin.admins.index')->with('success', 'Admin updated successfully.');
    }

    // Optional: Add destroy method if you want delete functionality
    public function destroy($id)
    {
        $admin = Admin::findOrFail(decrypt($id));
        $admin->delete();

        return redirect()->route('admin.admins.index')->with('success', 'Admin deleted successfully.');
    }
    
}