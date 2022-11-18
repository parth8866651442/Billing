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
                        <a href="{{route('orderList')}}"><button class="btn primary-btn">Back</button></a>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- ========== title-wrapper end ========== -->

        <!-- Invoice Wrapper Start -->
        <div class="invoice-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="invoice-card card-style mb-30">
                        <div class="invoice-header">
                            <div class="invoice-for">
                                <h2 class="mb-10">Invoice</h2>
                                <p class="text-sm">
                                    Admin Dashboard Design & Development
                                </p>
                            </div>
                            <div class="invoice-logo">
                                <img src="{{asset('uploads/user/1668584911_Untitled-2.png')}}" alt="" />
                            </div>
                            <div class="invoice-date">
                                <p><span>Date Issued:</span> 20/02/2024</p>
                                <p><span>Date Due:</span> 20/02/2028</p>
                                <p><span>Order ID:</span> #5467</p>
                            </div>
                        </div>
                        <div class="invoice-address">
                            <div class="address-item">
                                <h5 class="text-bold">From</h5>
                                <h1>John Doe</h1>
                                <p class="text-sm">
                                    3891 Ranchview Dr. Richardson, California 62639
                                </p>
                                <p class="text-sm">
                                    <span class="text-medium">Email:</span>
                                    admin@example.com
                                </p>
                            </div>
                            <div class="address-item">
                                <h5 class="text-bold">To</h5>
                                <h1>Santa Gosh</h1>
                                <p class="text-sm">
                                    2972 Westheimer Rd. Santa Ana, Illinois 85486
                                </p>
                                <p class="text-sm">
                                    <span class="text-medium">Email:</span>
                                    admin@example.com
                                </p>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="invoice-table table">
                                <thead>
                                    <tr>
                                        <th class="service">
                                            <h6 class="text-sm text-medium">Service</h6>
                                        </th>
                                        <th class="desc">
                                            <h6 class="text-sm text-medium">Descriptions</h6>
                                        </th>
                                        <th class="qty">
                                            <h6 class="text-sm text-medium">Qty</h6>
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
                                            <p class="text-sm">
                                                Design and Development Service
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-sm">3</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">$700</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="text-sm">Landing Page</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">
                                                Landing Page Ui kit design and Development
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-sm">1</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">$1000</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="text-sm">Web design</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">
                                                Web Design and Development and Seo
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-sm">2</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">$4000</p>
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
                        <div class="note-wrapper warning-alert py-4 px-sm-3 px-lg-5">
                            <div class="alert">
                                <h5 class="text-bold mb-15">Notes:</h5>
                                <p class="text-sm text-gray">
                                    All accounts are to be paid within 7 days from receipt
                                    of invoice. To be paid by cheque or credit card or
                                    direct payment online. If account is not paid within 7
                                    days the credits details supplied as confirmation of
                                    work undertaken will be charged the agreed quoted fee
                                    noted above.
                                </p>
                            </div>
                        </div>
                        <div class="invoice-action">
                            <ul class="d-flex flex-wrap align-items-center justify-content-center">
                                <li class="m-2">
                                    <a href="#0" class="main-btn primary-btn-outline btn-hover">
                                        Download Invoice
                                    </a>
                                </li>
                                <li class="m-2">
                                    <a href="#0" class="main-btn primary-btn btn-hover">
                                        Send Invoice
                                    </a>
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