<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;
use App\Models\Order;
use Dompdf\Dompdf;

class InvoicesController extends Controller
{
    public function index(Request $request, $itemID='')
    {  
        $settings = Settings::first();
        if(!is_null($settings)){
            $fileName = date('dmyhis').str_replace(' ', '-', $settings->company_name).'.pdf';

            $orders = Order::with('orderItemsDetail','orderItemsDetail.productDetail','orderItemsDetail.productDetail.categoryDetail')->findOrFail($itemID);
            $orders->orderItemsDetail = array_chunk($orders->orderItemsDetail->toArray(),15);
            
            /* echo '<pre>';
            print_r($orders->toArray());
            exit; */
            // return view('invoice.invoice',compact('settings','orders'));
            // instantiate and use the dompdf class
            $dompdf = new Dompdf();
            $dompdf->loadHtml(view('invoice.invoice',compact('settings','orders')));
            $dompdf->set_option('isRemoteEnabled', true);
            
            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper('A4', 'portrait');
            // $dompdf->setPaper('A4', 'landscape');
    
            // Render the HTML as PDF
            $dompdf->render();
            
            // Output the generated PDF to Browser
            $dompdf->stream($fileName,array("Attachment" => true));
        }
        
    }

    public function view(Request $request, $itemID=''){
        $settings = Settings::first();
        $item = Order::with('orderItemsDetail','orderItemsDetail.productDetail','orderItemsDetail.productDetail.categoryDetail','clientDetail','paidAmountSum')->where(['id'=>$itemID,'is_deleted'=>0,'type'=>'orignal'])->first();
        return view('invoice.invoiceView', compact('item','settings'));
    }
}
