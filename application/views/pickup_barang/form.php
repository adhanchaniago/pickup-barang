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
<<<<<<< HEAD:application/views/pickup_barang/form.php
						<label>Provinsi</label>
						<select name="provinsi_pengirim" id="provinsi_pengirim" class="form-control">
=======
						<label for="">Provinsi</label>
						<select name="provinsi_pengirim" id="provinsi_pengirim" class="form-control js-basic-single">
>>>>>>> origin/master:application/views/pickup_barang/tambah.php
							<option value="">-- Pilih --</option>
							<?php foreach ($provinsi as $key): ?>
								<option value="<?= $key["id_provinsi"]; ?>"><?= $key["nama_provinsi"]; ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group">
<<<<<<< HEAD:application/views/pickup_barang/form.php
						<label>Kabupaten/Kota</label>
						<select name="kabupaten_pengirim" id="kabupaten_pengirim" class="form-control">
							<option value="">-- Pilih --</option>
						</select>
					</div>
					<div class="form-group">
						<label>Kecamatan</label>
						<select name="kecamatan_pengirim" id="kecamatan_pengirim" class="form-control">
							<option value="">-- Pilih --</option>
						</select>
=======
						<label for="">Kabupaten/Kota</label>
						<select name="kabupaten_pengirim" id="kabupaten_pengirim" class="form-control js-basic-single"></select>
					</div>
					<div class="form-group">
						<label for="">Kecamatan</label>
						<select name="kecamatan_pengirim" id="kecamatan_pengirim" class="form-control js-basic-single"></select>
>>>>>>> origin/master:application/views/pickup_barang/tambah.php
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
<<<<<<< HEAD:application/views/pickup_barang/form.php
							<label>Provinsi</label>
							<select name="provinsi_penerima[]" class="form-control provinsi_penerima">
=======
							<label for="">Provinsi</label>
							<select name="provinsi_penerima[]" class="form-control js-basic-single provinsi_penerima">
>>>>>>> origin/master:application/views/pickup_barang/tambah.php
								<option value="">-- Pilih --</option>
								<?php foreach ($provinsi as $key): ?>
									<option value="<?= $key["id_provinsi"]; ?>"><?= $key["nama_provinsi"]; ?></option>
								<?php endforeach ?>
							</select>
						</div>
						<div class="form-group">
<<<<<<< HEAD:application/views/pickup_barang/form.php
							<label>Kabupaten/Kota</label>
							<select name="kabupaten_penerima[]" class="form-control kabupaten_penerima">
								<option value="">-- Pilih --</option>
							</select>
						</div>
						<div class="form-group">
							<label>Kecamatan</label>
							<select name="kecamatan_penerima[]" class="form-control kecamatan_penerima">
								<option value="">-- Pilih --</option>
							</select>
=======
							<label for="">Kabupaten/Kota</label>
							<select name="kabupaten_penerima[]" class="form-control js-basic-single kabupaten_penerima"></select>
						</div>
						<div class="form-group">
							<label for="">Kecamatan</label>
							<select name="kecamatan_penerima[]" class="form-control js-basic-single kecamatan_penerima"></select>
>>>>>>> origin/master:application/views/pickup_barang/tambah.php
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
						<input type="number" name="berat_barang[]" class="form-control" placeholder="Berat Barang">
					</td>
				</tr>
				<tr>
					<td>Layanan</td>
					<td>
<<<<<<< HEAD:application/views/pickup_barang/form.php
						<select name="id_jenis_layanan[]" class="form-control">
=======
						<select name="jenis_layanan[]" class="form-control js-basic-single">
>>>>>>> origin/master:application/views/pickup_barang/tambah.php
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