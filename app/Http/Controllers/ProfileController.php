<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Image;
use Auth, Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile');
    }
    public function update(Request $request)
    {
        $user = auth()->user();

        $validator = [
            'name'    => 'required',
            'email'    => 'required|unique:users,email,' . $user->id . ',id',
            'phone_no'    => 'required|unique:users,phone_no,' . $user->id . ',id',
            'image' => 'nullable|mimes:jpeg,jpg,png|mimetypes:image/*'
        ];

        $validator = Validator::make($request->all(), $validator);
        
        if ($validator->fails()) {
            return redirect()->route('profile')->with('error', join(", ",$validator->errors()->all()));
        } else {

            $imageName = '';
            
            if (!empty($request->file('image'))) {
                $originalImage = $request->file('image');
                $imageName =  time() . '_' . str_replace(' ', '-', $originalImage->getClientOriginalName());

                $thumbnailImage = Image::make($originalImage);
                $thumbnailPath = public_path('uploads/user/thumbnail');
                $thumbnailImage->resize(150, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $thumbnailImage->save($thumbnailPath . '/' . $imageName);

                $request->file('image')->move(public_path('uploads/user/'), $imageName);
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone_no = $request->phone_no;
            if ($imageName != '') {
                $user->image = $imageName;
            }

            if ($user->save()) {
                return redirect()->route('profile')->with('success', 'Profile updated successfully');
            }
            return redirect()->route('profile')->with('error', 'Profile updated unsuccessfully');
        }
    }

    public function checkuserPhoneNoRepeat(Request $request)
    {
        $phone_no=$request->phone_no;
        $id=$request->id;

        $items = User::select('id');
        
        if (($request->action === 'edit') && ($id!=null || $id!='' || $id>0)) {
            $items->where('id', '!=', $id);
        } 

        $items->where('phone_no', $phone_no);
        $query = $items->get();
        if ($query->count() > 0) { echo 'false'; } else { echo 'true'; }
    }

    public function checkUserCurrentPassword(Request $request){
        
        $items = User::select('id','password')->where('id', $request->id)->first();
        if(Hash::check($request->current_password, $items->password)){
            echo 'true';
        }else{
            echo 'false';
        }
    }

    public function changePassword()
    {
        return view('changePassword');
    }

    public function passworUpdate(Request $request){
        $request->validate([
            'current_password' => 'required',
            'password_confirmation' => ['required', 'min:6', 'same:password'],
            'password' => ['required'],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password does not match');
        } else {
            $user->password = Hash::make($request->password);

            if ($user->save()){
                Auth::guard()->logout();
                return redirect('/')->with('success', 'Password changed successfully');
            } else {
                return back()->with('error', 'Password changed unsuccessfully');
            }
        }
    }
}
