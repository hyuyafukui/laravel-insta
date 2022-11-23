<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'public/avatars/';
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function show($id)
    {
        $user_a = $this->user->findOrFail($id);

        return view ('users.profile.show')
                    ->with('user', $user_a);
    }

    public function edit()
    {
        $user_a = $this->user->findOrFail(Auth::user()->id);
        return view('users.profile.edit')
                ->with('user', $user_a);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'     => 'required|max:50',
            'email'    => 'required|email|max:50|unique:users,email,'.Auth::user()->id,
            //email - ensure the value is in email format
            //unique - ensure the email (submitted) does not already exist in database
            //        *exception: current email of user
            'introduction' => 'max:100',
            'avatar'       => 'mimes:jpg,jpeg,png,gif|max:1048' 
        ]);

        $user_a = $this->user->findOrFail(Auth::user()->id);

        $user_a->name = $request->name;
        $user_a->email = $request->email;
        $user_a->introduction = $request->introduction;

        if($request->avatar){
            //delete current avatar
            if($user_a->avatar){
                $this->deleteAvatar($user_a->avatar);
            }

            //save new avatar
            $user_a->avatar = $this->saveAvatar($request);
        }
        $user_a->save();

        return redirect()->route('profile.show', Auth::user()->id);
    }

    public function deleteAvatar($file_name)
    {
        $file_path = self::LOCAL_STORAGE_FOLDER . $file_name;

        if(Storage::disk('local')->exists($file_path)){
            Storage::disk('local')->delete($file_path);
        }
    }

    public function saveAvatar($request)
    {
        $new_file_name = time() . "." . $request->avatar->extension();

        $request->avatar->storeAs(self::LOCAL_STORAGE_FOLDER, $new_file_name);

        return $new_file_name;
    }

    public function updatePassword(Request $request)
    {
        //check that old password is correct (database)
        $user_a = $this->user->findOrFail(Auth::user()->id);
        if(!Hash::check($request->old_password, $user_a->password)){
            return redirect()->back()
                    ->with('old_password_error', 'That\'s not your current password. Try again.');
        }

        //check that old password and new password are NOT the same
        if($request->old_password == $request->new_password){
            return redirect()->back()
                    ->with('same_password_error', 'The new password is the same as your current password. Choose a new password');
        }
        //check that new password is the same as confirm new password
        $request->validate([
            'new_password' => 'required|min:8|string|confirmed'
            //validates that the password is astring (numbers and letters)
        ]);

        $user_a->password = Hash::make($request->new_password);
        $user_a->save();

        return redirect()->back()
                ->with('success_message', 'Password changed successfully!');
    }

    public function followers($id)
    {
        $user_a = $this->user->findOrFail($id);

        return view('users.profile.followers')
                ->with('user', $user_a);
    }

    public function following($id)
    {
        $user_a = $this->user->findOrFail($id);

        return view('users.profile.following')
                ->with('user', $user_a);
    }


}
