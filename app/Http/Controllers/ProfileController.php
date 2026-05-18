<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    //Desc: update profile info
    //@route PUT /profile
  public function update(Request $request): RedirectResponse
{
    // Get the authenticated user
    $user = Auth::user();

    // Validate the incoming request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);
    //get username and email
    $user->name = $request->input('name');
    $user->email = $request->input('email');

    //handle avatar upload
    if ($request->hasFile('avatar')) {
        //delete old avatar if exists
        if ($user->avatar) {
            Storage::delete('public/avatars/' . $user->avatar);
        }
        //Store new avatar
        $avatarPath = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = $avatarPath;
    }


    // Update the user's information
    $user->save();

    // Redirect back to the dashboard page with a success message
    return redirect()->route('dashboard')->with('success', 'User info updated successfully!');
}
}
