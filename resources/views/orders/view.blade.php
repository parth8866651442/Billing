@extends('layouts.app')

@section('content')

<div class="content container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <!-- <h3 class="page-title">Users</h3> -->
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('home')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('orderList')}}">Order</a>
                    </li>
                    <li class="breadcrumb-item active">{{isset($item) ? 'View' : 'Add'}} Order</li>
                </ul>

                <div class="btn-back">
                    <a href="{{route('orderList')}}"><button class="btn btn-primary btn-sm" type="button"><i class="fas fa-chevron-left"></i> Back</button></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card invoices-add-card">
                <div class="card-body">
                    <form method="POST" action="javascript:void(0);" class="invoices-form" id="orderForm">
                        <div class="invoices-main-form">
                            <div class="row">
                                <div class="col-xl-4 col-md-6 col-sm-12 col-12">
                                    @csrf
                                    <div class="form-group">
                                        <label>Customer Name</label>
                                        <select class="select select2" name="client_id" id="client_id" disabled>
                                            <option value="{{$item->clientDetail->id}}">{{$item->clientDetail->name}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Full Name" value="{{isset($item->fullname) ? $item->fullname :''}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Moblie No</label>
                                        <input type="text" name="moblie_no" id="moblie_no" class="form-control" placeholder="Moblie No" value="{{ isset($item->moblie_no) ? $item->moblie_no :'' }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Sip Vehicle No</label>
                                        <input type="text" name="sip_vehicle_no" id="sip_vehicle_no" class="form-control" placeholder="Sip Vehicle No" value="{{isset($item->sip_vehicle_no) ? $item->sip_vehicle_no :''}}" readonly>
                                    </div>
                                </div>
                                <div class="col-xl-5 col-md-6 col-sm-12 col-12">
                                    <h4 class="invoice-details-title">Invoice details</h4>
                                    <div class="invoice-details-box">
                                        <div class="invoice-inner-head">
                                            <div class="row align-items-center">
                                                <div class="col-lg-6 col-md-6">
                                                    <span>Invoice No.<a href="javascript:void(0);">{{isset($item->invoice_no)? $item->invoice_no : invoiceNumber('orignal') }}</a></span>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <span>Status. <a href="javascript:void(0);">{{ucfirst($item->status)}}</a></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="invoice-inner-footer">
                                            <div class="row align-items-center">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="invoice-inner-date">
                                                        <span> Date
                                                            <input class="form-control datetimepicker" name="date" type="text" placeholder="Select" value="{{isset($item->date) ? date('d/m/Y', strtotime($item->date)) :''  }}" readonly/>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="invoice-inner-head">
                                                        <span>Invoice Type. <a href="javascript:void(0);">{{ucfirst('orignal')}}</a></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-item">
                            <div class="row">
                                <div class="col-xl-4 col-lg-6 col-md-6">
                                    <div class="invoice-info">
                                        <strong class="customer-text">Invoice From</strong>
                                        <p class="invoice-details invoice-details-two">
                                            {!! isset($settings->address)? nl2br($settings->address) : '' !!}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-6">
                                    <div class="invoice-info">
                                        <strong class="customer-text">Invoice To</strong>
                                        <p class="invoice-details invoice-details-two" id="clientAddress">
                                            {!! isset($item->clientDetail)? nl2br($item->clientDetail->address) :'' !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-add-table">
                            <h4>Item Details</h4>
                            <div class="table-responsive">
                                <table class="table table-center add-table-items">
                                    <thead>
                                        <tr>
                                            <th>Items</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- order update -->
                                        @isset($item->orderItemsDetail)
                                        @foreach($item->orderItemsDetail as $key => $orderitem)
                                        <tr class="add-row">
                                            <td>
                                                <input type="hidden" name="items[{{$key}}][item_id]"
                                                    value="{{$orderitem->id}}">
                                                <select class="select select2" name="items[{{$key}}][product_id]" id="product_id-{{$key}}" disabled>
                                                    <option value="{{$orderitem->productDetail->id}}" selected> {{$orderitem->productDetail->name}}</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="items[{{$key}}][price]" id="price-{{$key}}" value="{{$orderitem->price}}" readonly/>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="items[{{$key}}][qty]" id="qty-{{$key}}" value="{{$orderitem->qty}}" readonly/>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="items[{{$key}}][amount]" id="amount-{{$key}}" value="{{$orderitem->amount}}" readonly/>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endisset
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-7 col-md-6">
                                <div class="invoice-fields">
                                    <h4 class="field-title">More Fields</h4>
                                    <div class="field-box" id="paymentDetails">
                                        <p>Payment Details</p>
                                        @if(isset($settings->bd_bank_name) && isset($settings->bd_holdare_name) &&
                                        isset($settings->bd_ifsc_code) && isset($settings->bd_account_no))
                                        <div class="payment-details">
                                            <p>{{isset($settings->bd_bank_name)? $settings->bd_bank_name : '' }}({{isset($settings->bd_holdare_name)? $settings->bd_holdare_name : '' }})<br />
                                                IFSC Code :
                                                {{isset($settings->bd_ifsc_code)? $settings->bd_ifsc_code : '' }} <br />
                                                Account No :
                                                {{isset($settings->bd_account_no)? $settings->bd_account_no : '' }}</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="invoice-faq">
                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                        <div class="faq-tab">
                                            <div class="panel panel-default">
                                                <div class="panel-heading" role="tab" id="headingTwo">
                                                    <p class="panel-title">
                                                        <a class="collapsed" data-bs-toggle="collapse"
                                                            data-bs-parent="#accordion" href="#collapseTwo"
                                                            aria-expanded="false" aria-controls="collapseTwo">
                                                            <i class="fas fa-plus-circle me-1"></i>Add Terms &
                                                            Conditions
                                                        </a>
                                                    </p>
                                                </div>
                                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel"
                                                    aria-labelledby="headingTwo" data-bs-parent="#accordion">
                                                    <div class="panel-body">
                                                        <textarea class="form-control" name="terms_conditions">{{isset ($settings->terms_conditions)? $settings->terms_conditions : '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-6">
                                <div class="invoice-total-card">
                                    <h4 class="invoice-total-title">Summary</h4>
                                    <div class="invoice-total-box">
                                        <div class="invoice-total-footer">
                                            <input type="hidden" name="total" id="total" value="{{isset($item->total) ? $item->total :'00'}}">
                                            <h4>Total Amount <span id="amountDue">{{isset($item->total) ? number_format($item->total,2) :'00.00'}} Rs.</span></h4>
                                        </div>
                                        <div class="invoice-total-inner">
                                            <div class="links-info-one">
                                                <div class="links-cont">
                                                    <div class="service-amount">
                                                        <a href="javascript:void(0);" class="service-trash">Total
                                                            Due</a>
                                                        <span>{{isset($item->paidAmountSum) ? number_format($item->total - $item->paidAmountSum->sum('amount'),2) : '00.00'}}</span>
                                                    </div>
                                                </div>
                                                <div class="links-cont">
                                                    <div class="service-amount">
                                                        <a href="javascript:void(0);" class="service-trash">Total
                                                            Paid</a>
                                                        <span>{{isset($item->paidAmountSum) ? number_format($item->paidAmountSum->sum('amount'),2) : '00.00'}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="upload-sign">
                                    <div class="service-upload p-0">
                                        <img src="{{ imageUrl(auth()->user()->sign_img, 'setting','','thumbnail') }}" alt="sign"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).on('blur', "[id^=price-]", function() {
    calculateTotal();
});

$(document).on('blur', "[id^=qty-]", function() {
    calculateTotal();
});

function calculateTotal() {
    var totalAmount = 0;
    $("[id^='price-']").each(function() {
        var id = $(this).attr('id');
        id = id.replace("price-", '');
        var price = $('#price-' + id).val();
        var quantity = $('#qty-' + id).val();
        if (!quantity) {
            quantity = 1;
        }
        var total = price * quantity;
        $('#amount-' + id).val(parseFloat(total));
        totalAmount += total;
    });
    $('#total').val(totalAmount);
    $('#amountDue').text(totalAmount + ' Rs.');
}
</script>
@endpush