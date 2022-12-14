<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\Client;
use App\Models\Products;
use App\Models\OrderItems;
use App\Models\Settings;
use Carbon\Carbon;
use Auth,DB;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $items = Order::with('clientDetail')->where(['is_deleted'=>0,'type'=>'orignal']);
            
            if (!empty($search = $request->search)) {
                $items->where(function ($query) use ($search) {
                    $query->where('fullname', 'like', '%' . $search . '%')
                    ->orWhere('invoice_no', 'like', '%' . $search . '%');
                });
            }

            if(!empty($request->from) && !empty($request->to)){
                $fromDate = Carbon::createFromFormat('d/m/Y', $request->from)->format('Y-m-d');
                $toDate = Carbon::createFromFormat('d/m/Y', $request->to)->format('Y-m-d');
                $items->whereBetween('date', [$fromDate,$toDate]);
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
        $clients = Client::where('is_deleted', 0)->get();
        $products = Products::where('is_deleted', 0)->get();
        $settings = Settings::first();
        
        if($itemID){
            $item = Order::with('orderItemsDetail','orderItemsDetail.productDetail','clientDetail','paidAmountSum')->findOrFail($itemID);
            if($item->status === 'completed'){
                return view('orders.view', compact('item','clients','products','settings'));
            }else{
                return view('orders.form', compact('item','clients','products','settings'));
            }
        }
        return view('orders.form',compact('clients','products','settings'));
    }

    public function store(Request $request)
    {
        $authUser = auth()->user();

        $data = array(
            "client_id" => $request->client_id,
            "invoice_no" => invoiceNumber('orignal'),
            "type" => 'orignal',
            "create_by" => $authUser->id,
        );

        if(!empty($request->fullname)){
            $data['fullname'] = $request->fullname;
        }

        if(!empty($request->date)){
            $data['date'] = Carbon::createFromFormat('d-m-Y', $request->date)->format('Y-m-d');
        }
        
        if(!empty($request->sip_vehicle_no)){
            $data['sip_vehicle_no'] = $request->sip_vehicle_no;
        }
        
        if(!empty($request->moblie_no)){
            $data['moblie_no'] = $request->moblie_no;
        }

        if(!empty($request->status)){
            $data['status'] = $request->status;
        }

        if(!empty($request->total)){
            $data['total'] = $request->total;
        }
        
        $item_add = Order::create($data);
        
        if (!is_null($item_add)) {
            $itemData = $item_add->fresh();

            // items
            if(!empty($request->items)){
                foreach($request->items as $key => $value)
                {   
                    $data = array(
                        "order_id" => $itemData->id,
                        "product_id" => $value['product_id'],
                        "price" => $value['price'],
                        "qty" => $value['qty'],
                        "amount" => $value['amount']
                    );
                    OrderItems::create($data); 
                }
            }

            if($request->terms_conditions){
                $settingData = [];
                
                $settings = Settings::first();

                if(isset($request->terms_conditions)){
                    $settingData['terms_conditions'] = $request->terms_conditions;
                }
        
                if(!is_null($settings)){
                    $settingData['update_by'] = $authUser->id;
        
                    Settings::where('id', $settings->id)->update($settingData);
                }else{
                    $settingData['create_by'] = $authUser->id;
                    Settings::create($settingData);
                }
            }
            return redirect()->route('viewClient',["id" => $request->client_id])->with('success', 'Order created successfully');
        } else {
            return redirect()->route('orderList')->with('error', 'Order created unsuccessfully');
        }
    }

    public function update(Request $request, $itemID)
    {
        $authUser = auth()->user();
        
        $items = Order::findOrFail($itemID);
        $items->client_id = $request->client_id;
        $items->type = 'orignal';
        $items->update_by = $authUser->id;

        if(!empty($request->fullname)){
            $items->fullname = $request->fullname;
        }

        if(!empty($request->date)){
            $items->date = Carbon::createFromFormat('d-m-Y', $request->date)->format('Y-m-d');
        }
        
        if(!empty($request->sip_vehicle_no)){
            $items->sip_vehicle_no = $request->sip_vehicle_no;
        }
        
        if(!empty($request->moblie_no)){
            $items->moblie_no = $request->moblie_no;
        }

        if(!empty($request->status)){
            $items->status = $request->status;
        }

        if(!empty($request->total)){
            $items->total = $request->total;
        }

        if ($items->save()) {
            // items
            if(!empty($request->items)){
                foreach($request->items as $key => $value)
                {   
                    $data = array(
                        "order_id" => $itemID,
                        "product_id" => $value['product_id'],
                        "price" => $value['price'],
                        "qty" => $value['qty'],
                        "amount" => $value['amount']
                    );

                    if (!empty($value['item_id'])) {
                        OrderItems::where('id', $value['item_id'])->update($data);
                    }else{
                        OrderItems::create($data); 
                    }
                }
            }

            if($request->terms_conditions){
                $settingData = [];
                
                $settings = Settings::first();

                if(isset($request->terms_conditions)){
                    $settingData['terms_conditions'] = $request->terms_conditions;
                }
        
                if(!is_null($settings)){
                    $settingData['update_by'] = $authUser->id;
        
                    Settings::where('id', $settings->id)->update($settingData);
                }else{
                    $settingData['create_by'] = $authUser->id;
                    Settings::create($settingData);
                }
            }
            
            return redirect()->route('viewClient',["id" => $request->client_id])->with('success', 'Order updated successfully');
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

    public function removeItem($itemID)
    {
        $data = OrderItems::where('id', $itemID)->first();
        if(!is_null($data)){
            $items = OrderItems::where('id', $itemID)->delete();
            if (!is_null($items)) {
                return response()->json(['status' => true, 'message' => 'Order item removed successfully'], 200);
            } else {
                return response()->json(['status' => false, 'message' => 'Order item removed unsuccessfully'], 200);
            }
        }else{
            return response()->json(['status' => false, 'message' => 'Order item not available'], 200);
        }
    }

    public function productPrice($itemID)
    {
        $data = Products::where('id', $itemID)->first();
        if(!is_null($data)){
            return response()->json(['status' => true, 'price' => $data->price ], 200);
        }else{
            return response()->json(['status' => false, 'price' => 0], 200);
        }
    }

    public function clientOrders(Request $request, $itemID='')
    {
        $items = Order::with('clientDetail')->where(['client_id'=>$itemID,'is_deleted'=>0,'type'=>'orignal']);
        
        if (!empty($search = $request->search)) {
            $items->where(function ($query) use ($search) {
                $query->where('fullname', 'like', '%' . $search . '%')
                ->orWhere('invoice_no', 'like', '%' . $search . '%');
            });
        }

        if(!empty($request->from) && !empty($request->to)){
            $fromDate = Carbon::createFromFormat('d/m/Y', $request->from)->format('Y-m-d');
            $toDate = Carbon::createFromFormat('d/m/Y', $request->to)->format('Y-m-d');
            $items->whereBetween('date', [$fromDate,$toDate]);
        }

        $items->orderBy('created_at', 'DESC');
        $items = $items->get();

        return response()->json(['status' => true, 'data' => $items], 200);
    }

    public function getOrders(Request $request){
        $items = Order::with('clientDetail')->where(['is_deleted'=>0,'type'=>'orignal']);
        
        if (!empty($search = $request->search)) {
            $items->where(function ($query) use ($search) {
                $query->where('invoice_no', 'like', '%' . $search . '%');
            });
        }

        $items = $items->orderBy('created_at', 'DESC')->limit(5)->get();
        $response = array();
        foreach($items as $item){
            $response[] = array(
                "id"=>$item->id,
                "text"=>$item->invoice_no.' ('.$item->clientDetail->name.')'
            );
        }
        return response()->json($response); 
    }
}