<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admin = Admin::selection()->first();
        return view('admin.profile', compact('admin'));
    }

    public function update($id, Request $request)
    {
        $admin = Admin::find($id);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', \Illuminate\Validation\Rule::unique('admins')->ignore($admin->id)],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', "regex:/^(0|\+212)[1-9]([-.]?[0-9]{2}){4}$/"]
        ]);
        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);
        session()->flash('success', "Profile est modifier avec succée");
        toast(session('success'), 'success');
        return redirect()->route('admin.profile');

    }
}
