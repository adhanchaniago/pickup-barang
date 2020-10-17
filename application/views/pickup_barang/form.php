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
		  	<a class="nav-item nav-link text-white btn btn-primary rounded-pill px-3 mx-2 my-1 page-scroll" href="<?= base_url('auth/index'); ?>#tracking"><i class="fas fa-fw fa-align-right"></i> Cek Tracking</a>
		</div>
	    <div class="navbar-nav ml-auto">
	      	<a class="nav-item nav-link text-white btn btn-danger rounded-pill px-3 mx-2 my-1 page-scroll" href="<?= base_url('pickupBarang/form') ?>"><i class="fas fa-fw fa-shipping-fast"></i><sup><i class="fas fa-1x fa-plus"></i></sup> Buat Pesanan</a>
	      	<a class="nav-item nav-link text-white btn btn-success rounded-pill px-3 mx-2 my-1" href="https://www.jne.co.id/id/tracking/trace" target="_blank"><i class="fas fa-fw fa-check"></i> Cek No. Resi</a>
	    </div>
	</div>
  </div>
</nav>

<form class="container bg-white my-3 shadow-sm py-2" action="" method="post" enctype="multipart/form-data">
	<h5>Formulir Pickup Barang</h5>
	<div class="mt-2 border">
		<h6 class="m-2">Pengirim</h6>
		<table class="table pengirim">
			<tr>
				<td width="30%">Nama Pengirim</td>
				<td>
					<input type="text" class="form-control required" name="nama_pengirim" placeholder="Nama Pengirim" value="<?= $pengirim["nama_pengirim"]; ?>">
            		<?= form_error('nama_pengirim', '<small class="form-text text-danger">', '</small>'); ?>
				</td>
			</tr>
			<tr>
				<td>No Whatsapp Pengirim</td>
				<td>
					<input type="text" class="form-control required" name="no_wa_pengirim" placeholder="+62" value="<?= $pengirim["no_wa_pengirim"]; ?>">
            		<?= form_error('no_wa_pengirim', '<small class="form-text text-danger">', '</small>'); ?>
				</td>
			</tr>
			<tr>
				<td>Alamat Pengirim</td>
				<td>
					<div class="form-group">
						<input type="text" class="form-control required" name="alamat_pengirim" placeholder="Alamat pengirim sertakan nama kecamatan, kota, provinsi dan kode pos" value="<?= $pengirim["alamat_pengirim"]; ?>">
           		 		<?= form_error('alamat_pengirim', '<small class="form-text text-danger">', '</small>'); ?>
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
						<input type="text" value="<?= set_value('nama_penerima[]'); ?>" name="nama_penerima[]" class="form-control required" placeholder="Nama Penerima">
           		 		<?= form_error('nama_penerima[]', '<small class="form-text text-danger">', '</small>'); ?>
					</td>
				</tr>
				<tr>
					<td>No Whatsapp Penerima</td>
					<td>
						<input type="text" name="no_wa_penerima[]" class="form-control" placeholder="+62">
					</td>
				</tr>
				<tr>
					<td>Alamat Penerima</td>
					<td>
						<div class="form-group">
							<input type="text" value="<?= set_value('alamat_penerima[]'); ?>" name="alamat_penerima[]" class="form-control required" placeholder="Alamat penerima sertakan nama kecamatan, kota, provinsi dan kode pos">
           		 			<?= form_error('alamat_penerima[]', '<small class="form-text text-danger">', '</small>'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<td>Nama Barang</td>
					<td>
						<div class="form-group">
							<input type="text" name="nama_barang[]" class="form-control" placeholder="Masukkan Nama Barang">
						</div>
					</td>
				</tr>
				<tr>
					<td>Jumlah Barang</td>
					<td>
						<div class="form-group">
							<input type="number" min="1" value="<?= set_value('jumlah_barang[]'); ?>" name="jumlah_barang[]" class="form-control required" placeholder="Masukkan Jumlah Barang">
           		 			<?= form_error('jumlah_barang[]', '<small class="form-text text-danger">', '</small>'); ?>
						</div>
					</td>
				</tr>
				<tr>
					<td>Layanan</td>
					<td>
						<select name="jenis_layanan[]" class="form-control required jenis_layanan">
							<option value="">-- Pilih --</option>
							<?php foreach ($jenis_layanan as $key): ?>
								<option value="<?= $key["id_jenis_layanan"]; ?>"><?= $key["jenis_layanan"]; ?></option>
							<?php endforeach ?>
						</select>
       		 			<?= form_error('jenis_layanan[]', '<small class="form-text text-danger">', '</small>'); ?>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<a class="btn btn-success btn-sm mt-2 tambahPenerima" href="#"><i class="fas fa-fw fa-plus "></i> Tambah Penerima</a>

	<div class="upload py-5">
		<div class="form-group">
			<label for="file">Import CSV/Excel</label>
			<div class="input-group">
				<input type="file" class="form-control" name="file" id="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
				<div class="input-group-btn">
					<a class="btn btn-primary" href="<?= base_url('assets/template/Template Input Form Pesanan.xlsx') ?>"><i class="fas fa-fw fa-file-csv"></i> Template</a>
				</div>
			</div>
			<small class="text-danger">Max File Size 1024KB / 1MB</small>
		</div>
	</div>

	<div class="text-right mt-3 button">
		<a class="btn btn-secondary btn-sm" href="#" onclick="history.go(-1)"><i class="fas fa-fw fa-arrow-left "></i> Kembali</a>
		<button class="btn btn-primary btn-sm" type="submit" name="submit" value="1"><i class="fas fa-fw fa-paper-plane "></i> Simpan</button>
	</div>
</form>
