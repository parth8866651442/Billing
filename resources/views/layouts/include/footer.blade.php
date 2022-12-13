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

<div class="warning-modal">
    <div class="modal fade" id="modal-delete" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content card-style warning-card text-center">
                <div class="modal-body">
                    <div class="content mb-30">
                        <h2 class="mb-15"><i class="lni lni-trash-can text-danger"></i> Delete Item!</h2>
                        <p class="text-sm text-medium">Are you sure to delete this?</p>
                    </div>
                    <div class="action d-flex flex-wrap justify-content-center">
                        <button data-bs-dismiss="modal"
                            class="main-btn primary-btn rounded-full btn-hover m-1">Close</button>
                        <button type="button" class="main-btn danger-btn rounded-full btn-hover m-1" id="delete_sure"
                            data-bs-dismiss="modal">Delete</button>
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