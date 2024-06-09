<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function updateProfile(Request $request)
    {
        $request->validate([
            // Other validations
            'gambar_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $user = Auth::user();
    
        if ($request->hasFile('gambar_profile')) {
            // Delete old profile image if exists
            if ($user->gambar_profile) {
                Storage::delete('public/profile/' . $user->gambar_profile);
            }
    
            // Store new profile image in the 'public/profile' directory
            $path = $request->file('gambar_profile')->store('public/profile');
            $user->gambar_profile = str_replace('public/profile/', '', $path); // Store only the file name
        }
    
        // Update other user details
        $user->save();
    
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
