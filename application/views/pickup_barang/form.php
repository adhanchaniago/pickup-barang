<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
  	<a class="navbar-brand" href="<?= base_url('auth'); ?>">
  		<img src="<?= base_url('assets/img/img_properties/icon.png'); ?>" width="75" alt="logo">
  	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
	    <div class="navbar-nav">
	    	<a class="nav-item nav-link text-white btn btn-primary rounded-pill px-3 mx-2 my-1 page-scroll" href="<?= base_url('auth') ?>"><i class="fas fa-fw fa-home"></i> Beranda</a>
	    </div>
	</div>
  </div>
</nav>

<form class="container bg-white my-3 shadow-sm py-2" action="" method="post">
	<h5>Formulir Pickup Barang</h5>
	<div class="mt-2 border">
		<h6 class="m-2">Pengirim</h6>
		<table class="table">
			<tr>
				<td width="30%">Nama Pengirim</td>
				<td>
					<input type="text" class="form-control" name="nama_pengirim" placeholder="Nama Pengirim" required="required">
				</td>
			</tr>
			<tr>
				<td>No Whatsapp Pengirim</td>
				<td>
					<input type="number" class="form-control" name="no_wa_pengirim" placeholder="No Whatsapp Pengirim" required="required">
				</td>
			</tr>
			<tr>
				<td>Alamat Pengirim</td>
				<td>
					<div class="form-group">
						<input type="text" class="form-control" name="alamat_pengirim" placeholder="Alamat Pengirim" required="required">
					</div>
					<div class="form-group">
						<label for="">Provinsi</label>
						<select name="provinsi_pengirim" id="provinsi_pengirim" class="form-control js-basic-single">
							<option value="">-- Pilih --</option>
							<?php foreach ($provinsi as $key): ?>
								<option value="<?= $key["id_provinsi"]; ?>"><?= $key["nama_provinsi"]; ?></option>
							<?php endforeach ?>
						</select>
					</div>
						<label for="">Kabupaten/Kota</label>
						<select name="kabupaten_pengirim" id="kabupaten_pengirim" class="form-control js-basic-single"><option value=""></option></select>
					</div>
					<div class="form-group">
						<label for="">Kecamatan</label>
						<select name="kecamatan_pengirim" id="kecamatan_pengirim" class="form-control js-basic-single"><option value=""></option></select>
					</div>
				</td>
			</tr>
		</table>
	</div>
	
	<div class="boxPenerima">
		<div class="mt-2 border penerima d-none pt-2">
			<h6 class="m-2 d-inline">Penerima</h6>
			<a href="#" class="close hapusPenerima float-right"><i class="fas fa-fw fa-sm fa-times fa-sm"></i></a>
			<table class="table">
				<tr>
					<td width="30%">Nama Penerima</td>
					<td>
						<input type="text" name="nama_penerima[]" class="form-control" placeholder="Nama Penerima">
					</td>
				</tr>
				<tr>
					<td>No Whatsapp Penerima</td>
					<td>
						<input type="number"name="no_wa_penerima[]" class="form-control" placeholder="No Whatsapp Penerima">
					</td>
				</tr>
				<tr>
					<td>Alamat Penerima</td>
					<td>
						<div class="form-group">
							<input type="text" name="alamat_penerima[]" class="form-control" placeholder="Alamat Penerima">
						</div>
						<div class="form-group">
							<label for="">Provinsi</label>
							<select name="provinsi_penerima[]" class="form-control js-basic-single provinsi_penerima">
								<option value="">-- Pilih --</option>
								<?php foreach ($provinsi as $key): ?>
									<option value="<?= $key["id_provinsi"]; ?>"><?= $key["nama_provinsi"]; ?></option>
								<?php endforeach ?>
							</select>
						</div>
						<div class="form-group">
							<label for="">Kabupaten/Kota</label>
							<select name="kabupaten_penerima[]" class="form-control js-basic-single kabupaten_penerima"><option value=""></option></select>
						</div>
						<div class="form-group">
							<label for="">Kecamatan</label>
							<select name="kecamatan_penerima[]" class="form-control js-basic-single kecamatan_penerima"><option value=""></option></select>
						</div>
					</td>
				</tr>
				<tr>
					<td>Nama Barang</td>
					<td>
						<input type="text" name="nama_barang[]" class="form-control" placeholder="Nama Barang">
					</td>
				</tr>
				<tr>
					<td>Jumlah Barang</td>
					<td>
						<input type="number" name="jumlah_barang[]" class="form-control" placeholder="Jumlah Barang">
					</td>
				</tr>
				<tr>
					<td>Berat Barang (Kg)</td>
					<td>
						<input type="number" name="berat_barang[]" class="form-control berat_barang" placeholder="Berat Barang">
					</td>
				</tr>
				<tr>
					<td>Layanan</td>
					<td>
						<select name="jenis_layanan[]" class="form-control js-basic-single jenis_layanan">
							<option value="">-- Pilih --</option>
						</select>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<a class="btn btn-success btn-sm mt-2 tambahPenerima" href="#"><i class="fas fa-fw fa-plus "></i> Tambah Penerima</a>

	<div class="text-right mt-3 button">
		<a class="btn btn-secondary btn-sm" href="#" onclick="history.go(-1)"><i class="fas fa-fw fa-arrow-left "></i> Kembali</a>
		<button class="btn btn-primary btn-sm" type="submit" name="submit" value="1"><i class="fas fa-fw fa-paper-plane "></i> Simpan</button>
	</div>
