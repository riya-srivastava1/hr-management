<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Library\Picture;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    #Bind the model
    protected $user;

    #Bind Picture library
    protected $picture;

    /**
     * @method Defining default constryctor for controller
     * @param models and library
     * @return
     */
    public function __construct(User $user, Picture $picture)
    {
        $this->user = $user;
        $this->picture = $picture;

    }

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
        if ($request->hasFile('profile_image')) {
            $path = $this->picture->uploadfile($request->profile_image, "profile");
        } else {
            $path = Auth::guard('web')->user()->image;
        }
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $data = [
            'name' => $request->name ?? "",
            'email' => $request->email ?? "",
            'image' => $path ?? "",
        ];
        $image =Auth::guard('web')->user()->image;
        $this->user->whereId(Auth::guard('web')->user()->id)->update($data);
        if($image){
        unlink($image);
      }
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);
        $user = $request->user();
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return Redirect::to('/');
    }

}
