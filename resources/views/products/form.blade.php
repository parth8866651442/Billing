@extends('layouts.app')

@section('content')
<style>
.holder img {
    max-width: 100px;
    max-height: 100px;
    min-width: 100px;
    min-height: 100px;
}
</style>
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
                                <li class="breadcrumb-item active" aria-current="page">Products Form</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-md-6 col-sm-6 col-6">
                    <div class="title mb-30">
                        <a href="{{route('productList')}}"><button class="btn primary-btn">Back</button></a>
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
                <h6 class="mb-25">Product</h6>
                @if(isset($item))
                <form method="POST" action="{{route('updateProduct',['id'=>$item->id])}}" id="productForm" enctype="multipart/form-data">
                    @else
                    <form method="POST" action="{{route('storeProduct')}}" id="productForm" enctype="multipart/form-data">
                        @endif
                        <div class="row">
                            @csrf
                            <input type="hidden" name="id" value="@isset($item->id){{$item->id}}@endisset">
                            <!-- sub -->
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="select-style-1">
                                    <label>Category<span class="asterisk">*</span></label>
                                    <div class="select-position">
                                    <select name="category_id" id="category_id">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option {{isset($item->category_id) &&  $item->category_id === $category->id? 'selected' :''  }} value='{{$category->id}}'> {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="input-style-1">
                                    <label for="name">Name<span class="asterisk">*</span></label>
                                    <input type="text" name="name" id="name" class="bg-transparent" placeholder="Name" value="@isset($item->name){{$item->name}}@endisset">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="input-style-1">
                                    <label for="price">Price<span class="asterisk">*</span></label>
                                    <input type="text" name="price" id="price" class="bg-transparent" placeholder="Price" value="@isset($item->price){{$item->price}}@endisset">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="input-style-1">
                                    <label for="qty">Quantity<span class="asterisk">*</span></label>
                                    <input type="text" name="qty" id="qty" class="bg-transparent" placeholder="Quantity"
                                        value="@isset($item->qty){{$item->qty}}@endisset">
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="main-btn primary-btn btn-hover" type="submit">Save</button>
                                <a href="{{route('productList')}}"><button type="button" class="main-btn secondary-btn btn-hover">Cancel</button></a>
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
    var addProductForm = $("#productForm");
    //alert('hi');
    var validator = addProductForm.validate({

        rules: {
            category_id: {
                required: true
            },
            name: {
                required: true,
                remote: {
                    url: "{{route('checkProductNameRepeat')}}",
                    type: "post",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        action: '{{isset($item->id) ? "edit" :"add"}}',
                        id:'{{isset($item->id) ? $item->id :""}}'
                    }
                }
            },
            price: {
                required: true,
                number: true
            },
            qty: {
                required: true,
                digits: true
            },
            
        },
        messages: {
            category_id: {
                required: "This field is required"
            },
            name: {
                required: "This field is required",
                remote: "Name already taken"
            },
            price: {
                required: "This field is required",
                number:"Invalid price"
            },
            qty: {
                required: "This field is required",
                digits:"Invalid quantity"
            },
        }
    });
});
</script>
@endpush