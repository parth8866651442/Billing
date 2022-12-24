<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Client;
use App\Models\Order;
use Auth, Hash;
use Image;

class ClientsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $items = Client::where('is_deleted',0);
            
            if ($search = $request->search) {
                $items->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
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
            return view('clients.datatableList', compact('items'));
        } else {
            return view('clients.list');
        }
    }

    public function form(Request $request, $itemID='')
    {   
        if($itemID){
            $item = Client::findOrFail($itemID);
            return view('clients.form', compact('item'));
        }
        return view('clients.form');
    }

    public function view(Request $request, $itemID){
        $item = Client::findOrFail($itemID);        
        return view('clients.view', compact('item'));
    }

    public function store(Request $request)
    {
        $validator = [
            'name' => 'required',
            'email' => 'required|email|unique:clients',
            'phone_no' => 'required|digits:10'
        ];

        $validator = Validator::make($request->all(), $validator);

        if ($validator->fails()) {
            return redirect()->route('addClient')->with('error', join(", ",$validator->errors()->all()));
        } else {
            $authUser = auth()->user();

            $data = array(
                "name" => $request->name,
                "email" => $request->email,
                "phone_no" => $request->phone_no,
                "address" => $request->address,
                "city" => $request->city,
                "pan_card_no" => $request->pan_card_no,
                "aadhaar_card_no" => $request->aadhaar_card_no,
                "password" => Hash::make($request->password),
                "create_by" => $authUser->id,
            );
            
            $item_add = Client::create($data);
            
            if (!is_null($item_add)) {
                return redirect()->route('clientList')->with('success', 'Client created successfully');
            } else {
                return redirect()->route('clientList')->with('error', 'Client created unsuccessfully');
            }
        }
    }

    public function update(Request $request, $itemID)
    {
        $validator = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$request->id,
            'phone_no' => 'required|digits:10'
        ];

        $validator = Validator::make($request->all(), $validator);

        if ($validator->fails()) {
            return redirect()->route('editClient',$request->id)->with('error', join(", ",$validator->errors()->all()));
        }else{
            $authUser = auth()->user();

            $items = Client::findOrFail($itemID);

            $items->name = $request->name;
            $items->email = $request->email;
            $items->phone_no = $request->phone_no;
            $items->address = $request->address;
            $items->city = $request->city;
            $items->pan_card_no = $request->pan_card_no;
            $items->aadhaar_card_no = $request->aadhaar_card_no;
            $items->update_by = $authUser->id;

            if(!empty($request->password)){
                $items->password = Hash::make($request->password);
            }

            if ($items->save()) {
                return redirect()->route('clientList')->with('success', 'Client updated successfully');
            } else {
                return redirect()->route('clientList')->with('error', 'Client updated unsuccessfully');
            }
        }
    }

    public function destroy($itemID)
    {   
        $authUser = auth()->user();
        $items = Client::findOrFail($itemID);
        $items->is_deleted = 1;
        $items->update_by = $authUser->id;
        if ($items->save()) {
            return response()->json(['status' => true, 'message' => 'Client removed successfully'], 200);
        } else {
            return response()->json(['status' => false, 'message' => 'Client removed unsuccessfully'], 200);
        }
    }

    public function checkClientEmailRepeat(Request $request)
    {
        $email=$request->email;
        $id=$request->id;

        $items = Client::select('id');
        
        if (($request->action === 'edit') && ($id!=null || $id!='' || $id>0)) {
            $items->where('id', '!=', $id);
        } 

        $items->where('email', $email);
        $query = $items->get();
        if ($query->count() > 0) { echo 'false'; } else { echo 'true'; }
    }
}
