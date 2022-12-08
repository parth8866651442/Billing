@extends('layouts.app')

@section('content')
<style>
    .select-style-1 .select-position select{
        padding: 5px;
    }
    .input-style-1 input, .input-style-1 textarea{
        padding: 5px;
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
                                <li class="breadcrumb-item active" aria-current="page">
                                    Order Form
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-md-6 col-sm-6 col-6">
                    <div class="title mb-30">
                        <a href="{{route('orderList')}}"><button class="btn primary-btn">Back</button></a>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- ========== title-wrapper end ========== -->

        <!-- Invoice Wrapper Start -->
        @if(isset($item))
            <form method="POST" action="{{route('updateOrder',['id'=>$item->id])}}" id="productForm" enctype="multipart/form-data">
        @else
            <form method="POST" action="{{route('storeOrder')}}" id="productForm" enctype="multipart/form-data">
        @endif
        
        @csrf
        <input type="hidden" name="id" value="@isset($item->id){{$item->id}}@endisset">
        
        <div class="invoice-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="invoice-card card-style mb-30">
                        <div class="invoice-header">
                            <div class="invoice-for">
                                <h2 class="mb-10">Invoice</h2>
                                <p class="text-sm">
                                    3891 Ranchview Dr. Richardson,
                                    <br>California 62639
                                </p>
                                <p class="text-sm">
                                    <span class="text-medium">Email:</span>
                                    admin@example.com
                                </p>
                            </div>
                            <div class="invoice-logo">
                                <img src="{{asset('uploads/user/1668584911_Untitled-2.png')}}" alt="" />
                            </div>
                            <div class="invoice-date">
                                <p><span>Order ID:</span> #5467</p>
                                <p><span>Date:</span> 20/02/2024</p>
                            </div>
                        </div>
                        <div class="invoice-address">
                            <div class="address-item">
                                <div class="select-style-1 mb-2">
                                    <div class="select-position">
                                        <select name="client_id" id="client_id">
                                            <option value="">Select Client</option>
                                            @foreach($clients as $client)
                                                <option {{isset($item->client_id) &&  $item->client_id === $client->id? 'selected' :''  }} value='{{$client->id}}'> {{ $client->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="input-style-1 mb-2">
                                    <input type="text" name="fullname" id="fullname" class="bg-transparent" placeholder="Full Name" value="{{isset($item->fullname) ? $item->fullname :''  }}">
                                </div>
                            </div>
                            <div class="address-item">
                                <div class="input-style-1 mb-2">
                                    <input type="text" name="moblie_no" id="moblie_no" class="bg-transparent" placeholder="Moblie No" value="{{isset($item->moblie_no) ? $item->moblie_no :''  }}">
                                </div>
                                <div class="input-style-1 mb-2">
                                    <input type="text" name="sip_vehicle_no" id="sip_vehicle_no" class="bg-transparent" placeholder="Sip Vehicle No" value="{{isset($item->sip_vehicle_no) ? $item->sip_vehicle_no :''  }}">
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="invoice-table table">
                                <thead>
                                    <tr>
                                        <th class="service">
                                            <h6 class="text-sm text-medium">Name</h6>
                                        </th>
                                        <th class="qty">
                                            <h6 class="text-sm text-medium">Qty</h6>
                                        </th>
                                        <th class="rate">
                                            <h6 class="text-sm text-medium">Rate</h6>
                                        </th>
                                        <th class="amount">
                                            <h6 class="text-sm text-medium">Amounts</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <p class="text-sm">Admin Dashboard</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">3</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">$233.34</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">$700</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <h6 class="text-sm text-medium">Subtotal</h6>
                                        </td>
                                        <td>
                                            <h6 class="text-sm text-bold">$5700</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <h6 class="text-sm text-medium">Discount</h6>
                                        </td>
                                        <td>
                                            <h6 class="text-sm text-bold">45%</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <h6 class="text-sm text-medium">Shipping Charge</h6>
                                        </td>
                                        <td>
                                            <h6 class="text-sm text-bold">Free</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <h4>Total</h4>
                                        </td>
                                        <td>
                                            <h4>$3135</h4>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="invoice-action">
                            <ul class="d-flex flex-wrap align-items-center justify-content-center">
                                <li class="m-2">
                                    <button class="main-btn primary-btn btn-hover" type="submit">Save</button>
                                    
                                    <a href="{{route('orderList')}}"><button type="button" class="main-btn secondary-btn btn-hover">Cancel</button></a>
                                    <!-- <a href="#0" class="main-btn primary-btn-outline btn-hover">
                                        Download Invoice
                                    </a> -->
                                </li>
                                <li class="m-2">
                                    <!-- <a href="#0" class="main-btn primary-btn btn-hover">
                                        Send Invoice
                                    </a> -->
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
                <!-- ENd Col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- Invoice Wrapper End -->
        </form>
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
    var addOrderForm = $("#orderForm");
    //alert('hi');
    var validator = addOrderForm.validate({
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