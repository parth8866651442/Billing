@extends('layouts.app')

@section('content')

@push('style')
<link rel="stylesheet" href="{{ asset('assets/plugins/icons/feather/feather.css') }}" />
<link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css'); }}" />

<style>
    .select2-container{
        z-index: 1111;
    }
</style>
@endpush

<div class="content container-fluid">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Orders</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('home')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Orders List</li>
                </ul>
            </div>
            <div class="col-auto">
                <a href="{{route('addOrder')}}" class="btn btn-primary me-1" data-container="body" data-bs-toggle="tooltip" data-bs-placement="top" title="Add Order"><i class="fas fa-plus"></i></a>
                <a class="btn btn-primary filter-btn" href="javascript:void(0);" id="filter_search" data-container="body" data-bs-toggle="tooltip" data-bs-placement="top" title="Filters">
                    <i class="fas fa-filter"></i>
                </a>
            </div>
        </div>
    </div>
    <div id="filter_inputs" class="card filter-card">
        <div class="card-body pb-0">
            <div class="row">
                <div class="col-sm-6 col-md-2">
                    <div class="form-group">
                        <input type="text" class="form-control" name="daterange" id="daterangeInput" value="" />
                    </div>
                </div>
                <div class="col-sm-6 col-md-2">
                    <div class="form-group">
                        <input type="text" placeholder="Fullname,Invoiceno" class="form-control" id="searchInput" />
                    </div>
                </div>
                <div class="col-sm-2 col-md-2">
                    <button onclick="getOrders(false,$('#daterangeInput').val())" class="btn btn-primary"><i class="fas fa-search"></i> Filter</button> 
                    <button onclick="resetFilter()" class="btn btn-primary"><i class="fas fa-redo"></i> Reset</button> 
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive" id="orderList"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{asset('assets/js/validate/jquery.validate.js'); }}" type="text/javascript"></script>
<script src="{{asset('assets/js/validate/additional-methods.min.js'); }}" type="text/javascript"></script>
<script src="{{asset('assets/js/validate/validation.js'); }}" type="text/javascript"></script>

<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<div id="receive-payment-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none" data-bs-backdrop="static" data-bs-keyboard="false">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title"> Add Payment</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{route('receivePayments')}}" method="post" id="payDetailsForm">
            <div class="modal-body p-4">
                <div class="row">
                   <div class="col-md-4">
                      <div class="mb-3">
                        <label for="invoice_no" class="form-label">Invoice</label>
                        <input type="text" class="form-control" id="invoice_no" name="invoice_no" placeholder="Invoice" value="" require readonly/>
                        <input type="hidden" class="form-control" id="order_id" name="order_id" value=""/>
                      </div>
                   </div>
                   <div class="col-md-4">
                      <div class="mb-3">
                         <label for="due_amount" class="form-label">Due Amount</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="due_amount" id="due_amount" require placeholder="00.00" readonly/>
                                <span class="input-group-text"><i class="fa fa-rupee-sign"></i></span>
                            </div>
                      </div>
                   </div>
                   <div class="col-md-4">
                      <div class="mb-3">
                        <label for="paid_amount" class="form-label">Paid Amount</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="paid_amount" id="paid_amount" placeholder="00.00" readonly/>
                            <span class="input-group-text"><i class="fa fa-rupee-sign"></i></span>
                        </div>
                      </div>
                   </div>
                </div>
                <div class="row">
                   <div class="col-md-4">
                      <div class="mb-3">
                         <label for="date" class="form-label">Payment Date</label>
                         <input type="text" class="form-control datetimepicker" require name="date" id="date" value=""/>
                      </div>
                   </div>
                   <div class="col-md-4">
                      <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="amount" id="amount" require placeholder="00.00" aria-label="amount" aria-describedby="amount"/>
                            <span class="input-group-text"><i class="fa fa-rupee-sign"></i></span>
                        </div>
                      </div>
                   </div>
                   <div class="col-md-4">
                      <div class="mb-3">
                         <label for="payment_type" class="form-label">Payment Mode</label>
                            <select class="form-control select select2" name="payment_type" id="payment_type" onchange="checkType(this.value)">
                                <option value="cash">Cash</option>
                                <option value="cheque">Cheque</option>
                                <option value="online">Online</option>
                            </select>
                      </div>
                   </div>
                   <div class="col-md-6" id="chequeNoTag" style="display:none">
                      <div class="mb-3">
                         <label for="cheque_no" class="form-label">Cheque No</label>
                         <input type="text" name="cheque_no" id="cheque_no" class="form-control" placeholder="0" value="">
                      </div>
                   </div>
                   <div class="col-md-6" id="chequeDateTag" style="display:none">
                      <div class="mb-3">
                         <label for="cheque_date" class="form-label">Cheque Date</label>
                         <input type="text" name="cheque_date" id="cheque_date" class="form-control datetimepicker" placeholder="0" value="">
                      </div>
                   </div>
                   <div class="col-md-6" id="transactionNoTag" style="display:none">
                      <div class="mb-3">
                         <label for="transaction_no" class="form-label">Transaction No</label>
                         <input type="text" name="transaction_no" id="transaction_no" class="form-control" placeholder="0" value="">
                      </div>
                   </div>
                </div>
                <div class="row">
                   <div class="col-md-12">
                      <div class="">
                         <label for="note" class="form-label">Note</label>
                         <textarea class="form-control" id="note" name="note" require rows="5"></textarea>
                      </div>
                   </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <span class="spinner-border spinner-border-sm me-2" role="status"></span> -->
                <button class="btn btn-primary waves-effect waves-light" type="submit">Pay</button>
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
      </div>
   </div>
