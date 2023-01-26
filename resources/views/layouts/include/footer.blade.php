</div>
</div>

<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/feather.min.js') }}"></script>
<script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- <script src="{{ asset('assets/plugins/fileupload/fileupload.min.js') }}"></script> -->
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!-- <script src="{{ asset('assets/plugins/select2/js/custom-select.js') }}"></script> -->
<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
<!-- <script src="{{ asset('assets/plugins/toastr/toastr.js') }}"></script> -->
<script src="{{asset('assets/plugins/moment/moment.min.js'); }}"></script>
<script src="{{asset('assets/js/bootstrap-datetimepicker.min.js'); }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>

<script src="{{asset('assets/js/validate/jquery.validate.js'); }}" type="text/javascript"></script>
<script src="{{asset('assets/js/validate/additional-methods.min.js'); }}" type="text/javascript"></script>
<script src="{{asset('assets/js/validate/validation.js'); }}" type="text/javascript"></script>

<div class="modal custom-modal fade" id="modal-delete" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Item!</h3>
                    <p>Are you sure to delete this?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <a href="javascript:void(0);" class="btn btn-primary paid-continue-btn"
                                id="delete_sure">Delete</a>
                        </div>
                        <div class="col-6">
                            <a href="javascript:void(0);" data-bs-dismiss="modal"
                                class="btn btn-primary paid-cancel-btn">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="receivePaymentModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true" style="display: none" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Add Payment</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('receivePayments')}}" method="post" id="payDetailsForm">
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="invoice_no" class="form-label">Invoice</label>
                                <select class="form-control select select2 orderSearch" name="order_id" id="select2"
                                    onchange="selectProduct(this.value)">

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="due_amount" class="form-label">Due Amount</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="due_amount" id="due_amount" require
                                        placeholder="00.00" readonly />
                                    <span class="input-group-text"><i class="fa fa-rupee-sign"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="paid_amount" class="form-label">Paid Amount</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="paid_amount" id="paid_amount"
                                        placeholder="00.00" readonly />
                                    <span class="input-group-text"><i class="fa fa-rupee-sign"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="date" class="form-label">Payment Date</label>
                                <input type="text" class="form-control datetimepicker" require name="date" id="date" value=""/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="amount" id="amount" require
                                        placeholder="00.00" aria-label="amount" aria-describedby="amount" />
                                    <span class="input-group-text"><i class="fa fa-rupee-sign"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="payment_type" class="form-label">Payment Mode</label>
                                <select class="form-control select select2" name="payment_type" id="payment_type"
                                    onchange="checkType(this.value)">
                                    <option value="cash">Cash</option>
                                    <option value="cheque">Cheque</option>
                                    <option value="online">Online</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6" id="chequeNoTag" style="display:none">
                            <div class="mb-3">
                                <label for="cheque_no" class="form-label">Cheque No</label>
                                <input type="text" name="cheque_no" id="cheque_no" class="form-control" placeholder="0"
                                    value="">
                            </div>
                        </div>
                        <div class="col-md-6" id="chequeDateTag" style="display:none">
                            <div class="mb-3">
                                <label for="cheque_date" class="form-label">Cheque Date</label>
                                <input type="text" name="cheque_date" id="cheque_date"
                                    class="form-control datetimepicker" placeholder="0" value="">
                            </div>
                        </div>
                        <div class="col-md-6" id="transactionNoTag" style="display:none">
                            <div class="mb-3">
                                <label for="transaction_no" class="form-label">Transaction No</label>
                                <input type="text" name="transaction_no" id="transaction_no" class="form-control"
                                    placeholder="0" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="">
                                <label for="note" class="form-label">Note</label>
                                <textarea class="form-control" id="note" name="note" require rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <span class="spinner-border spinner-border-sm me-2" role="status"></span> -->
                    <button class="btn btn-primary waves-effect waves-light" type="submit">Pay</button>
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $('.select2').select2({});
    $(document).on('select2:open', () => {
        document.querySelector('.select2-search__field').focus();
    });

    $('.datetimepicker').datetimepicker({
        format: 'DD-MM-YYYY'
    });

    $("#select2").select2({
        dropdownParent: "#receivePaymentModal",
        ajax: {
            url: "{{route('searchOrders')}}",
            type: "get",
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    search: params.term // search term
                };
            },
            processResults: function(response) {
                return {
                    results: response
                };
            },
            cache: true
        }
    });

    $('#payDetailsForm').validate({
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.form-control').removeClass('has-success').addClass('has-error');     
        },
        errorPlacement: function (error, element) {
            if(element.hasClass('select2') && element.next('.select2-container').length) {
                error.insertAfter(element.next('.select2-container'));
            } else {
                error.insertAfter(element.parent());
            }
        },
        rules: {
            order_id: {
                required: true
            },
            due_amount: {
                required: true
            },
            date: {
                required: true
            },
            amount: {
                required: true,
                number: true
            },
            note: {
                required: true
            }
        },
        messages: {
            order_id: {
                required: "This field is required."
            },
            due_amount: {
                required: "This field is required."
            },
            date: {
                required: "This field is required."
            },
            amount: {
                required: "This field is required.",
                number: "Please enter a valid amount."
            },
            note: {
                required: "This field is required."
            }
        },
        submitHandler: function(form) {
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response) {
                    if(response.status){
                        $('#receivePaymentModal').modal('toggle');
                        toastr.success(response.msg);
                        
                        $('#payDetailsForm').each(function(){
                            this.reset();
                        });
                    }else{
                        toastr.error(response.msg);
                    }
                },
            });
        }
    });
});

