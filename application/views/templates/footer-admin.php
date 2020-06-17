        <!-- /.content-wrapper -->
        <footer class="main-footer my-auto">
            <strong>Copyright &copy; 2020 By Andri Firman Saputra.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
              <b>Version</b> 1.0.0
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <div class="flashdata" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
    <div class="flashdata-success" data-flashdata="<?= $this->session->flashdata('message-success'); ?>"></div>
    <div class="flashdata-failed" data-flashdata="<?= $this->session->flashdata('message-failed'); ?>"></div>

 	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?= base_url('assets/vendor/jquery-3.5.1/jquery-3.5.1.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/popper-1.16.0/popper.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap-4.5.0/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/chartjs-2.9.3/chart.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/datatables-1.10.21/js/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/datatables-1.10.21/js/dataTables.bootstrap4.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/fancybox-3.5.7/jquery.fancybox.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/fontawesome-free-5.13.0/js/all.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/sweetalert2-9.14.2/sweetalert2.all.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/overlayScrollbars-1.11.0/js/jquery.overlayScrollbars.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/adminlte-3.0.5/adminlte.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/select2-4.0.13/select2.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/datetimepicker/jquery.datetimepicker.full.min.js'); ?>"></script>
    
    <div id="data-admin" data-link="<?= $def_link; ?>" data-url="<?= base_url() ?>"></div>
    <!-- My JS -->
    <script src="<?= base_url('assets/js/admin.js'); ?>"></script>
	
	<!-- Config -->
	<script src="<?= base_url('assets/js/fancybox-config.js'); ?>"></script>
	<script src="<?= base_url('assets/js/select2-config.js'); ?>"></script>
    <script src="<?= base_url('assets/js/sweetalert2-config.js'); ?>"></script>
	<script src="<?= base_url('assets/js/datetimepicker-config.js'); ?>"></script>
    <script>
        $(document).ready(function() {
            setInterval(function() { 
                $('#dataPesanan').load(location.href + " #dataPesanan>*", "");
            }, 2000);

            setInterval(function() { 
                $('#dataJmlStatus').load(location.href + " #dataJmlStatus>*", "");
            }, 2000);

            function pesanan() {
                BASE_URL = "<?= base_url(); ?>";
                var pesanan = "pesanan";
                $.ajax({
                    url: BASE_URL + "admin/",
                    type: 'post',
                    data: {
                        data: pesanan
                    },
                    success:function(status) {
                        $('#dataPesanan').load(location.href + " #dataPesanan>*", "");
                    }
                });
            };

            function jmlStatus() {
                BASE_URL = "<?= base_url(); ?>";
                var status = "status";
                $.ajax({
                    url: BASE_URL + "admin/",
                    type: 'post',
                    data: {
                        data: status
                    },
                    success:function(status) {
                        $('#dataJmlStatus').load(location.href + " #dataJmlStatus>*", "");
                    }
                });
            };
        })
    </script>
  </body>
</html>