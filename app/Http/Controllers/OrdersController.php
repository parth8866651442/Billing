<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\Client;
use App\Models\Products;
use Auth;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $items = Order::with('clientDetail')->where('is_deleted',0);
            
            if ($search = $request->search) {
                $items->where(function ($query) use ($search) {
                    $query->where('fullname', 'like', '%' . $search . '%');
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
            return view('orders.datatableList', compact('items'));
        } else {
            return view('orders.list');
        }
    }

    public function form(Request $request, $itemID='')
    {  
        $clients = Client::get();

        if($itemID){
            $item = Order::with('clientDetail')->findOrFail($itemID);
            return view('orders.form', compact('item','clients'));
        }
        return view('orders.form',compact('clients'));
    }

    public function store(Request $request)
    {
        $authUser = auth()->user();

        $data = array(
            "client_id" => $request->client_id,
            "invoice_no" => $request->invoice_no,
            "type" => $request->type,
            "create_by" => $authUser->id,
        );

        if(!empty($request->fullname)){
            $data['fullname'] = $request->fullname;
        }
        
        if(!empty($request->sip_vehicle_no)){
            $data['sip_vehicle_no'] = $request->sip_vehicle_no;
        }
        
        if(!empty($request->moblie_no)){
            $data['moblie_no'] = $request->moblie_no;
        }

        $item_add = Order::create($data);
        
        if (!is_null($item_add)) {
            return redirect()->route('orderList')->with('success', 'Order created successfully');
        } else {
            return redirect()->route('orderList')->with('error', 'Order created unsuccessfully');
        }
    }

    public function update(Request $request, $itemID)
    {
        $authUser = auth()->user();
        
        $items = Order::findOrFail($itemID);
        $items->client_id = $request->client_id;
        $items->type = $request->type;
        $items->update_by = $authUser->id;

        if(!empty($request->fullname)){
            $items->fullname = $request->fullname;
        }
        
        if(!empty($request->sip_vehicle_no)){
            $items->sip_vehicle_no = $request->sip_vehicle_no;
        }
        
        if(!empty($request->moblie_no)){
            $items->moblie_no = $request->moblie_no;
        }

        if ($items->save()) {
            return redirect()->route('orderList')->with('success', 'Order updated successfully');
        } else {
            return redirect()->route('orderList')->with('error', 'Order updated unsuccessfully');
        }
    }

    public function destroy($itemID)
    {   
        $authUser = auth()->user();
        $items = Order::findOrFail($itemID);
        $items->is_deleted = 1;
        $items->update_by = $authUser->id;
        if ($items->save()) {
            return response()->json(['status' => true, 'message' => 'Order removed successfully'], 200);
        } else {
            return response()->json(['status' => false, 'message' => 'Order removed unsuccessfully'], 200);
        }
    }
}
