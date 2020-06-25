<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
  <div class="container">
  	<a class="navbar-brand" href="<?= base_url('auth'); ?>">
  		<img src="<?= base_url('assets/img/img_properties/icon.png'); ?>" width="75" alt="logo">
  	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
		<div class="navbar-nav">
			<a class="nav-item nav-link text-white btn btn-primary rounded-pill px-3 mx-2 my-1 page-scroll" href="#home"><i class="fas fa-fw fa-home"></i> Beranda</a>
		  	<a class="nav-item nav-link text-white btn btn-primary rounded-pill px-3 mx-2 my-1 page-scroll" href="#tentang"><i class="fas fa-fw fa-book"></i> Tentang Kami</a>
		  	<a class="nav-item nav-link text-white btn btn-primary rounded-pill px-3 mx-2 my-1 page-scroll" href="#tracking"><i class="fas fa-fw fa-align-right"></i> Cek Tracking</a>
		</div>
	    <div class="navbar-nav ml-auto">
	      	<a class="nav-item nav-link text-white btn btn-danger rounded-pill px-3 mx-2 my-1 page-scroll" href="<?= base_url('pickupBarang/form') ?>"><i class="fas fa-fw fa-shipping-fast"></i><sup><i class="fas fa-1x fa-plus"></i></sup> Buat Pesanan</a>
	      	<a class="nav-item nav-link text-white btn btn-success rounded-pill px-3 mx-2 my-1" href="https://www.jne.co.id/id/tracking/trace" target="_blank"><i class="fas fa-fw fa-check"></i> Cek No. Resi</a>
	    </div>
	</div>
  </div>
</nav>

<!-- divider-nav -->
<div class="container"><div class="row my-2"><div class="col my-3"></div></div></div>
<!-- divider-nav -->

<section id="carousel" class="carousel bg-blue">
	<div class="container">
		<div class="row pt-5">
			<div class="col-lg owl-carousel">
		    	<img src="<?= base_url('assets/img/img_properties/img_carousel/1.jpg'); ?>" class="d-block w-100 rounded img-carousel" alt="img-carousel">
		      	<img src="<?= base_url('assets/img/img_properties/img_carousel/2.jpg'); ?>" class="d-block w-100 rounded img-carousel" alt="img-carousel">
		      	<img src="<?= base_url('assets/img/img_properties/img_carousel/3.jpg'); ?>" class="d-block w-100 rounded img-carousel" alt="img-carousel">
			</div>
		</div>
		<div class="row py-2">
			<div class="col-lg text-white text-center">
		      	<h2>JNE Tangsel BSD Nusaloka</h2>
		      	<hr>
			</div>
		</div>
	</div>
</section>

<div id="tentang-50" class="bg-danger pb-5"></div>

<section id="tentang" class="tentang bg-danger text-white">
	<div class="container">
		<div class="row py-5">
			<div class="col-lg text-center px-5">
				<h2>Tentang Kami</h2>
				<hr class="bg-blue">
				<p>
					JNE merupakan perusahaan yang bergerak dalam bidang pengiriman dan logistik yang bermarkas di Jakarta, Indonesia. Nama resminya adalah Tiki Jalur Nugraha Ekakurir (Tiki JNE).
				</p>
				<p>
					JNE Tangsel BSD Nusaloka merupakan salah satu cabang JNE untuk memperluas jangkauan para pelanggan yang ingin mengirimkan barangnya kepada kerabat, teman, pembeli dan lain-lain. Pada JNE ini kami memiliki fitur <i>special</i> yaitu, dapat memesan kurir untuk menjemput barangnya supaya tidak repot-repot datang ke cabang terdekat. Caranya cukup mudah yaitu, tekan tombol Buat Pesanan pada bagian navbar.
				</p>
			</div>
		</div>
	</div>
</section>
<div class="bg-danger pt-5"></div>

<section id="tracking" class="cek_status_pesanan bg-blue py-5">
	<div class="container pb-4">
		<div class="row pt-5">
			<div class="col-lg-12 text-center">
				<h2 class="text-white">Cek Tracking</h2>
				<hr>
				<form action="<?= base_url('auth/cek_status_pesanan#cek_status_pesanan'); ?>" method="post">
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label for="no_wa_pengirim">No. WhatsApp Pengirim</label>
								<input style="font-size: 25px; text-align: center;" type="text" name="no_wa_pengirim" class="form-control" required value="<?= set_value('no_wa_pengirim'); ?>">
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-search"></i> Lacak</button>
				</form>
				<br>
			</div>
		</div>
		<?php if (isset($error)): ?>
			<div class="row">
				<div class="col-lg text-center">
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<h4>No. WhatsApp tidak ditemukan!</h4>
						<p>Silahkan periksa kembali No. WhatsApp Anda</p>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				</div>
			</div>
		<?php endif ?>
	</div>
</section>
