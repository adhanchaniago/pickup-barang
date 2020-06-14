    <div class="flashdata" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
    <div class="flashdata-success" data-flashdata="<?= $this->session->flashdata('message-success'); ?>"></div>
    <div class="flashdata-failed" data-flashdata="<?= $this->session->flashdata('message-failed'); ?>"></div>
    
 	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?= base_url('assets/vendor/jquery-3.5.1/jquery-3.5.1.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/popper-1.16.0/popper.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap-4.5.0/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/fontawesome-free-5.13.0/js/all.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/sweetalert2-9.14.2/sweetalert2.all.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/owlCarousel2-2.3.4/js/owl.carousel.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/select2-4.0.13/select2.min.js'); ?>"></script>

    <div id="data-admin" data-link="<?= $def_link; ?>" data-url="<?= base_url() ?>"></div>
    
    <!-- My JS -->
    <script src="<?= base_url('assets/js/admin.js'); ?>"></script>
    <script src="<?= base_url('assets/js/script.js'); ?>"></script>
	
	<!-- Config -->
    <script src="<?= base_url('assets/js/select2-config.js'); ?>"></script>
    <script src="<?= base_url('assets/js/sweetalert2-config.js'); ?>"></script>
	<script src="<?= base_url('assets/js/owlCarousel2-config.js'); ?>"></script>
  </body>
</html>