@extends('layouts.app')

@section('content')
@push('style')
<style>
.form-lable {
    margin-bottom: 8px;
    font-weight: 400;
    color: #1e2022;
}

.form-value {
    display: block;
    padding: 2px 10px;
    font-size: .875rem;
}
</style>
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
                        <a href="#">Clients</a>
                    </li>
                    <li class="breadcrumb-item active">View Client</li>
                </ul>

                <div class="btn-back">
                    <a href="{{route('clientList')}}"><button class="btn btn-primary btn-sm" type="button"><i
                                class="fas fa-chevron-left"></i> Back</button></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" id="headingNine">
                    <h5 class="accordion-faq m-0 position-relative">
                        <a class="custom-accordion-title text-reset d-block" data-bs-toggle="collapse"
                            href="#collapseNine" aria-expanded="true" aria-controls="collapseNine">
                            View Clients
                            <i class="fas fa-chevron-down accordion-arrow"></i>
                        </a>
                    </h5>
                </div>
                <div id="collapseNine" class="collapse show" aria-labelledby="headingFour"
                    data-bs-parent="#custom-accordion-one">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-lable">
                                    <span>Name</span>
                                    <span class="form-value">{{$item->name}}</span>
                                </div>
                                <div class="form-lable">
                                    <span>Phone No</span>
                                    <span class="form-value">{{$item->phone_no}}</span>
                                </div>
                                <div class="form-lable">
                                    <span>Email</span>
                                    <span class="form-value">{{$item->email}}</span>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-lable">
                                            <span>Address</span>
                                            <span class="form-value">{{$item->address}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-lable">
                                            <span>City</span>
                                            <span class="form-value">{{$item->city}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-lable">
                                            <span>PAN Card No</span>
                                            <span class="form-value">{{$item->pan_card_no}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-lable">
                                            <span>Aadhaar Card No</span>
                                            <span class="form-value">{{$item->aadhaar_card_no}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-bordered">
                        <li class="nav-item">
                            <a href="#invoices" onclick="invoiceViewTabRemove()" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">Invoices</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="invoices">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-4">
                                        <div class="col-sm-6 col-md-2">
                                            <input type="text" class="form-control form-control-sm" name="daterange"
                                                id="daterangeInput" value="" />
                                        </div>
                                        <div class="col-sm-6 col-md-2">
                                            <input type="text" placeholder="Fullname,Invoiceno"
                                                class="form-control form-control-sm" id="searchInput" />
                                        </div>
                                        <div class="col-sm-2 col-md-2">
                                            <button onclick="getOrders(false,$('#daterangeInput').val())"
                                                class="btn btn-primary btn-sm"><i class="fas fa-search"></i>
                                                Filter</button>
                                            <button onclick="resetFilter()" class="btn btn-primary btn-sm"><i
                                                    class="fas fa-redo"></i> Reset</button>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <h6>Invoice No</h6>
                                                    </th>
                                                    <th>
                                                        <h6>Full Name</h6>
                                                    </th>
                                                    <th>
                                                        <h6>Invoice Type</h6>
                                                    </th>
                                                    <th>
                                                        <h6>Order Date</h6>
                                                    </th>
                                                    <th>
                                                        <h6>Action</h6>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="orderList"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script>
// user list default page 1 recode get
$(function() {
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
});

function resetFilter(){
    $('#searchInput').val('');
    getOrders();
}

function getOrders(page = false, date = '') {
    if (!page) {
        page = 1;
    }

    let id = <?php echo $item->id ?>;

    // filter value get 
    let searchQuery = $('#searchInput').val();

    let params = `page=${page}`;

    if (searchQuery != '') {
        params = params + `&search=${searchQuery}`;
    }

    if (date != '') {
        let paramsDate = '';
        let dateSplit = date.split('-');
        if (dateSplit.length > 0) {
            paramsDate = `&from=${dateSplit[0]}&to=${dateSplit[1]}`;
        }
        params = params + paramsDate;
    }

    // ajax user list get call
    $.ajax({
        url: "{{route('clientOrders','')}}" + `/${id}?${params}`,
        success: function(response) {
            
            let resData = response.data;
            let html = '';
            if(resData.length > 0){
                resData.forEach(function(item) {
                    let date =  moment(item.date).format('DD/MM/YYYY');
                    html += `<tr> <td><a href="javascript:void(0);" onclick="viewInvoice('${item.invoice_no}','${item.id}')">${item.invoice_no}</a></td><td><p>${item.fullname}</p></td><td><p>${item.type}</p></td><td><p>${date}</p></td><td><a href="#" class="btn btn-sm btn-white text-primary me-2"><i class="fas fa-print me-1"></i> Print</a></td></tr>`;
                });
            }else{
                html = `<tr class="text-center"> <td colspan="5">No data available</td> </tr>`
            }
            // set data
            $('#orderList').html(html);
        }
    }).done(function() {});
}
function viewInvoice(invoiceNo,id){
    $("ul.nav-bordered").children().find(".active").removeClass('active');
    $(".tab-content").find(".active").removeClass('active').removeClass('show');

    $('.nav-bordered').append(`<li class="nav-item invoiceView"> <a href="#${invoiceNo}" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">${invoiceNo}</a> </li>`);

    $.ajax({
        url: "{{route('invoiceView','')}}" + `/${id}`,
        success: function(response) {
            $('.tab-content').append(`<div class="tab-pane show active invoiceView" id="${invoiceNo}"><div class="card"><div class="card-body"> ${response} </div> </div> </div>`);
        }
    });
}
function invoiceViewTabRemove(){
    $(".invoiceView").remove()
}
</script>
@endpush