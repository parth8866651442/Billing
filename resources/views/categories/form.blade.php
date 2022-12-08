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
                                    Categories Form
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-md-6 col-sm-6 col-6">
                    <div class="title mb-30">
                        <a href="{{route('userList')}}"><button class="btn primary-btn">Back</button></a>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- ========== title-wrapper end ========== -->

        <!-- ========== form-layout-wrapper start ========== -->
        <div class="form-layout-wrapper">
            <div class="card-style mb-30">
                <h6 class="mb-25">Category</h6>
                @if(isset($item))
                <form method="POST"
                    action="{{(isset($item)) ? route('updateCategory',['id'=>$item->id]) : route('storeCategory')}}"
                    id="categoryForm" enctype="multipart/form-data">
                    <div class="row">
                        @csrf
                        <input type="hidden" name="id" value="@isset($item->id){{$item->id}}@endisset">
                        <!-- sub -->
                        <div class="col-md-6 col-sm-12 col-12">
                            <div class="input-style-1">
                                <label for="name">Name<span class="asterisk">*</span></label>
                                <input type="text" name="name" id="name" class="bg-transparent" placeholder="Name"
                                    value="@isset($item->name){{$item->name}}@endisset">
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="main-btn primary-btn btn-hover" type="submit">Save</button>
                            <a href="{{route('categoryList')}}"><button type="button"
                                    class="main-btn secondary-btn btn-hover">Cancel</button></a>
                        </div>
                    </div>
                    <!-- end row -->
                </form>
            </div>
            <!-- end card -->
        </div>
        <!-- ========== form-layout-wrapper end ========== -->
    </div>
    <!-- end container -->
</section>
@endsection

@push('scripts')
<script src="{{asset('assets/js/validate/jquery.validate.js'); }}" type="text/javascript"></script>
<script src="{{asset('assets/js/validate/additional-methods.min.js'); }}" type="text/javascript"></script>
<script src="{{asset('assets/js/validate/validation.js'); }}" type="text/javascript"></script>
<script>
$(document).ready(function() {
    var addCategoryForm = $("#categoryForm");
    //alert('hi');
    var validator = addCategoryForm.validate({
        rules: {
            name: {
                required: true,
                remote: {
                    url: "{{route('checkCategoryNameRepeat')}}",
                    type: "post",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        action: '{{isset($item->id) ? "edit" :"add"}}',
                        id: '{{isset($item->id) ? $item->id :""}}'
                    }
                }
            }
        },
        messages: {
            name: {
                required: "This field is required",
                remote: "Name already taken"
            }
        }
    });
});
</script>
@endpush