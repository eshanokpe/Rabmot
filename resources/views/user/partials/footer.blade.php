        <!--start overlay-->

        <div class="overlay toggle-btn-mobile"></div>

        <!--end overlay-->

        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>

        <!--End Back To Top Button-->

        <!--footer -->

        <div class="footer">

            <p class="mb-0">Rabmot © {{ date('Y') }} | Developed By : <a href="" target="_blank">codervent</a>
            </p>
        </div>
    <!-- end footer -->
</div>

<!-- Bootstrap JS -->

<script src="{{ asset('/assets/dashboard/js/bootstrap.bundle.min.js')}}"></script>
<!--plugins-->
<script src="{{ asset('/assets/dashboard/js/jquery.min.js')}}"></script>
<script src="{{ asset('/assets/dashboard/plugins/simplebar/js/simplebar.min.js')}}"></script>
<script src="{{ asset('/assets/dashboard/plugins/metismenu/js/metisMenu.min.js')}}"></script>
<script src="{{ asset('/assets/dashboard/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
<!-- Vector map JavaScript -->
<script src="{{ asset('/assets/dashboard/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
<script src="{{ asset('/assets/dashboard/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{ asset('/assets/dashboard/plugins/vectormap/jquery-jvectormap-in-mill.js')}}"></script>
<script src="{{ asset('/assets/dashboard/plugins/vectormap/jquery-jvectormap-us-aea-en.js')}}"></script>
<script src="{{ asset('/assets/dashboard/plugins/vectormap/jquery-jvectormap-uk-mill-en.js')}}"></script>
<script src="{{ asset('/assets/dashboard/plugins/vectormap/jquery-jvectormap-au-mill.js')}}"></script>
<script src="{{ asset('/assets/dashboard/plugins/apexcharts-bundle/js/apexcharts.min.js')}}"></script>
<script src="{{ asset('/assets/dashboard/js/index2.js')}}"></script>
<!-- App JS -->
<script src="{{ asset('/assets/dashboard/js/app.js')}}"></script>







<!-- Mirrored from codervent.com/syndash/demo/vertical/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 11 Apr 2023 18:46:36 GMT -->
<style>
    /* Increase font size of Toastr */
    #toast-container > .toast {
        font-size: 18px; /* You can change 18px to any size you want */
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "timeOut": "3000",
            "positionClass": "toast-top-right"
        };

        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @endif
        @if(session('error'))
            toastr.error("{{ session('error') }}");
        @endif
        
        @if(session('status'))
            toastr.success("{{ session('status') }}");
        @endif

        @if($errors->any()) 
            @foreach($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    });
</script>