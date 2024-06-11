<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            // validator message mas
            'password.required' => 'Password baru harus diisi',
            'password.string' => 'password sss',
            'password.min' => 'Password harus memiliki minimal :min karakter',
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'gambar_profile' => 'nullable|image|max:2048',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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
            'password' => 'nullable|string|min:8|confirmed',
            'gambar_profile' => 'nullable|image|max:2048',
        ]);

        $user = Auth::user();
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('gambar_profile')) {
            // Delete old avatar if exists
            if ($user->gambar_profile) {
                Storage::disk('public')->delete($user->gambar_profile);
            }
            $gambarProfile = $request->file('gambar_profile');
            $path = $gambarProfile->store('gambar_profile', 'public');
            $user->gambar_profile = $path;
        }

        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profil pengguna berhasil diperbarui.');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
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

    /**
     * Menampilkan formulir untuk mengunggah avatar.
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadAvatar()
    {
        return view('profile.upload_avatar');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|max:2048',
        ]);

        $user = Auth::user();

        // Delete old avatar if exists
        if ($user->gambar_profile) {
            Storage::disk('public')->delete($user->gambar_profile);
        }

        $avatar = $request->file('avatar');
        $avatarPath = $avatar->store('profile', 'public');
        $user->gambar_profile = $avatarPath;
        $user->save();

        return redirect()->route('profile.index')->with('success', 'Avatar profile berhasil diupdate!');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function deleteAvatar()
    {
        $user = Auth::user();

        if ($user->gambar_profile) {
            Storage::disk('public')->delete($user->gambar_profile);
            $user->gambar_profile = null;
            $user->save();
        }

        return redirect()->route('profile.index')->with('success', 'Avatar profile berhasil dihapus');
    }
}
