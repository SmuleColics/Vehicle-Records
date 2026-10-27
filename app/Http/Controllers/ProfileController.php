<?php

namespace App\Http\Controllers;

use App\Models\ProfilePhoto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
  public function showProfile()
  {
    $user = User::find(session('user')->id);

    return view('shared.profile', compact('user'));
  }

  public function updateProfilePicture(Request $request)
  {
    $user = User::find(session('user')->id);

    if (!$request->hasFile('profile')) {
      return back()->with('error', 'Please select a photo to upload.');
    }

    $file = $request->file('profile');

    if (!str_starts_with((string) $file->getMimeType(), 'image/')) {
      return back()->with('error', 'Please upload an image file.');
    }

    if ($file->getSize() > 2 * 1024 * 1024) {
      return back()->with('error', 'Photo must be 2 MB or smaller.');
    }

    // saved in the database instead of public/uploads so it survives serverless deploys
    ProfilePhoto::updateOrCreate(
      ['user_id' => $user->id],
      ['mime' => $file->getMimeType(), 'data' => base64_encode($file->get())]
    );

    $user->profile_picture = time() . '.' . $file->extension();
    $user->save();

    session(['user' => $user]);

    return back()->with('success', 'Profile picture updated successfully');
  }

  public function showProfilePicture($id)
  {
    $photo = ProfilePhoto::where('user_id', $id)->first();

    if (!$photo) {
      return redirect(asset('images/default.jpg'));
    }

    // the url changes on every upload, so browsers can cache it for good
    return response(base64_decode($photo->data))
      ->header('Content-Type', $photo->mime)
      ->header('Cache-Control', 'public, max-age=31536000, immutable');
  }

  public function updateProfile(Request $request)
  {
    $user = User::find(session('user')->id);

    if ($user->isDemo() && ($request->email !== $user->email || $request->new_password)) {
      return back()->with('error', 'The demo account email and password cannot be changed');
    }

    // Update personal details
    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->gender = $request->gender;
    $user->address = $request->address;

    // Update password only if new password is provided
    if ($request->new_password) {
      if (!Hash::check($request->current_password, $user->password)) {
        return back()->with('error', 'Current password is incorrect');
      }

      if ($request->new_password !== $request->confirm_password) {
        return back()->with('error', 'New passwords do not match');
      }

      $user->password = Hash::make($request->new_password);
    }

    $user->save();

    session(['user' => $user]);

    return back()->with('success', 'Profile updated successfully');
  }
}
