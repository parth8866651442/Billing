@extends('layouts.app')

@section('content')
<!-- ========== section start ========== -->
<section class="section">
    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6 col-sm-6 col-6">
                    <div class="breadcrumb-wrapper mb-30">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                <a href="{{route('home')}}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                Categories List
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-md-6 col-sm-6 col-6">
                    <div class="title mb-30">
                        <a href="{{route('home')}}"><button class="btn primary-btn">Back</button></a> 
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- ========== title-wrapper end ========== -->
        <!-- ========== tables-wrapper start ========== -->
        <div class="tables-wrapper">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-style mb-30">
                  <h6 class="mb-10">Categories List</h6>
                  <div class="d-flex flex-wrap justify-content-between align-items-center py-3">
                    <div class="left">
                      <div class="table-search d-flex">
                        <div class="form-group">
                            <input type="text" placeholder="Search..." id="searchInput" />
                            <button onclick="getCategories()"><i class="lni lni-search-alt"></i></button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="table-wrapper table-responsive"  id="categoryList">
                  </div>
                </div>
                <!-- end card -->
              </div>
              <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- ========== tables-wrapper end ========== -->
    </div>
    <!-- end container -->
</section>
@endsection

@push('scripts')
<script>
// user list default page 1 recode get
$(function() {
    // ajax user list get 
    getCategories();
    
    // qurey param mathi page no get
    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getCategories(page);
    });
});


// user list get 
function getCategories(page = false) {
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
        url: "{{route('categoryList')}}" + `?${params}`,
        success: function(response) {
            // set data
            $('#categoryList').html(response);
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
        url: "{{ route('deleteCategory','') }}/" + id,
        type: 'GET',
        dataType: 'Json',
        success: function(res) {
            if (res.status) {
                getCategories();
                toastr.success(res.message);
            } else {
                toastr.error(res.message);
            }
        }
    });
});
</script>
@endpush