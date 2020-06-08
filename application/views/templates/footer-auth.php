    <div class="flashdata" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
    <div class="flashdata-success" data-flashdata="<?= $this->session->flashdata('message-success'); ?>"></div>
    <div class="flashdata-failed" data-flashdata="<?= $this->session->flashdata('message-failed'); ?>"></div>
    
 	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?= base_url('assets/vendor/jquery-3.5.1/jquery-3.5.1.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/popper-1.16.0/popper.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap-4.5.0/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/fontawesome-free-5.13.0/js/all.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/sweetalert2-9.14.2/sweetalert2.all.min.js'); ?>"></script>
    
    <!-- My JS -->
    <script src="<?= base_url('assets/js/script.js'); ?>"></script>
	
	<!-- Config -->
	<script src="<?= base_url('assets/js/sweetalert2-config.js'); ?>"></script>
  </body>
</html>