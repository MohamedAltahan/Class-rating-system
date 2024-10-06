<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentProfileController extends Controller
{
    public function index()
    {
        return view('frontend.profile.index');
    }

    public function profileUpdate(Request $request)
    {

        $request->validate([
            'name' => ['required', 'max:100'],
            'phone' => ['required', 'max:15'],
            'residence_number' => ['required', 'max:20', 'unique:users,residence_number,' . Auth::guard('web')->user()->id],
            'email' => ['somtimes', 'nullable', 'email', 'unique:users,email,' . Auth::guard('web')->user()->id],
            'image' => ['image', 'max:2048']
        ]);

        $user = Auth::guard('web')->user();
        $profileData = $request->except('image', '_token'); //array
        //get the old image name
        $oldImage = $user->image;
        //store the new image
        $newImage = $this->uploadImage($request);

        if ($request->hasFile('image')) {
            $profileData['image'] = $newImage;
        }
        User::where('id', Auth::guard('web')->user()->id)->update($profileData);

        if ($oldImage && $newImage) {
            Storage::disk('myDisk')->delete($oldImage);
        }

        toastr()->success(__('Profile updated successfully'));
        return redirect()->back();
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $userId = Auth::guard('web')->user()->id;
        $password = User::where('id', $userId)->first()->password;

        if (Hash::check($request->current_password, $password)) {
            $request->user('web')->update([
                'password' => bcrypt($request->password)
            ]);
        } else {
            toastr()->error(__('worng current password'));
            return redirect()->back();
        }

        toastr()->success(__('Password updated successfully'));
        return redirect()->back();
    }


    //it take the file from the request then store it, then returns the path
    public function uploadImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }
        //it returns object of uploaded file object
        $image = $request->file('image');
        //takes (folderName,name of the disk )to store the file and returns the path
        $path = $image->store('profile', ['disk' => 'myDisk']);
        return $path;
    }
}
