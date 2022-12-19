<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;
use Image;

class SettingsController extends Controller
{
    public function index(Request $request)
    {
        $settings = Settings::first();
        return view('setting.index',compact('settings'));
    }

    public function update(Request $request){
        $authUser = auth()->user();

        $settings = Settings::first();
        
        $data = array();
        if(isset($request->holdare_name)){
            $data['bd_holdare_name'] = $request->holdare_name;
        }

        if(isset($request->bank_name)){
            $data['bd_bank_name'] = $request->bank_name;
        }

        if(isset($request->ifsc_code)){
            $data['bd_ifsc_code'] = $request->ifsc_code;
        }

        if(isset($request->account_no)){
            $data['bd_account_no'] = $request->account_no;
        }

        if(isset($request->prefix_name_invoice)){
            $data['prefix_name_invoice'] = $request->prefix_name_invoice;
        }

        if(isset($request->phone_no)){
            $data['phone_no'] = $request->phone_no;
        }

        if(isset($request->email_id)){
            $data['email_id'] = $request->email_id;
        }

        if(isset($request->address)){
            $data['address'] = $request->address;
        }

        if(isset($request->terms_conditions)){
            $data['terms_conditions'] = $request->terms_conditions;
        }

        if(isset($request->notes)){
            $data['notes'] = $request->notes;
        }
        
        if (!empty($request->file('logo_img'))) {
            $originalImage = $request->file('logo_img');
            $imageName =  time() . '_' . str_replace(' ', '-', $originalImage->getClientOriginalName());

            $thumbnailImage = Image::make($originalImage);
            $thumbnailPath = public_path('uploads/setting/thumbnail');
            $thumbnailImage->resize(150, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $thumbnailImage->save($thumbnailPath . '/' . $imageName);

            $request->file('logo_img')->move(public_path('uploads/setting/'), $imageName);

            $data['logo_img'] = $imageName;
        }

        if (!empty($request->file('favicon_img'))) {
            $originalImage = $request->file('favicon_img');
            $imageName =  time() . '_' . str_replace(' ', '-', $originalImage->getClientOriginalName());

            $thumbnailImage = Image::make($originalImage);
            $thumbnailPath = public_path('uploads/setting/thumbnail');
            $thumbnailImage->resize(150, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $thumbnailImage->save($thumbnailPath . '/' . $imageName);

            $request->file('favicon_img')->move(public_path('uploads/setting/'), $imageName);

            $data['favicon_img'] = $imageName;
        }

        if (!empty($request->file('sign_img'))) {
            $originalImage = $request->file('sign_img');
            $imageName =  time() . '_' . str_replace(' ', '-', $originalImage->getClientOriginalName());

            $thumbnailImage = Image::make($originalImage);
            $thumbnailPath = public_path('uploads/setting/thumbnail');
            $thumbnailImage->resize(150, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $thumbnailImage->save($thumbnailPath . '/' . $imageName);

            $request->file('sign_img')->move(public_path('uploads/setting/'), $imageName);

            $data['sign_img'] = $imageName;
        }

        if(!is_null($settings)){
            $data['update_by'] = $authUser->id;

            Settings::where('id', $settings->id)->update($data);
        }else{
            $data['create_by'] = $authUser->id;
            Settings::create($data);
        }

        if(isset($request->bankDetailsForm)){
            return response()->json(['status' => true, 'message' => 'Settings updated successfully',"data" => $data], 200);
        }else{
            return redirect()->route('settingForm')->with('success', 'Settings updated successfully');
        }
    }
}
