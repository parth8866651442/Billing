@extends('layouts.app')

@section('content')
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
                        <a href="#">Products</a>
                    </li>
                    <li class="breadcrumb-item active">Add Products</li>
                </ul>

                <div class="btn-back">
                    <a href="{{route('productList')}}"><button class="btn btn-primary btn-sm" type="button"><i class="fas fa-chevron-left"></i> Back</button></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Products</h4>
                    <form method="POST"
                        action="{{(isset($item)) ? route('updateProduct',['id'=>$item->id]) : route('storeProduct')}}" id="productForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category<span class="asterisk">*</span></label>
                                    <select class="select select2" name="category_id" id="category_id">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{isset($item->category_id) &&  $item->category_id === $category->id? 'selected' :'' }}> {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Name<span class="asterisk">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="@isset($item->name){{$item->name}}@endisset" />
                                </div>
                                <div class="form-group">
                                    <label>Price<span class="asterisk">*</span></label>
                                    <input type="text" class="form-control" name="price" id="price" placeholder="Price" value="@isset($item->price){{$item->price}}@endisset" />
                                </div>
                                <div class="form-group">
                                    <label>Quantity<span class="asterisk">*</span></label>
                                    <input type="text" name="qty" id="qty" class="form-control" placeholder="Quantity" value="@isset($item->qty){{$item->qty}}@endisset">
                                </div>
                            </div>
                        </div>
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary"> Add Product </button>
                        </div>
                    </form>
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
<script>
$(document).ready(function() {
    var addProductForm = $("#productForm");
    //alert('hi');
    var validator = addProductForm.validate({
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.form-control').removeClass('has-success').addClass('has-error');     
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.form-control').removeClass('has-error').addClass('has-success');
        },
        errorPlacement: function (error, element) {
            if(element.hasClass('select2') && element.next('.select2-container').length) {
                error.insertAfter(element.next('.select2-container'));
            } else {
                error.insertAfter(element);
            }
        },
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
                        id: '{{isset($item->id) ? $item->id :""}}'
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
                number: "Invalid price"
            },
            qty: {
                required: "This field is required",
                digits: "Invalid quantity"
            },
        }
    });
});
</script>
@endpush