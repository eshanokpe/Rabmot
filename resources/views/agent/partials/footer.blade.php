<!--start overlay-->
<div class="overlay toggle-btn-mobile"></div>
<!--end overlay-->
<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
<!--End Back To Top Button-->
<!--footer -->
<div class="footer">
    <p class="mb-0">Rabmot © {{ date('Y') }} | Developed By : <a href="" target="_blank">Rabmot Licensing Agency</a>

</div>
<!-- end footer -->


<!--plugins-->

<script src="{{ asset('/assets/dashboard/js/jquery.min.js')}}"></script>
<script src="{{ asset('/assets/dashboard/plugins/simplebar/js/simplebar.min.js')}}"></script>
<script src="{{ asset('/assets/dashboard/plugins/metismenu/js/metisMenu.min.js')}}"></script>
<script src="{{ asset('/assets/dashboard/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>

<!-- Vector map JavaScript -->

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
