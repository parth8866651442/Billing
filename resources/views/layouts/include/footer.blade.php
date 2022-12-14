</div>
</div>
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/feather.min.js') }}"></script>
<script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- <script src="{{ asset('assets/plugins/fileupload/fileupload.min.js') }}"></script> -->
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
<!-- <script src="{{ asset('assets/plugins/toastr/toastr.js') }}"></script> -->
<script src="{{asset('assets/plugins/moment/moment.min.js'); }}"></script>
<script src="{{asset('assets/js/bootstrap-datetimepicker.min.js'); }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>

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
                            <a href="javascript:void(0);" class="btn btn-primary paid-continue-btn" id="delete_sure">Delete</a>
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