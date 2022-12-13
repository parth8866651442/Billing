@extends('layouts.app')

@section('content')
<div class="content container-fluid">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Products</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('home')}}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Products List</li>
                </ul>
            </div>
            <div class="col-auto">
                <a href="{{route('addUser')}}" class="btn btn-primary me-1"><i class="fas fa-plus"></i></a>
                <a class="btn btn-primary filter-btn" href="javascript:void(0);" id="filter_search"> <i class="fas fa-filter"></i></a>
            </div>
        </div>
    </div>
    <div id="filter_inputs" class="card filter-card">
        <div class="card-body pb-0">
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group">
                        <input type="text" placeholder="Search..." class="form-control" id="searchInput" />
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <button onclick="getProducts()" class="btn btn-primary btn-sm"><i class="lni lni-search-alt"></i> Filter</button>    
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive" id="productsList"></div>
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
    getProducts();
    
    // qurey param mathi page no get
    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getProducts(page);
    });
});


// user list get 
function getProducts(page = false) {
    if (!page) {
        page = 1;
    }

    // filter value get 
    let searchQuery = $('#searchInput').val();
    // let statuQuery = $('#statusInput').val();  //&status=${statuQuery}

    var params = `page=${page}&search=${searchQuery}`;

    // loader show 
    $('.preloader').css('height', 1000);
    $('.preloader').css('background-color', '#4646468c');
    $("#overlay").fadeIn(300);

    // ajax user list get call
    $.ajax({
        url: "{{route('productList')}}" + `?${params}`,
        success: function(response) {
            // set data
            $('#productsList').html(response);
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
        url: "{{ route('deleteProduct','') }}/" + id,
        type: 'GET',
        dataType: 'Json',
        success: function(res) {
            if (res.status) {
                getProducts();
                toastr.success(res.message);
            } else {
                toastr.error(res.message);
            }
        }
    });
});
</script>
@endpush