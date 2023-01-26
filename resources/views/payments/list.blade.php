@extends('layouts.app')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Payments</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('home')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Payments List</li>
                </ul>
            </div>
            <div class="col-auto">
                <a class="btn btn-primary filter-btn" href="javascript:void(0);" id="filter_search">
                    <i class="fas fa-filter"></i>
                </a>
            </div>
        </div>
    </div>
    <div id="filter_inputs" class="card filter-card">
        <div class="card-body pb-0">
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <select class="select select2" name="order_id" id="order_id">
                            <option value="">Select Order</option>
                            @foreach($orders as $order)
                            <option value='{{$order->id}}'> {{ $order->invoice_no }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <select class="select select2" name="client_id" id="client_id">
                            <option value="">Select Client</option>
                            @foreach($clients as $client)
                            <option value='{{$client->id}}'> {{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <button onclick="getPayments()" class="btn btn-primary"><i class="fas fa-search"></i> Filter</button>
                    <button onclick="resetFilter()" class="btn btn-primary"><i class="fas fa-redo"></i> Reset</button>     
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive" id="paymentList"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// user list default page 1 recode get
$(function() {
    // ajax user list get 
    getPayments();
    
    // qurey param mathi page no get
    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getPayments(page);
    });
});

function resetFilter(){
    $('#order_id').val('').select2();
    $('#client_id').val('').select2();
    getPayments();
}

// user list get 
function getPayments(page = false) {
    if (!page) {
        page = 1;
    }

    // filter value get 
    let orderID = $('#order_id').val();
    let clientID = $('#client_id').val();

    let params = `page=${page}`;

    if(orderID != ''){
        params = params + `&order_id=${orderID}`;
    }

    if(clientID != ''){
        params = params + `&client_id=${clientID}`;
    }

    // loader show 
    $('.preloader').css('height', 1000);
    $('.preloader').css('background-color', '#4646468c');
    $("#overlay").fadeIn(300);

    // ajax user list get call
    $.ajax({
        url: "{{route('paymentsList')}}" + `?${params}`,
        success: function(response) {
            // set data
            $('#paymentList').html(response);
        }
    }).done(function() {
        setTimeout(function() {
            // loader hide
            $("#overlay").fadeOut(300);
            $('.preloader').css('height', 0);
            $('.preloader').css('background-color', '#f4f6f9');
        }, 500);
    });
}
</script>
@endpush