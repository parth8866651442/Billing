<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\Order;
use PDF;

class invoicesController extends Controller
{
    public function index(Request $request, $itemID='')
    {  
        $settings = Settings::first();
        if(!is_null($settings)){
            $fileName = date('dmyhis').str_replace(' ', '-', $settings->company_name).'.pdf';

            $orders = Order::with('orderItemsDetail')->findOrFail($itemID);
            $orders->orderItemsDetail = array_chunk($orders->orderItemsDetail->toArray(),10);
            // echo '<pre>';
            // print_r($orders);
            // exit;
            return view('invoice.invoice',compact('settings','orders'));
            // $pdf = PDF::loadView('invoice.invoice',compact('settings'));
            // return $pdf->download($fileName);
        }
        
    }
}