</div>

<script>
// user list default page 1 recode get
$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.datetimepicker').datetimepicker({
        format: 'DD-MM-YYYY',
    });

    $('input[name="daterange"]').daterangepicker({
        startDate: moment().startOf('month'),
        endDate: moment().endOf('month'),
        locale: { 
            format: 'DD/MM/YYYY'
        }
    });
    // ajax user list get 
    getOrders();
    
    // qurey param mathi page no get
    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getOrders(page);
    });

    $('#payDetailsForm').validate({
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.form-control').removeClass('has-success').addClass('has-error');     
        },
        errorPlacement: function (error, element) {
            if(element.hasClass('select2') && element.next('.select2-container').length) {
                error.insertAfter(element.next('.select2-container'));
            } else {
                error.insertAfter(element.parent());
            }
        },
        rules: {
            invoice_no: {
                required: true
            },
            due_amount: {
                required: true
            },
            date: {
                required: true
            },
            amount: {
                required: true,
                number: true
            },
            note: {
                required: true
            }
        },
        messages: {
            invoice_no: {
                required: "This field is required."
            },
            due_amount: {
                required: "This field is required."
            },
            date: {
                required: "This field is required."
            },
            amount: {
                required: "This field is required.",
                number: "Please enter a valid amount."
            },
            note: {
                required: "This field is required."
            }
        },
        submitHandler: function(form) {
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response) {
                    if(response.status){
                        $('#receive-payment-modal').modal('toggle');
                        toastr.success(response.msg);
                        
                        $('#payDetailsForm').each(function(){
                            this.reset();
                        });
                    }else{
                        toastr.error(response.msg);
                    }
                },
            });
        }
    });
});

function receivePaymentModalRow(itemID) {
    $(".select").select2();
    checkType();

    $.ajax({
        url: "{{route('receivePaymentsDetails')}}" + `?id=${itemID}`,
        success: function(response) {
            if(response.status){
                let d = new Date();
                let strDate = d.getDate() + "/" + (d.getMonth()+1) + "/"+ d.getFullYear() 
                $('#date').val(strDate);
                $('#order_id').val(response.data.order_id);
                $('#invoice_no').val(response.data.invoice_no);
                $('#due_amount').val(response.data.due_amount);
                $('#paid_amount').val(response.data.paid_amount);
            }
        }
    });
}

checkType("<?php if(isset($item->payment_type) && ($item->payment_type === 'cheque' || $item->payment_type === 'online')){ echo $item->payment_type;}else{ echo'';} ?>");
function checkType(getVal = '') {
    if(getVal){
        if (getVal === 'cheque') {
            $("#chequeNoTag").css("display", "block");
            $("#cheque_no").rules("add", { required: true});
            
            $("#chequeDateTag").css("display", "block"); 
            $("#cheque_date").rules("add", { required: true});
            
            $("#transactionNoTag").css("display", "none");
            $("#transaction_no").rules("remove");

        }else if(getVal === 'online'){
            $("#transactionNoTag").css("display", "block");
            
            $("#transaction_no").rules("add", { required: true});

            $("#chequeNoTag").css("display", "none");
            $("#cheque_no").rules("remove");
            
            $("#chequeDateTag").css("display", "none");
            $("#cheque_date").rules("remove");
        }else {
            $("#chequeNoTag").css("display", "none");
            $("#cheque_no").rules("remove");
            
            $("#chequeDateTag").css("display", "none");
            $("#cheque_date").rules("remove");
            
            $("#transactionNoTag").css("display", "none");
            $("#transaction_no").rules("remove");
        }
    }
}

function resetFilter(){
    $('#searchInput').val('');
    getOrders();
}

// user list get 
function getOrders(page = false,date = '') {
    if (!page) {
        page = 1;
    }

    // filter value get 
    let searchQuery = $('#searchInput').val();
    
    let params = `page=${page}`;

    if(searchQuery != ''){ params = params + `&search=${searchQuery}`; }

    if(date != ''){
        let paramsDate = '';
        let dateSplit = date.split('-');
        if(dateSplit.length > 0){
            paramsDate = `&from=${dateSplit[0]}&to=${dateSplit[1]}`;
        }
        params =  params + paramsDate; 
    }

    // ajax user list get call
    $.ajax({
        url: "{{route('orderList')}}" + `?${params}`,
        success: function(response) {
            // set data
            $('#orderList').html(response);
        }
    }).done(function() {
    });
}

// delete mate confirmtion modal open 
function remove_row(th) {
    $('#modal-delete').modal('show');
    $("#delete_sure").val($(th).data('id'));
}

// one record delete function
$(document.body).on('click', '#delete_sure', function() {
    $('#modal-delete').modal('hide');
    var id = $(this).val();
    $.ajax({
        url: "{{ route('deleteOrder','') }}/" + id,
        type: 'GET',
        dataType: 'Json',
        success: function(res) {
            if (res.status) {
                getOrders();
                toastr.success(res.message);
            } else {
                toastr.error(res.message);
            }
        }
    });
});
</script>
@endpush