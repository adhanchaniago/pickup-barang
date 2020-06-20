<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
  <div class="container">
  	<a class="navbar-brand" href="<?= base_url('auth'); ?>">
  		<img src="<?= base_url('assets/img/img_properties/icon.png'); ?>" width="75" alt="logo">
  	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
		<div class="navbar-nav">
			<a class="nav-item nav-link text-white btn btn-primary rounded-pill px-3 mx-2 my-1 page-scroll" href="<?= base_url('auth/index'); ?>#home"><i class="fas fa-fw fa-home"></i> Beranda</a>
		  	<a class="nav-item nav-link text-white btn btn-primary rounded-pill px-3 mx-2 my-1 page-scroll" href="<?= base_url('auth/index'); ?>#tentang-50"><i class="fas fa-fw fa-book"></i> Tentang Kami</a>
		</div>
	    <div class="navbar-nav ml-auto">
	      	<a class="nav-item nav-link text-white btn btn-danger rounded-pill px-3 mx-2 my-1 page-scroll" href="<?= base_url('pickupBarang/form') ?>"><i class="fas fa-fw fa-shipping-fast"></i><sup><i class="fas fa-1x fa-plus"></i></sup> Buat Pesanan</a>
	      	<a class="nav-item nav-link text-white btn btn-success rounded-pill px-3 mx-2 my-1" href="https://www.jne.co.id/id/tracking/trace" target="_blank"><i class="fas fa-fw fa-check"></i> Cek No. Resi</a>
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
					<input type="text" class="form-control" name="nama_pengirim" placeholder="Nama Pengirim" required="required" value="<?= $pengirim["nama_pengirim"]; ?>">
				</td>
			</tr>
			<tr>
				<td>No Whatsapp Pengirim</td>
				<td>
					<input type="text" class="form-control" name="no_wa_pengirim" placeholder="No Whatsapp Pengirim" required="required" value="<?= $pengirim["no_wa_pengirim"]; ?>">
				</td>
			</tr>
			<tr>
				<td>Alamat Pengirim</td>
				<td>
					<div class="form-group">
						<input type="text" class="form-control" name="alamat_pengirim" placeholder="Alamat Pengirim" required="required" value="<?= $pengirim["alamat_pengirim"]; ?>">
					</div>
				</td>
			</tr>
		</table>
	</div>
	
	<div class="boxPenerima">
		<div class="mt-2 border penerima d-none pt-2" id="penerima0">
			<h6 class="m-2 d-inline">Penerima</h6>
			<a href="#" class="close hapusPenerima float-right"><i class="fas fa-fw fa-sm fa-times fa-sm"></i></a>
			<table class="table">
				<tr>
					<td width="30%">Nama Penerima</td>
					<td>
						<input type="text" name="nama_penerima[]" class="form-control" placeholder="Nama Penerima" required="required">
					</td>
				</tr>
				<tr>
					<td>No Whatsapp Penerima</td>
					<td>
						<input type="text" name="no_wa_penerima[]" class="form-control" placeholder="No Whatsapp Penerima" required="required">
					</td>
				</tr>
				<tr>
					<td>Alamat Penerima</td>
					<td>
						<div class="form-group">
							<input type="text" name="alamat_penerima[]" class="form-control" placeholder="Alamat Penerima" required="required">
						</div>
					</td>
				</tr>
				<tr>
					<td>Layanan</td>
					<td>
						<select name="jenis_layanan[]" class="form-control  jenis_layanan" >
							<option value="">-- Pilih --</option>
							<?php foreach ($jenis_layanan as $key): ?>
								<option value="<?= $key["id_jenis_layanan"]; ?>"><?= $key["jenis_layanan"]; ?></option>
							<?php endforeach ?>
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

