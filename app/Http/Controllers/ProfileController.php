<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    /**
     * Menampilkan daftar profil pengguna.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = User::all();
        return view('profile.index', compact('profiles'));
    }

    /**
     * Menampilkan formulir untuk membuat profil baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profile.create');
    }

    /**
     * Menyimpan profil baru ke dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'gambar_profile' => 'nullable|image|max:2048',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->hasFile('gambar_profile')) {
            $gambarProfile = $request->file('gambar_profile');
            $path = $gambarProfile->store('gambar_profile', 'public');
            $user->gambar_profile = $path;
            $user->save();
        }

        return redirect()->route('profile.index')->with('success', 'Profil pengguna berhasil dibuat.');
    }

    /**
     * Menampilkan formulir untuk mengedit profil.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('profile.edit', compact('user'));
    }

    /**
     * Menyimpan perubahan pada profil ke dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'gambar_profile' => 'nullable|image|max:2048',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('gambar_profile')) {
            $gambarProfile = $request->file('gambar_profile');
            $path = $gambarProfile->store('gambar_profile', 'public');
            $user->gambar_profile = $path;
        }

        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profil pengguna berhasil diperbarui.');
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('profiles.show', compact('user'));
    }
    /**
     * Menghapus profil dari database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('profile.index')->with('success', 'Profil pengguna berhasil dihapus.');
    }


    public function uploadAvatar()
    {
        return view('profile.upload_avatar');
    }

    public function updateAvatar(Request $request)
    {
        // Validasi form jika diperlukan

        // Simpan file gambar ke penyimpanan (storage)
        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada
            $oldAvatar = Auth::user()->gambar_profile;
            if ($oldAvatar) {
                // Perbaiki path untuk menghapus avatar lama
                Storage::disk('public')->delete('profile/'.$oldAvatar);
         
            }

            $avatar = $request->file('avatar');
            // Perbaiki path untuk menyimpan file ke dalam direktori 'profile'
            $avatarPath = $avatar->store('profile', 'public');

            // Simpan nama file gambar ke basis data
            Auth::user()->update(['gambar_profile' => $avatarPath]);

            return redirect()->back()->with('success', 'Avatar has been updated successfully!');
        }

        return redirect()->back()->with('error', 'No file uploaded!');
    }


    public function deleteAvatar()
    {
        // Hapus avatar dari penyimpanan
        $oldAvatar = Auth::user()->gambar_profile;
        if ($oldAvatar) {
            Storage::delete('profile/' . $oldAvatar);
            // Hapus referensi avatar dari basis data
            Auth::user()->update(['gambar_profile' => null]);
        }

        return redirect()->back()->with('success', 'Avatar has been deleted successfully!');
    }
}
