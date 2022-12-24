@extends('layouts.app')

@section('content')

@push('style')
<link rel="stylesheet" href="{{ asset('assets/plugins/icons/feather/feather.css') }}" />
<link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css'); }}" />
@endpush

<div class="content container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <!-- <h3 class="page-title">Users</h3> -->
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Order</a>
                    </li>
                    <li class="breadcrumb-item active">Add Order</li>
                </ul>

                <div class="btn-back">
                    <a href="{{route('orderList')}}"><button class="btn btn-primary btn-sm" type="button"><i
                                class="fas fa-chevron-left"></i> Back</button></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card invoices-add-card">
                <div class="card-body">
                    <form method="POST"
                        action="{{(isset($item)) ? route('updateOrder',['id'=>$item->id]) : route('storeOrder')}}"
                        class="invoices-form" id="orderForm">
                        <div class="invoices-main-form">
                            <div class="row">
                                <div class="col-xl-4 col-md-6 col-sm-12 col-12">
                                    @csrf
                                    <div class="form-group">
                                        <label>Customer Name</label>
                                        <select class="select select2" name="client_id" id="client_id"
                                            onChange="customerFindAddress(this.value)">
                                            <option value="">Select Customer</option>
                                            @foreach($clients as $client)
                                            <option
                                                {{isset($item->client_id) &&  $item->client_id === $client->id? 'selected' :''}}
                                                value='{{$client->id}}'> {{ $client->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Full Name" value="{{isset($item->fullname) ? $item->fullname :''  }}">
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Moblie No</label>
                                        <input type="text" name="moblie_no" id="moblie_no" class="form-control"
                                            placeholder="Moblie No"
                                            value="{{isset($item->clientDetail->phone_no) ? $item->clientDetail->phone_no :$item->moblie_no  }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Sip Vehicle No</label>
                                        <input type="text" name="sip_vehicle_no" id="sip_vehicle_no"
                                            class="form-control" placeholder="Sip Vehicle No"
                                            value="{{isset($item->sip_vehicle_no) ? $item->sip_vehicle_no :''  }}">
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
                                                    <select class="select select2" name="status" id="status">
                                                        @foreach (config('constants.order_status') as $i => $Ostatus)
                                                            <option value="{{$Ostatus['value']}}" {{isset($item->status) &&  $item->status === $Ostatus['value']? 'selected' :''}}>{{$Ostatus['title']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="invoice-inner-footer">
                                            <div class="row align-items-center">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="invoice-inner-date">
                                                        <span> Date
                                                            <input class="form-control datetimepicker" name="date" type="text" placeholder="Select" value="{{isset($item->date) ? date('d/m/Y', strtotime($item->date)) :''  }}" />
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
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- order add -->
                                        @if(!isset($item->orderItemsDetail) || (count($item->orderItemsDetail) === 0))
                                        <tr class="add-row">
                                            <td>
                                                <select class="select select2" name="items[0][product_id]"
                                                    id="product_id-0" onChange="selectProduct(this.value,0)">
                                                    <option value="">Select Product</option>
                                                    @foreach($products as $product)
                                                    <option value="{{$product->id}}">{{ $product->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="items[0][price]"
                                                    id="price-0" value="" />
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="items[0][qty]" id="qty-0"
                                                    value="1" />
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="items[0][amount]"
                                                    id="amount-0" value="" />
                                            </td>
                                            <td class="add-remove text-center">
                                                <a href="javascript:void(0);" class="add-btn me-2"><i
                                                        class="fas fa-plus-circle"></i></a>
                                            </td>
                                        </tr>
                                        @endif

                                        <!-- order update -->
                                        @isset($item->orderItemsDetail)
                                        @foreach($item->orderItemsDetail as $key => $orderitem)
                                        <tr class="add-row">
                                            <td>
                                                <input type="hidden" name="items[{{$key}}][item_id]"
                                                    value="{{$orderitem->id}}">
                                                <select class="select select2" name="items[{{$key}}][product_id]"
                                                    id="product_id-{{$key}}"
                                                    onChange="selectProduct(this.value,{{$key}})">
                                                    <option value="">Select Product</option>
                                                    @foreach($products as $product)
                                                    <option value="{{$product->id}}"
                                                        {{isset($orderitem->product_id) &&  $orderitem->product_id === $product->id ? 'selected' :'' }}>
                                                        {{ $product->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="items[{{$key}}][price]"
                                                    id="price-{{$key}}" value="{{$orderitem->price}}" />
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="items[{{$key}}][qty]"
                                                    id="qty-{{$key}}" value="{{$orderitem->qty}}" />
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="items[{{$key}}][amount]"
                                                    id="amount-{{$key}}" value="{{$orderitem->amount}}" />
                                            </td>
                                            <td class="add-remove text-center">
                                                @if($key === 0)
                                                <a href="javascript:void(0);" class="add-btn me-2"><i
                                                        class="fas fa-plus-circle"></i></a>
                                                @else
                                                <a href="javascript:void(0);" class="remove-btn"
                                                    onclick="removeOrderItemid({{$orderitem->id}})"><i
                                                        class="fe fe-trash-2"></i></a>
                                                @endif
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
                                            IFSC Code : {{isset($settings->bd_ifsc_code)? $settings->bd_ifsc_code : '' }} <br /> 
                                            Account No : {{isset($settings->bd_account_no)? $settings->bd_account_no : '' }}</p>
                                        </div>
                                        @else
                                        <a class="btn btn-primary" href="#" data-bs-toggle="modal"
                                            data-bs-target="#bank_details"><i class="fas fa-plus-circle me-2"></i>Add
                                            Bank Details</a>
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
                                                        <textarea
                                                            class="form-control" name="terms_conditions">{{isset($settings->terms_conditions)? $settings->terms_conditions : '' }}</textarea>
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
                                            <input type="hidden" name="total" id="total"
                                                value="{{isset($item->total) ? $item->total :'00'}}">
                                            <h4>Total Amount <span id="amountDue">{{isset($item->total) ? number_format($item->total,2) :'00.00'}} Rs.</span></h4>
                                        </div>
                                        <div class="invoice-total-inner">
                                            <div class="links-info-one">
                                                <div class="links-cont">
                                                    <div class="service-amount">
                                                        <a href="javascript:void(0);" class="service-trash">Pay Amount</a>
                                                        <span><input type="text" class="form-control" name="pay_amount" id="pay_amount" placeholder="00.00" value="" style="height: 30px;" {{(isset($item->paidAmountSum) && !($item->total - $item->paidAmountSum->sum('amount'))) ? 'disabled' : ''}}></span>
                                                    </div>
                                                </div>
                                                <div class="links-cont">
                                                    <div class="service-amount">
                                                        <a href="javascript:void(0);" class="service-trash">Total Due</a> <span>{{isset($item->paidAmountSum) ? number_format($item->total - $item->paidAmountSum->sum('amount'),2) : '00.00'}}</span>
                                                    </div>
                                                </div>
                                                <div class="links-cont">
                                                    <div class="service-amount">
                                                        <a href="javascript:void(0);" class="service-trash">Total Paid</a> <span>{{isset($item->paidAmountSum) ? number_format($item->paidAmountSum->sum('amount'),2) : '00.00'}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="upload-sign">
                                    <div class="form-group float-end mb-0">
                                        <button class="btn btn-primary" type="submit">Save Invoice</button>
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
<div class="modal custom-modal fade bank-details" id="bank_details" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="form-header text-start mb-0">
                    <h4 class="mb-0">Add Bank Details</h4>
                </div>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('updateSetting')}}" method="POST" id="bankDetailsForm">
                <div class="modal-body">
                    <div class="bank-inner-details">
                        <div class="row">
                            <input type="hidden" name="bankDetailsForm" value="1">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Account Holder Name</label>
                                    <input type="text" class="form-control" name="holdare_name"
                                        placeholder="Add Name" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Bank name</label>
                                    <input type="text" class="form-control" name="bank_name"
                                        placeholder="Add Bank name" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>IFSC Code</label>
                                    <input type="text" class="form-control" name="ifsc_code" id="ifsc_code"
                                        placeholder="IFSC Code" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Account Number</label>
                                    <input type="text" class="form-control" name="account_no" id="account_no"
                                        placeholder="Account Number" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="bank-details-btn">
                        <a href="javascript:void(0);" data-bs-dismiss="modal"
                            class="btn bank-cancel-btn me-2">Cancel</a>
                        <button class="btn bank-save-btn" type="submit">Save Item</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{asset('assets/js/validate/jquery.validate.js'); }}" type="text/javascript"></script>
<script src="{{asset('assets/js/validate/additional-methods.min.js'); }}" type="text/javascript"></script>
<script src="{{asset('assets/js/validate/validation.js'); }}" type="text/javascript"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function() {
        var addOrderForm = $("#orderForm");
        var validator = addOrderForm.validate({
            rules: {
                fullname: {
                    required: true
                },
                date: {
                    required: true
                }
            },
            messages: {
                fullname: {
                    required: "This field is required"
                },
                date: {
                    required: "This field is required"
                }
            }
        });
});

// Invoices Table Add More
$(".add-table-items").on('click', '.remove-btn', function() {
    $(this).closest('.add-row').remove();
    return false;
});

let i = <?php if(isset($item)) {echo count($item->orderItemsDetail); } else { echo 0; } ?>;

$(document).on("click", ".add-btn", function() {
    ++i;
    let experiencecontent = `<tr class="add-row"><td><select class="select select2" name="items[${i}][product_id]" id="product_id-${i}"  onChange="selectProduct(this.value,${i})"><option value="">Select Product</option>@foreach($products as $product)<option value="{{$product->id}}"> {{ $product->name }}</option>@endforeach</select></td><td><input type="text" class="form-control" name="items[${i}][price]" id="price-${i}" value=""></td><td><input type="text" class="form-control" name="items[${i}][qty]" id="qty-${i}" value="1"></td><td><input type="text" class="form-control" name="items[${i}][amount]" id="amount-${i}" value=""></td><td class="add-remove text-center"><a href="javascript:void(0);" class="remove-btn"><i class="fe fe-trash-2"></i></a></td></tr>
        `;

    $(".add-table-items").append(experiencecontent);

    $(".select").select2();

    return false;
});

$(document).on('blur', "[id^=price-]", function() {
    calculateTotal();
});

$(document).on('blur', "[id^=qty-]", function() {
    calculateTotal();
});

$(document).on("click", ".add-links", function() {
    var experiencecontent = '<div class="links-cont">' +
        '<div class="service-amount">' +
        '<a href="#" class="service-trash"><i class="fe fe-minus-circle me-1"></i>Service Charge</a> <span>$4</span' +
        '</div>' +
        '</div>';

    $(".links-info-one").append(experiencecontent);
    return false;
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

function removeOrderItemid(id) {
    // ajax order item remove call
    $.ajax({
        url: "{{route('orderItemRemove','')}}" + `/${id}`,
        type: 'GET',
        dataType: 'Json',
        success: function(res) {
            if (res.status) {
                toastr.success(res.message);
            } else {
                toastr.error(res.message);
            }
        }
    })
}

function selectProduct(id, key) {
    // ajax product price get call
    $.ajax({
        url: "{{route('findItemPrice','')}}" + `/${id}`,
        type: 'GET',
        dataType: 'Json',
        success: function(res) {
            if (res.status) {
                var price = $('#price-' + key).val(res.price);
                calculateTotal();
            }
        }
    })
}

function customerFindAddress(id) {
    let clientsList = <?= $clients ?>;
    let client = clientsList.filter(data => data.id == id);
    if (client.length > 0 && (client[0].address || client[0].phone_no)) {
        $('#clientAddress').text(client[0].address);
        $('#moblie_no').val(client[0].phone_no);
    } else {
        $('#clientAddress').html('');
        $('#moblie_no').val('');
    }
}

$('#bankDetailsForm').validate({
    rules: {
        holdare_name: {
            required: true
        },
        bank_name: {
            required: true
        },
        ifsc_code: {
            required: true
        },
        account_no: {
            required: true
        }
    },
    messages: {
        holdare_name: {
            required: "This field is required"
        },
        bank_name: {
            required: "This field is required"
        },
        ifsc_code: {
            required: "This field is required"
        },
        account_no: {
            required: "This field is required"
        }
    },
    submitHandler: function(form) {
        $.ajax({
            url: form.action,
            type: form.method,
            data: $(form).serialize(),
            success: function(response) {
                $('#bank_details').modal('toggle');
                $('#paymentDetails').html(`<div class="payment-details">
                    <p>${response.data.bd_bank_name}(${response.data.bd_holdare_name})
                    ${response.data.bd_ifsc_code}
                    ${response.data.bd_account_no}</p>
                </div>`);
                toastr.success(response.message);
            },
            error: function(e) {
                console.log(e)
            }
        });
    }
});
</script>
@endpush