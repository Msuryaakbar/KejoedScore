<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(20);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $siswaList = Siswa::whereNull('user_id')->get();
        return view('users.create', compact('siswaList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,guru,ortu'],
            'siswa_ids' => ['array'],
            'siswa_ids.*' => ['exists:siswa,id'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        // Jika role orang tua, hubungkan dengan siswa
        if ($validated['role'] === 'ortu' && isset($validated['siswa_ids'])) {
            Siswa::whereIn('id', $validated['siswa_ids'])->update(['user_id' => $user->id]);
        }

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit(User $user)
    {
        $siswaList = Siswa::whereNull('user_id')
            ->orWhere('user_id', $user->id)
            ->get();
        return view('users.edit', compact('user', 'siswaList'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,guru,ortu'],
            'siswa_ids' => ['array'],
            'siswa_ids.*' => ['exists:siswa,id'],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];

        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        // Update relasi siswa
        if ($validated['role'] === 'ortu') {
            // Lepas siswa yang sebelumnya terhubung
            Siswa::where('user_id', $user->id)->update(['user_id' => null]);

            // Hubungkan siswa baru
            if (isset($validated['siswa_ids'])) {
                Siswa::whereIn('id', $validated['siswa_ids'])->update(['user_id' => $user->id]);
            }
        }

        return redirect()->route('users.index')->with('success', 'User berhasil diupdate!');
    }

    public function destroy(User $user)
    {
        // Lepas relasi dengan siswa sebelum hapus
        Siswa::where('user_id', $user->id)->update(['user_id' => null]);

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus!');
    }
}
