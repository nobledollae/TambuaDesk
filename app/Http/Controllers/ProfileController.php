<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = $request->user();

    $user->fill($request->validated());

    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    /*
    |--------------------------------------------------------------------------
    | Profile Photo Upload
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('profile_photo')) {

        if (
            $user->profile_photo &&
            Storage::disk('public')->exists($user->profile_photo)
        ) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        $user->profile_photo = $request
            ->file('profile_photo')
            ->store('profile-photos', 'public');
    }

    $user->save();

    return redirect()
        ->route('profile.edit')
        ->with('status', 'Profile updated successfully!');
}

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
