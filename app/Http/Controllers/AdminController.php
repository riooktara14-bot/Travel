<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::whereIn('role', ['admin', 'super admin', 'Super Admin', 'owner', 'Owner'])
            ->orWhereIn('role', ['finance', 'Finance'])
            ->orWhereHas('role', fn ($query) => $query->whereIn('nama_peran', ['Owner', 'Finance']))
            ->latest()
            ->get();
        $administratorAccounts = $admins->reject(fn (User $user): bool => $user->isFinance());
        $statistik = [
            'total' => $administratorAccounts->count(),
            'super_admin' => $administratorAccounts->filter(fn (User $admin): bool => strtolower((string) $admin->getRawOriginal('role')) === 'super admin')->count(),
            'aktif' => $administratorAccounts->filter(fn (User $admin): bool => strtolower($admin->status) === 'aktif')->count(),
            'nonaktif' => $administratorAccounts->filter(fn (User $admin): bool => strtolower($admin->status) !== 'aktif')->count(),
        ];

        return view('kelolaadmin', compact('admins', 'statistik'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => ['required', Rule::in(['admin', 'finance', 'super admin', 'owner'])],
            'status' => 'required|string|max:50',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);

        return redirect()->route('kelolaadmin')->with('success', 'Admin berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'role' => ['required', Rule::in(['admin', 'finance', 'super admin', 'owner'])],
            'status' => 'required|string|max:50',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        }

        $admin = User::findOrFail($id);
        $admin->update($validated);

        return redirect()->route('kelolaadmin')->with('success', 'Admin berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $admin = User::findOrFail($id);
        $admin->delete();

        return redirect()->route('kelolaadmin')->with('success', 'Admin berhasil dihapus.');
    }

    public function profile(Request $request)
    {
        $admin = Auth::user();

        return view('profiladmin', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        $admin = Auth::user();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($admin->id)],
            'password' => 'nullable|string|min:6|confirmed',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('profile_photo')) {
            if ($admin->profile_photo_path) {
                Storage::disk('public')->delete($admin->profile_photo_path);
            }

            $validated['profile_photo_path'] = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        $admin->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            ...($request->hasFile('profile_photo') ? ['profile_photo_path' => $validated['profile_photo_path']] : []),
            ...($request->filled('password') ? ['password' => $validated['password']] : []),
        ]);

        return redirect()->route($admin->isFinance() ? 'finance.profil' : 'profiladmin')->with('success', 'Profil berhasil diperbarui.');
    }
}
