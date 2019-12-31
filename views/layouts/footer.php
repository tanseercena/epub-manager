<footer class="footer mt-auto">
            <div class="copyright bg-white">
              <p>
                &copy; <span id="copy-year">2019</span> Copyright Sleek Dashboard Bootstrap Template by
                <a
                  class="text-primary"
                  href="http://www.iamabdus.com/"
                  target="_blank"
                  >Abdus</a
                >.
              </p>
            </div>
            <script>
                var d = new Date();
                var year = d.getFullYear();
                document.getElementById("copy-year").innerHTML = year;
            </script>
          </footer>

    </div>
  </div>

  <script src="../assets/plugins/jquery/jquery.min.js"></script>
<script src="../assets/plugins/slimscrollbar/jquery.slimscroll.min.js"></script>
<script src="../assets/plugins/jekyll-search.min.js"></script>



<script src="../assets/plugins/charts/Chart.min.js"></script>



<script src="../assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
<script src="../assets/plugins/jvectormap/jquery-jvectormap-world-mill.js"></script>



<script src="../assets/plugins/daterangepicker/moment.min.js"></script>
<script src="../assets/plugins/daterangepicker/daterangepicker.js"></script>



<script src="../assets/plugins/toastr/toastr.min.js"></script>



<script src="../assets/js/sleek.bundle.js"></script>


<script>
  toastr.options = {
        closeButton: true,
        debug: false,
        newestOnTop: false,
        progressBar: true,
        positionClass: "toast-top-right",
        preventDuplicates: false,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut"
      };

      <?php
      if (Session::has('errors')) {

        ?>
          toastr.error('<?php echo Session::flash('errors'); ?>', "Error!");
        <?php
      }

      if (Session::has('success')) {

        ?>
          toastr.success('<?php echo Session::flash('success'); ?>', "Success!");
        <?php
      }
    ?>


  </script>

</body>

</html>
