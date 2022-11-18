<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Auth, Hash;
use Image;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $authUser = auth()->user();

        if ($request->ajax()) {
            $items = User::where('is_deleted',0)->whereIn('role',array('admin','employee'));
            
            if ($search = $request->search) {
                $items->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
            }

            if ($request->status != '') {
                $items->where('is_active', $request->status);
            }

            $sortby = $request->sortby;
            if ($sortby) {
                $items->orderBy($sortby, 'asc');
            }else{
                $items->orderBy('created_at', 'DESC');
            }

            $items = $items->paginate(PAGINATE);
            return view('users.datatableList', compact('items'));
        } else {
            return view('users.list');
        }
    }

    public function form(Request $request, $itemID='')
    {   
        if($itemID){
            $item = User::findOrFail($itemID);
            return view('users.form', compact('item'));
        }
        return view('users.form');
    }

    public function store(Request $request)
    {
        $validator = [
            'role' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone_no' => 'required|digits:10',
            'image' => 'nullable|mimes:jpeg,jpg,png|mimetypes:image/*',
        ];

        $validator = Validator::make($request->all(), $validator);

        if ($validator->fails()) {
            return redirect()->route('addUser')->with('error', join(", ",$validator->errors()->all()));
        } else {
            $authUser = auth()->user();

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

            $data = array(
                "role" => $request->role,
                "name" => $request->name,
                "email" => $request->email,
                "phone_no" => $request->phone_no,
                "create_by" => $authUser->id,
                "password" => Hash::make($request->password),
                "image" => $imageName
            );
            
            $item_add = User::create($data);
            
            if (!is_null($item_add)) {
                return redirect()->route('userList')->with('success', 'User created successfully');
            } else {
                return redirect()->route('userList')->with('error', 'User created unsuccessfully');
            }
        }
    }

    public function update(Request $request, $itemID)
    {
        $validator = [
            'role' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$request->id,
            'phone_no' => 'required|digits:10',
            'image' => 'nullable|mimes:jpeg,jpg,png|mimetypes:image/*',
        ];

        $validator = Validator::make($request->all(), $validator);

        if ($validator->fails()) {
            return redirect()->route('editUser',$request->id)->with('error', join(", ",$validator->errors()->all()));
        }else{
            $authUser = auth()->user();

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
    
            $items = User::findOrFail($itemID);
            $items->role = $request->role;
            $items->name = $request->name;
            // $items->user_type = $request->user_type;
            $items->email = $request->email;
            $items->phone_no = $request->phone_no;
            $items->update_by = $authUser->id;

            if(!empty($request->password)){
                $items->password = Hash::make($request->password);
            }

            if ($imageName != '') {
                $items->image = $imageName;
            }
            
            if ($items->save()) {
                return redirect()->route('userList')->with('success', 'User updated successfully');
            } else {
                return redirect()->route('userList')->with('error', 'User updated unsuccessfully');
            }
        }
    }

    public function destroy($itemID)
    {   
        $authUser = auth()->user();
        $items = User::findOrFail($itemID);
        $items->is_deleted = 1;
        $items->update_by = $authUser->id;
        if ($items->save()) {
            return response()->json(['status' => true, 'message' => 'User removed successfully'], 200);
        } else {
            return response()->json(['status' => false, 'message' => 'User removed unsuccessfully'], 200);
        }
    }

    public function checkuserEmailRepeat(Request $request)
    {
        $email=$request->email;
        $id=$request->id;

        $items = User::select('id');
        
        if (($request->action === 'edit') && ($id!=null || $id!='' || $id>0)) {
            $items->where('id', '!=', $id);
        } 

        $items->where('email', $email);
        $query = $items->get();
        if ($query->count() > 0) { echo 'false'; } else { echo 'true'; }
    }
}
