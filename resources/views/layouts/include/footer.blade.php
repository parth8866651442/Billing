    <!-- ========== footer start =========== -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 order-last order-md-first">
                    <div class="copyright text-center text-md-start">
                        <p class="text-sm">
                            Designed and Developed by
                            <a href="https://plainadmin.com" rel="nofollow" target="_blank">
                                PlainAdmin
                            </a>
                        </p>
                    </div>
                </div>
                <!-- end col-->
                <div class="col-md-6">
                    <div class="
                  terms
                  d-flex
                  justify-content-center justify-content-md-end
                ">
                        <a href="#0" class="text-sm">Term & Conditions</a>
                        <a href="#0" class="text-sm ml-15">Privacy & Policy</a>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </footer>
    <!-- ========== footer end =========== -->
    </main>
    <!-- ======== main-wrapper end =========== -->
    <!-- ============ Theme Option Start ============= -->
    <button class="option-btn">
        <i class="lni lni-cog"></i>
    </button>
    <div class="option-overlay"></div>
    <div class="option-box">
        <div class="option-header">
            <div>
                <h5>Theme Customizer</h5>
                <p class="text-gray">Customize and Preview in Real time</p>
            </div>
            <button class="option-btn-close text-gray">
                <i class="lni lni-close"></i>
            </button>
        </div>

        <h6 class="mb-10">Theme</h6>
        <ul class="d-flex flex-wrap align-items-center">
            <li>
                <button class="lightThemeButton active">
                    Light Theme + Sidebar 1
                </button>
            </li>
            <li><button class="darkThemeButton">Dark Theme + Sidebar 1</button></li>
        </ul>
    </div>
    <!-- ============ Theme Option End ============= -->
    <!-- ========= All Javascript files linkup ======== -->
    <script src="{{ asset('assets/js/jquery.min.js'); }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js'); }}"></script>
    <script src="{{ asset('assets/js/main.js'); }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('plugins/toastr/toastr.min.js'); }}"></script>

    <script>
    // Enabling bootstrap tooltips
    const tooltipTriggerList = document.querySelectorAll(
        '[data-bs-toggle="tooltip"]'
    );
    const tooltipList = [...tooltipTriggerList].map(
        (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
    );
    </script>

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
                            <button type="button" class="main-btn danger-btn rounded-full btn-hover m-1"
                                id="delete_sure" data-bs-dismiss="modal">Delete</button>
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