function selectProduct(id) {
    // ajax product price get call
    $.ajax({
        url: "{{route('receivePaymentsDetails')}}" + `?id=${id}`,
        success: function(response) {
            if(response.status){
                let d = new Date();
                let strDate = d.getDate() + "/" + (d.getMonth()+1) + "/"+ d.getFullYear() 
                $('#date').val(strDate);
                // $('#order_id').val(response.data.order_id);
                $('#invoice_no').val(response.data.invoice_no);
                $('#due_amount').val(response.data.due_amount);
                $('#paid_amount').val(response.data.paid_amount);
            }
        }
    });
}

checkType();

function checkType(getVal = '') {
    if (getVal) {
        if (getVal === 'cheque') {
            $("#chequeNoTag").css("display", "block");
            /* $("#cheque_no").rules("add", {
                required: true
            }); */

            $("#chequeDateTag").css("display", "block");
            /* $("#cheque_date").rules("add", {
                required: true
            }); */

            $("#transactionNoTag").css("display", "none");
            // $("#transaction_no").rules("remove");

        } else if (getVal === 'online') {
            $("#transactionNoTag").css("display", "block");

            /* $("#transaction_no").rules("add", {
                required: true
            }); */

            $("#chequeNoTag").css("display", "none");
            // $("#cheque_no").rules("remove");

            $("#chequeDateTag").css("display", "none");
            // $("#cheque_date").rules("remove");
        } else {
            $("#chequeNoTag").css("display", "none");
            // $("#cheque_no").rules("remove");

            $("#chequeDateTag").css("display", "none");
            // $("#cheque_date").rules("remove");

            $("#transactionNoTag").css("display", "none");
            // $("#transaction_no").rules("remove");
        }
    }
}

function ReceivePayment() {
    $('#receivePaymentModal').modal('show');
    $('#infoModal').on('shown.bs.modal', function(e) {
        $('.bootstrap-datetimepicker-widget').css('z-index', 1500);
    });
}
</script>

@stack('scripts')

@if(Session::has('success'))
<script>
toastr.success("{{ Session::get('success') }}")
</script>
@elseif(Session::has('error'))
<script>
toastr.error("{{ Session::get('error') }}")
</script>
@endif
</body>

</html>