</form>


<footer class="bg-dark text-white p-4">
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-lg-6 my-3">
		        <h4 class="mb-3 font-weight-bold">Kontak Kami</h4>
		        <div class="row text-left my-2">
		          <div class="col-lg-4"><i class="fab fa-fw fa-whatsapp"></i> Hub. WhatsApp</div>
		          <div class="col-lg-5"><a class="text-white" target="_blank" href="https://api.whatsapp.com/send?phone=+6287808675313">+62 878 0867 5313</a></div>
		        </div>
		        <div class="row my-2 ml-0">
		          <div class="col-xs-1 mr-2"><a class="text-white" target="_blank" href="https://twitter.com"><i class="fab fa-fw fa-twitter"></i></a></div>
		          <div class="col-xs-1 mx-2"><a class="text-white" target="_blank" href="https://facebook.com"><i class="fab fa-fw fa-facebook"></i></a></div>
		          <div class="col-xs-1 mx-2"><a class="text-white" target="_blank" href="https://instagram.com"><i class="fab fa-fw fa-instagram"></i></a></div>
		          <div class="col-xs-1 mx-2"><a class="text-white" target="_blank" href="https://linkedin.com"><i class="fab fa-fw fa-linkedin-in"></i></a></div>
		          <div class="col-xs-1 mx-2"><a class="text-white" target="_blank" href="https://pinterest.com"><i class="fab fa-fw fa-pinterest"></i></a></div>
		          <div class="col-xs-1 mx-2"><a class="text-white" target="_blank" href="https://gmail.com"><i class="far fa-fw fa-envelope"></i></a></div>
		        </div>    
		        <div class="row text-left my-2">
		          <div class="col-lg-4">
		            <i class="fas fa-fw fa-map-marker-alt"></i> Alamat 
		          </div>
		          <div class="col-lg-8">Jl. Kalimantan, Rw. Mekar Jaya, Kec. Serpong, Kota Tangerang Selatan, Banten 15310</div>
		        </div>
      		</div>
      		<div class="col-lg-6 my-3">
		    	<h3 class="oleo-font">JNE Tangsel BSD Nusaloka</h3>
		    	<div class="row mt-2">
		    		<div class="col-lg">
						<span>&copy; Copyright <?= date('Y'); ?> All rights Reserved By Andri Firman Saputra.</span>
		    		</div>
		    	</div>
			</div>
		</div>
	</div>
</footer>