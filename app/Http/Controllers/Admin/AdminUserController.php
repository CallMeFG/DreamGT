<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::latest();

        // 1. Search (Nama / Email / Username)
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%')
                    ->orWhere('username', 'like', '%' . $request->search . '%');
            });
        }

        // 2. Filter Role
        if ($request->role && $request->role != 'all') {
            $query->where('role', $request->role);
        }

        $users = $query->paginate(20)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        // Proteksi: Admin tidak boleh menghapus dirinya sendiri
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot delete your own account!');
        }

        // Proteksi: Admin tidak boleh menghapus sesama Admin (Opsional, tapi aman)
        if ($user->role === 'admin') {
            return back()->with('error', 'Cannot delete other Administrators.');
        }

        $user->delete();
        return back()->with('success', 'User has been removed from database.');
    }
}