<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Payments;
use App\Models\Order;
use App\Models\Client;

class PaymentsController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $items = Payments::with('orderDetail')->whereHas('orderDetail', function($q) {
                $q->where('is_deleted', 0);
            });
            
            if (!empty($orderID = $request->order_id)) {
                $items->where('order_id',$orderID);
            }

            if (!empty($clientID = $request->client_id)) {
                $items->whereHas('orderDetail', function($q) use($clientID) {
                    $q->where('client_id', $clientID);
                });
            }

            $items->orderBy('created_at', 'DESC');

            $items = $items->paginate(PAGINATE);
            return view('payments.datatableList', compact('items'));
        } else {
            $orders = Order::where(['is_deleted'=>0,'type'=>'orignal'])->get();
            $clients = Client::where(['is_deleted'=>0])->get();
            return view('payments.list', compact('orders','clients'));
        }
    }

    public function receivePaymentDetails(Request $request){
        
        $items = Order::with('paidAmountSum')->where(['is_deleted'=>0,'type'=>'orignal','id'=>$request->id])->first();

        $dueAmount = $items->total - $items->paidAmountSum->sum('amount');
        $data = [
            'order_id' => $items->id,
            'invoice_no' => $items->invoice_no,
            'due_amount' => $dueAmount,
            'paid_amount' => $items->paidAmountSum->sum('amount')
        ];

        return response()->json(['status' => true, 'data' => $data], 200);
    }

    public function receivePayment(Request $request){
        
        $validator = [
            'order_id' => 'required',
            'due_amount' => 'required',
            'date' => 'required',
            'amount' => 'required',
            'note' => 'required'
        ];

        $validator = Validator::make($request->all(), $validator);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => join(", ",$validator->errors()->all())], 200);
        } else {
            $authUser = auth()->user();

            $data = [
                'order_id' => $request->order_id,
                'due_amount' => $request->due_amount,
                'paid_amount' => $request->paid_amount,
                'date' => $request->date,
                'amount' => $request->amount,
                'payment_type' => $request->payment_type,
                'cheque_no' => $request->cheque_no,
                'cheque_date' => $request->cheque_date,
                'transaction_no' => $request->transaction_no,
                'note' => $request->note,
                'create_by' => $authUser->id
            ];

            $items = Payments::create($data);
            if(!is_null($items)){
                if($request->amount >= $request->due_amount){
                    $items = Order::where(['type'=>'orignal','id'=>$request->order_id])->first();
                    $items->status = 'completed';
                    $items->save();
                }
                
                return response()->json(['status' => true, 'msg' => 'Payment received successfully' ], 200);
            }else{
                return response()->json(['status' => false, 'msg' => 'Payment failed, Please try again.'], 200);
            }
        }
    }
}
