<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function profile(){
        return view('admin.profile.index');
    }

    public function editprofilepost(Request $request){
        
        $request->validate([
            'name' => 'required'
        ]);
        if (Auth::user()->updated_at->addDays(30) < Carbon::now()) {
            User::find(Auth::id())->update([
                'name' => $request->name
            ]);
            return back()->with('name_change_status', 'Your name changed successfully!');
        }
        else {
            $left_days = Carbon::now()->diffInDays(Auth::user()->updated_at->addDays(30));
            return back()->with('name_change_status_error','You can change your name after'. $left_days.'days');
        }
        
    }
    public function editpasswordpost(Request $request){
        $request->validate([
            'password' => 'confirmed|min:8|alpha_num'
        ]);
        if (Hash::check($request->old_password, Auth::user()->password)) {
            if ($request->old_password == $request->password) {
                return back()->with('password_error','puran password abar disen!');
            }
            else {
               User::find(Auth::id())->update([
                'password' => Hash::make($request->password)
               ]);
               return back();
            }
        }
        else {
            return back()->with('password_error','Your old password dose not match with database');
        }
    }
    public function changeprofilephoto(Request $request){
        if ($request->hasFile('profile_photo')) {
        
            $uploaded_photo = $request->file('profile_photo');
            $new_photo_name = Auth::id().".".$uploaded_photo->getClientOriginalExtension();
            $new_photo_location = 'public/uploads/profile_photos/'.$new_photo_name;
            Image::make($uploaded_photo)->save(base_path($new_photo_location));
        }
        else {
            echo "nai";
        }
    }
}
