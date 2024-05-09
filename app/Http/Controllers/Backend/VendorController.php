<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\profile\UpdatePasswordRequest;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class VendorController extends Controller
{

    public function dashboard()
    {
        return view('vendor.dashboard.dashboard');
    }

    public function edit()
    {
        $user = auth()->user();

        return view('vendor.dashboard.profile', compact('user'));
    }

    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->update(Arr::except($request->validated(), ['image']));
        $this->uploadFile();

        toastr()->success('Profile info updated successfully!', 'Success');

        return redirect()->back();
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $request->user()->update([
            'password' => bcrypt($request->validated()['password'])
        ]);

        toastr()->success('Profile password updated successfully!', 'Success');

        return redirect()->back();
    }

    public function uploadFile()
    {
        $user = request()->user();

        if (request()->hasFile('image')) {
            mkdir('uploads/vendors');

            if (File::exists(public_path($user->image))) {
                File::delete(public_path($user->image));
            }

            $image = request()->file('image');
            $imageName = rand() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);

            $path = '/uploads/' . $imageName;
            $user->image =  $path;
            $user->save();
        }
    }

}
