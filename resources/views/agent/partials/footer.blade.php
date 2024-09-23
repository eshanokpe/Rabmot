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
<!--start switcher-->
<div class="switcher-body">
    <button class="btn btn-primary btn-switcher shadow-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="bx bx-cog bx-spin"></i></button>
    <div class="offcanvas offcanvas-end shadow border-start-0 p-2" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling">
      <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Theme Customizer</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
      </div>
      <div class="offcanvas-body">
        <h6 class="mb-0">Theme Variation</h6>
        <hr>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="lightmode" value="option1" checked>
          <label class="form-check-label" for="lightmode">Light</label>
        </div>
        <hr>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="darkmode" value="option2">

          <label class="form-check-label" for="darkmode">Dark</label>

        </div>

        <hr>

        <div class="form-check form-check-inline">

            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="darksidebar" value="option3">

            <label class="form-check-label" for="darksidebar">Semi Dark</label>

          </div>

          <hr>

         <div class="form-check form-check-inline">

            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="ColorLessIcons" value="option3">

            <label class="form-check-label" for="ColorLessIcons">Color Less Icons</label>

          </div>

      </div>

    </div>

   </div>

   <!--end switcher-->

<!-- JavaScript -->

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

<script src="https://www.carpaddy.com/libraries/js/sharplyscript.js"></script> 
<script>
  setInterval(function () {
      var csrfToken = document.getElementById('csrf-token').value;
      fetch('/refresh-csrf', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json',
              'X-CSRF-Token': csrfToken
          },
      });
  }, 600000); // Refresh every 10 minutes
</script>

</body>





<!-- Mirrored from codervent.com/syndash/demo/vertical/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 11 Apr 2023 18:46:36 GMT -->

</html>



