<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StaffController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        abort_unless($user?->canManageUsers(), 403, 'Unauthorized user management request.');

        $companies = Company::orderBy('name')->get();

        return view('staff', [
            'staffMembers' => User::with(['company', 'role'])->orderBy('created_at', 'desc')->paginate(10),
            'roles' => Role::orderBy('name')->get(),
            'companies' => $companies,
            'canManageUsers' => true,
            'currentUser' => $user,
        ]);
    }

    public function store(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        abort_unless($user?->canManageUsers(), 403, 'Unauthorized user creation request.');

        $validatedData = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['required', 'email', 'unique:users,email'],
            'role_id' => ['required', 'exists:roles,id'],
            'company_id' => ['nullable', 'exists:companies,id'],
        ]);

        $assignedCompanyId = $validatedData['company_id'] ?? null;

        $temporaryPassword = Str::upper($validatedData['last_name']);

        User::create([
            'company_id' => $assignedCompanyId,
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'phone' => $validatedData['phone'] ?? null,
            'email' => $validatedData['email'],
            'role_id' => $validatedData['role_id'],
            'password' => Hash::make($temporaryPassword),
        ]);

        return redirect()->back()->with('success', 'Staff account created. Temporary password set to the uppercase last name: ' . $temporaryPassword);
    }
}