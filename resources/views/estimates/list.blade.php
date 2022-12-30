@extends('layouts.app')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Estimat Orders</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('home')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Estimates List</li>
                </ul>
            </div>
            <div class="col-auto">
                @if(Helper::check_user_assess('add',ESTIMATES_MODULE))
                <a href="{{route('addEstimate')}}" class="btn btn-primary me-1"><i class="fas fa-plus"></i></a>
                @endif
                <a class="btn btn-primary filter-btn" href="javascript:void(0);" id="filter_search">
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
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script>
// estimate list default page 1 recode get
$(function() {
    $('input[name="daterange"]').daterangepicker({
        startDate: moment().startOf('month'),
        endDate: moment().endOf('month'),
        locale: { 
            format: 'DD/MM/YYYY'
        }
    });
    // ajax estimate list get 
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

// estimate list get 
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

    // ajax estimate list get call
    $.ajax({
        url: "{{route('estimateList')}}" + `?${params}`,
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
        url: "{{ route('deleteEstimate','') }}/" + id,
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