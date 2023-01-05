<div class="invoice-item invoice-item-one">
    <div class="row">
        <div class="col-md-6">
            <div class="invoice-logo">
                <img src="{{ imageUrl(isset($settings->logo_img) ? $settings->logo_img : '', 'setting','no_image.jpg','thumbnail') }}" alt="logo" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="invoice-info">
                <div class="invoice-head">
                    <h2 class="text-primary">Invoice</h2>
                    <p>Invoice No : {{$item->invoice_no}}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="invoice-item invoice-item-bg">
    <div class="row">
        <div class="col-lg-4 col-md-12">
            <div class="invoice-info">
                <strong class="customer-text-one">Billed to</strong>
                <h6 class="invoice-name">{{$item->fullname.' ('.$item->clientDetail->name.')'}}</h6>
                <p class="invoice-details invoice-details-two">
                    <span>Moblie No : {{$item->moblie_no}}</span>
                </p>
                <p class="invoice-details invoice-details-two">
                {!! isset($item->clientDetail)? nl2br($item->clientDetail->address) :'' !!}
                </p>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="invoice-info">
                <strong class="customer-text-one">Invoice From</strong>
                <h6 class="invoice-name">Company Name</h6>
                <p class="invoice-details invoice-details-two">
                {!! isset($settings->address)? nl2br($settings->address) : '' !!}
                </p>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="invoice-info invoice-info-one border-0">
                <p>Issue Date : {{date('d/m/Y', strtotime($item->date))}}</p>
                <!-- <p>Due Date : 27 Aug 2022</p> -->
                <p>Due Amount : {{number_format($item->total,2)}}</p>
            </div>
        </div>
    </div>
</div>

<div class="invoice-item invoice-table-wrap">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="invoice-table table table-center mb-0">
                    <thead>
                        <tr>
                            <th>Items</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($item->orderItemsDetail as $key => $orderitem)
                        <tr>
                            <td>{{$orderitem->productDetail->name.' ('.$orderitem->productDetail->categoryDetail->name.')'}}</td>
                            <td>{{number_format($orderitem->price,2)}}</td>
                            <td>{{$orderitem->qty}}</td>
                            <th>{{number_format($orderitem->amount,2)}}</th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row align-items-center justify-content-center">
    <div class="col-lg-6 col-md-6">
        <div class="invoice-payment-box">
            <h4>Payment Details</h4>
            <div class="payment-details">
            <p>{{isset($settings->bd_bank_name)? $settings->bd_bank_name : '' }}({{isset($settings->bd_holdare_name)? $settings->bd_holdare_name : '' }}) <br />
            IFSC Code : {{isset($settings->bd_ifsc_code)? $settings->bd_ifsc_code : '' }}<br />
            Account No : {{isset($settings->bd_account_no)? $settings->bd_account_no : '' }}</p>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="invoice-total-card">
            <div class="invoice-total-box">
                <div class="invoice-total-footer">
                    <h4>Total Amount <span>{{number_format($item->total,2)}}</span></h4>
                </div>
                <div class="invoice-total-inner">
                    <p>Total Due <span>{{number_format($item->total - $item->paidAmountSum->sum('amount'),2)}}</span></p>
                    <p class="mb-0">Total Paid <span>{{number_format($item->paidAmountSum->sum('amount'),2)}}</span></p>
                </div>
                
            </div>
        </div>
    </div>
</div>
<div class="invoice-sign-box">
    <div class="row">
        <div class="col-lg-8 col-md-8">
            <div class="invoice-terms mb-0">
                <h6>Terms and Conditions:</h6>
                <p class="mb-0">
                    {{$settings->terms_conditions}}
                </p>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="invoice-sign text-end">
                <img class="img-fluid d-inline-block" src="{{ imageUrl(auth()->user()->sign_img, 'setting','','thumbnail') }}" alt="sign" />
                <span class="d-block">Harristemp</span>
            </div>
        </div>
    </div>
</div>