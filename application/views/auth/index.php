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
	    </div>
	    <div class="navbar-nav ml-auto">
	      	<!-- <a class="nav-item nav-link text-white btn btn-danger rounded-pill px-3 mx-2 my-1 page-scroll" href="#pesanan"><i class="fas fa-fw fa-shipping-fast"></i><sup><i class="fas fa-1x fa-plus"></i></sup> Buat Pesanan</a> -->
	      	<a class="nav-item nav-link text-white btn btn-danger rounded-pill px-3 mx-2 my-1 page-scroll" href="<?= base_url('pickupBarang/form') ?>"><i class="fas fa-fw fa-shipping-fast"></i><sup><i class="fas fa-1x fa-plus"></i></sup> Buat Pesanan</a>
	      	<a class="nav-item nav-link text-white btn btn-success rounded-pill px-3 mx-2 my-1 page-scroll" href="#cek_status_pesanan"><i class="fas fa-fw fa-check"></i> Cek Status Pesanan</a>
	    </div>
	</div>
  </div>
</nav>

<!-- divider nav -->
<div class="container"><div class="row my-2"><div class="col my-3"></div></div></div>
<!-- ./divider nav -->

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

<section id="tentang" class="tentang bg-light-blue">
	<div class="container">
		<div class="row py-5">
			<div class="col-lg text-center px-5">
				<h2>Tenang Kami</h2>
				<hr>
				<p>JNE merupakan perusahaan yang bergerak dalam bidang pengiriman dan logistik yang bermarkas di Jakarta, Indonesia. Nama resminya adalah Tiki Jalur Nugraha Ekakurir (Tiki JNE).</p>
				<p>JNE Tangsel BSD Nusaloka merupakan salah satu cabang JNE untuk memperluas jangkauan para pelanggan yang ingin mengirimkan barangnya kepada kerabat, teman, pembeli, dan lain-lain. Pada JNE ini kami memiliki fitur <i>special</i> yaitu, dapat memesan kurir untuk menjemput barangnya supaya tidak repot-repot datang ke cabang terdekat.</p>
				<p>Caranya cukup mudah yaitu, tekan tombol Buat Pesanan pada bagian navbar, atau scroll kebawah hingga menemukan formulir mengisi pesanan Anda.</p>
			</div>
		</div>
	</div>
</section>

<section id="pesanan" class="pesanan bg-blue">
	<div class="container">
		<div class="row py-5">
			<div class="col-lg-6 text-white">
				<h2>Buat Pesanan Anda</h2>
				<div class="row my-2">
			        <div class="col-lg-12">
			          <?php if (validation_errors()): ?>
			            <div class="alert alert-danger alert-dismissible fade show" role="alert">
			              <strong>Gagal!</strong> <?= validation_errors(); ?>
			              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			                <span aria-hidden="true">&times;</span>
			              </button>
			            </div>
			          <?php endif ?>
			        </div>
			      </div>
				<form class="form_input_pesanan" action="<?= base_url('auth/pesanan'); ?>" method="post">
					<div class="row">
						<div class="col-lg">
							<div class="form-group">
					            <label for="nama_pengirim">Nama Pengirim</label>
					            <input type="text" name="nama_pengirim" id="nama_pengirim" class="form-control" required value="<?= set_value('nama_pengirim'); ?>" placeholder="Nama Pengirim">
					            <?= form_error('nama_pengirim', '<small class="form-text text-danger">', '</small>'); ?>
					        </div>
						</div>
						<div class="col-lg">
							<div class="form-group">
					            <label for="no_wa_pengirim">No. WhatsApp Pengirim</label>
					            <input type="text" name="no_wa_pengirim" id="no_wa_pengirim" class="form-control" required value="<?= set_value('no_wa_pengirim'); ?>" placeholder="No. WhatsApp Pengirim">
					            <?= form_error('no_wa_pengirim', '<small class="form-text text-danger">', '</small>'); ?>
					        </div>
						</div>
					</div>
					<div class="form-group">
			            <label for="alamat_pengirim">Alamat Pengirim</label>
			            <textarea name="alamat_pengirim" id="alamat_pengirim" class="form-control" required placeholder="Alamat Pengirim"><?= set_value('alamat_pengirim'); ?></textarea>
			            <?= form_error('alamat_pengirim', '<small class="form-text text-danger">', '</small>'); ?>
			        </div>

			        <div class="row">
			        	<div class="col-lg">
			        		<div class="form-group">
					            <label for="id_provinsi_asal">Provinsi Asal</label>
					            <select name="id_provinsi_asal" id="id_provinsi_asal" class="form-control js-basic-single select2">
					            	<option value="">-- Pilih --</option>
					              <?php foreach ($provinsi as $key): ?>
					                <?php if (set_value("id_provinsi_asal") == $key["id_provinsi"]): ?>
					                <option value="<?= $key["id_provinsi"]; ?>" selected><?= $key["nama_provinsi"]; ?></option>
					                <?php else: ?>
					                <option value="<?= $key["id_provinsi"]; ?>"><?= $key["nama_provinsi"]; ?></option>
					                <?php endif ?>
					              <?php endforeach ?>
					            </select>
					            <?= form_error('id_provinsi_asal', '<small class="form-text text-danger">', '</small>'); ?>
					        </div>
			        	</div>
			        	<div class="col-lg">
			        		<div class="form-group">
					            <label for="id_kabupaten_asal">Kabupaten Asal</label>
					            <select name="id_kabupaten_asal" id="id_kabupaten_asal" class="form-control js-basic-single select2" onload="kabupaten(<?= set_value('id_provinsi_asal') ?>,'#id_kabupaten_asal','<?= set_value('id_kabupaten_asal') ?>')">
					            	<option value="">-- Pilih --</option>
					            </select>
					            <?= form_error('id_kabupaten_asal', '<small class="form-text text-danger">', '</small>'); ?>
					        </div>
			        	</div>
			        	<div class="col-lg">
			        		<div class="form-group">
					            <label for="id_kecamatan_asal">Kecamatan Asal</label>
					            <select name="id_kecamatan_asal" id="id_kecamatan_asal" class="form-control js-basic-single select2" onload="kecamatan(<?= set_value('id_kabupaten_asal') ?>,'#id_kecamatan_asal','<?= set_value('id_kecamatan_asal') ?>')" required>
					            	<option value="">-- Pilih --</option>
					            </select>
					            <?= form_error('id_kecamatan_asal', '<small class="form-text text-danger">', '</small>'); ?>
					        </div>
			        	</div>
			        </div>

					<div class="form-group">
						<label for="nama_barang"><i class="fas fa-fw fa-box"></i> Nama Barang</label>
						<input value="<?= set_value('nama_barang'); ?>" type="text" name="nama_barang" id="nama_barang" class="form-control" required placeholder="Masukkan Nama Barang">
					</div>
					<div class="row">
						<div class="col-sm">
							<div class="form-group">
								<label for="berat_barang"><i class="fas fa-fw fa-weight"></i> Berat Barang (Kg)</label>
								<input value="<?= set_value('berat_barang'); ?>" type="number" step="0.001" name="berat_barang" id="berat_barang" class="form-control" required placeholder="Masukkan Berat Barang">
							</div>
						</div>
						<div class="col-sm">
							<div class="form-group">
								<label for="jumlah_barang"><i class="fas fa-fw fa-boxes"></i> Jumlah Barang</label>
								<input value="<?= set_value('jumlah_barang'); ?>" type="number" name="jumlah_barang" id="jumlah_barang" class="form-control" required min="1" placeholder="Masukkan Jumlah Barang">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg">
							<div class="form-group">
					            <label for="nama_penerima">Nama Penerima</label>
					            <input type="text" name="nama_penerima" id="nama_penerima" class="form-control" required value="<?= set_value('nama_penerima'); ?>" placeholder="Nama Penerima">
					            <?= form_error('nama_penerima', '<small class="form-text text-danger">', '</small>'); ?>
					        </div>
						</div>
						<div class="col-lg">
							<div class="form-group">
					            <label for="no_wa_penerima">No. WhatsApp Penerima</label>
					            <input type="text" name="no_wa_penerima" id="no_wa_penerima" class="form-control" required value="<?= set_value('no_wa_penerima'); ?>" placeholder="No. WhatsApp Penerima">
					            <?= form_error('no_wa_penerima', '<small class="form-text text-danger">', '</small>'); ?>
					        </div>
						</div>
					</div>
			        <div class="form-group">
			            <label for="alamat_penerima">Alamat Penerima</label>
			            <textarea name="alamat_penerima" id="alamat_penerima" class="form-control" required placeholder="Alamat Penerima"><?= set_value('alamat_penerima'); ?></textarea>
			            <?= form_error('alamat_penerima', '<small class="form-text text-danger">', '</small>'); ?>
			        </div>
					
					<div class="row">
						<div class="col-lg">
							<div class="form-group">
					            <label for="id_provinsi_tujuan">Provinsi Tujuan</label>
					            <select name="id_provinsi_tujuan" id="id_provinsi_tujuan" class="form-control js-basic-single select2">
					            	<option value="">-- Pilih --</option>
					              <?php foreach ($provinsi as $key): ?>
					                <?php if (set_value("id_provinsi_tujuan") == $key["id_provinsi"]): ?>
					                <option value="<?= $key["id_provinsi"]; ?>" selected><?= $key["nama_provinsi"]; ?></option>
					                <?php else: ?>
					                <option value="<?= $key["id_provinsi"]; ?>"><?= $key["nama_provinsi"]; ?></option>
					                <?php endif ?>
					              <?php endforeach ?>
					            </select>
					            <?= form_error('id_provinsi_tujuan', '<small class="form-text text-danger">', '</small>'); ?>
					        </div>
					        
						</div>
						<div class="col-lg">
							<div class="form-group">
					            <label for="id_kabupaten_tujuan">Kabupaten Tujuan</label>
					            <select name="id_kabupaten_tujuan" id="id_kabupaten_tujuan" class="form-control js-basic-single select2" onload="kabupaten(<?= set_value('id_provinsi_tujuan') ?>,'#id_kabupaten_tujuan','<?= set_value('id_kabupaten_tujuan') ?>')">
					            	<option value="">-- Pilih --</option>
					            </select>
					            <?= form_error('id_kabupaten_tujuan', '<small class="form-text text-danger">', '</small>'); ?>
					        </div>
						</div>
						<div class="col-lg">
					        <div class="form-group">
					            <label for="id_kecamatan_tujuan">Kecamatan Tujuan</label>
					            <select name="id_kecamatan_tujuan" id="id_kecamatan_tujuan" class="form-control js-basic-single select2"  onload="kecamatan(<?= set_value('id_kabupaten_tujuan') ?>,'#id_kecamatan_tujuan','<?= set_value('id_kecamatan_tujuan') ?>')" required>
					            	<option value="">-- Pilih --</option>
					            </select>
					            <?= form_error('id_kecamatan_tujuan', '<small class="form-text text-danger">', '</small>'); ?>
					        </div>
						</div>
					</div>

					<div class="form-group">
						<label for="id_layanan_paket"><i class="fas fa-fw fa-shipping-fast"></i> Layanan Paket</label>
						<select name="id_layanan_paket" id="id_layanan_paket" class="form-control js-basic-single select2">
					        <option value="">-- Pilih --</option>
							<?php foreach ($layanan_paket as $dlp): ?>
								<?php if ($dlp['harga'] !== '0'): ?>
									<option value="<?= $dlp['id_layanan_paket']; ?>"><?= $dlp['jenis_layanan']; ?> | Rp. <?= number_format($dlp['harga']); ?> | <?= $dlp['durasi_pengiriman']; ?> Jam</option>
								<?php endif ?>
							<?php endforeach ?>
						</select>
					</div>
					<div class="form-group text-right">
						<button type="submit" class="btn btn-success"><i class="fas fa-fw fa-paper-plane"></i> Kirim</button>
					</div>
				</form>
			</div>
			<div class="col-lg-6 my-auto">
				<img class="img-fluid rounded" src="<?= base_url('assets/img/img_properties/side-img.png'); ?>" alt="side-img">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.7159220853064!2d106.68202441476954!3d-6.3010085954397!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fad3a7082c6d%3A0xc71fb55b4d55efb7!2sJNE%20Tangsel%20BSD%20Nusaloka!5e0!3m2!1sid!2sid!4v1591638874359!5m2!1sid!2sid" height="300" frameborder="0" style="border:0; margin-top: 15px;width: 100%" allowfullscreen="" class="rounded"></iframe>
			</div>
		</div>
	</div>
</section>

<section id="cek_status_pesanan" class="cek_status_pesanan bg-light-blue">
	<div class="container">
		<div class="row py-5">
			<div class="col-lg-12 text-center">
				<h2>Cek Status Pesanan</h2>
				<hr>
				<form action="<?= base_url('auth/cek_status_pesanan#cek_status_pesanan'); ?>" method="post">
					<div class="form-group">
						<label for="no_resi">No. Resi (15 digit)</label>
						<input style="font-size: 25px; text-align: center;" type="text" name="no_resi" class="form-control" required value="<?= set_value('no_resi'); ?>" maxlength="15" minlength="15">
					</div>
					<button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-search"></i> Lacak</button>
				</form>
				<br>
				<?php if (isset($berhasil)): ?>
					<section class="bg-light p-3 rounded border border-secondary">
						<div class="row my-2">
							<div class="col">
								<div class="text-white rounded p-1 bg-danger"><i class="fas fa-2x fa-stopwatch"></i></div>
							</div>
							<div class="col">
								<div class="text-white rounded p-1 bg-warning"><i class="fas fa-2x fa-shipping-fast"></i></div>
							</div>
							<div class="col">
								<div class="text-white rounded p-1 bg-success"><i class="fas fa-2x fa-pallet"></i></div>
							</div>
						</div>
						<div class="row text-center my-2">
							<?php if ($no_resi['status'] == '1'): ?>
								<div class="col">
									<div class="progress">
				                  	  <div class="progress-bar bg-danger" role="progressbar" style="width: 16%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
				                    </div>
								</div>
							<?php elseif ($no_resi['status'] == '2'): ?>
								<div class="col">
									<div class="progress">
				                  	  <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
				                    </div>
								</div>
							<?php elseif ($no_resi['status'] == '3'): ?>
								<div class="col">
									<div class="progress">
				                  	  <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
				                    </div>
								</div>
							<?php endif ?>
						</div>
						<div class="table-responsive my-2">
							<table class="table table-bordered table-hover table-striped text-center">
								<thead>
									<tr>
										<?php if ($no_resi['status'] == '1'): ?>
										<th>Pending</th>
										<?php elseif ($no_resi['status'] == '2'): ?>
										<th>Pending</th>
										<th>Kurir Menjemput</th>
										<?php elseif ($no_resi['status'] == '3'): ?>
										<th>Pending</th>
										<th>Kurir Menjemput</th>
										<th>Barang Sampai Logistik</th>
										<?php endif ?>
									</tr>
								</thead>
								<tbody>
									<tr>
										<?php if ($no_resi['status'] == '1'): ?>
											<td><?= $no_resi['tanggal_pemesanan']; ?></td>
										<?php elseif ($no_resi['status'] == '2'): ?>
											<td><?= $no_resi['tanggal_pemesanan']; ?></td>
											<td><?= $no_resi['tanggal_penjemputan']; ?></td>
										<?php elseif ($no_resi['status'] == '3'): ?>
											<td><?= $no_resi['tanggal_pemesanan']; ?></td>
											<td><?= $no_resi['tanggal_penjemputan']; ?></td>
											<td><?= $no_resi['tanggal_masuk_logistik']; ?></td>
										<?php endif ?>
									</tr>
								</tbody>
							</table>
						</div>
						<br>
						<div class="table-responsive">
							<table class="table text-left">
			                    <tr>
			                      <td class="font-weight-bold">No. Resi</td>
			                      <td class="px-1"> : </td>
			                      <td><?= $no_resi['no_resi']; ?></td>
			                    </tr>
			                    <tr>
			                      <td class="font-weight-bold">Nama Pengirim</td>
			                      <td class="px-1"> : </td>
			                      <td><?= $no_resi['nama_pengirim']; ?></td>
			                    </tr>
			                    <tr>
			                      <td class="font-weight-bold">No. WhatsApp Pengirim</td>
			                      <td class="px-1"> : </td>
			                      <td><?= $no_resi['no_wa_pengirim']; ?></td>
			                    </tr>
			                    <tr>
			                      <td class="font-weight-bold">Alamat Pengirim</td>
			                      <td class="px-1"> : </td>
			                      <td><?= $no_resi['alamat_pengirim']; ?></td>
			                    </tr>
			                    <tr>
			                      <td class="font-weight-bold">Nama Barang</td>
			                      <td class="px-1"> : </td>
			                      <td><?= $no_resi['nama_barang']; ?></td>
			                    </tr>
			                    <tr>
			                      <td class="font-weight-bold">Berat Barang (Kg)</td>
			                      <td class="px-1"> : </td>
			                      <td><?= $no_resi['berat_barang']; ?></td>
			                    </tr>
			                    <tr>
			                      <td class="font-weight-bold">Jumlah Barang</td>
			                      <td class="px-1"> : </td>
			                      <td><?= $no_resi['jumlah_barang']; ?></td>
			                    </tr>
			                    <tr>
			                      <td class="font-weight-bold">Nama Penerima</td>
			                      <td class="px-1"> : </td>
			                      <td><?= $no_resi['nama_penerima']; ?></td>
			                    </tr>
			                    <tr>
			                      <td class="font-weight-bold">No. WhatsApp Penerima</td>
			                      <td class="px-1"> : </td>
			                      <td><?= $no_resi['no_wa_penerima']; ?></td>
			                    </tr>
			                    <tr>
			                      <td class="font-weight-bold">Alamat Penerima</td>
			                      <td class="px-1"> : </td>
			                      <td><?= $no_resi['alamat_penerima']; ?></td>
			                    </tr>
			                    <tr>
			                      <td class="font-weight-bold">Layanan Paket</td>
			                      <td class="px-1"> : </td>
			                      <td><?= $no_resi['jenis_layanan']; ?> | Rp. <?= number_format($no_resi['harga']); ?> | <?= $no_resi['durasi_pengiriman']; ?> Jam</td>
			                    </tr>
			                </table>
						</div>
					</section>
				<?php elseif (isset($error)): ?>
					<h4>No. Resi tidak ditemukan!</h4>
					<p>Silahkan periksa kembali No. Resi Anda</p>
				<?php endif ?>
			</div>
		</div>
	</div>
</section>

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
		        <!-- <div class="row px-3 my-4">
		        	<div class="col-lg bg-info px-4 py-3 rounded">
		        		<form method="post">
		        			<h4>Berlangganan Newsletter <span class="oleo-font">JNE Tangsel BSD Nusaloka</span></h4>
							<div class="input-group mb-2">
							  <input value="<?= set_value('email'); ?>" type="email" name="email" required class="form-control" placeholder="Masukkan email anda" aria-label="Recipient's username" aria-describedby="button-addon2">
							  <div class="input-group-append">
							    <button class="btn btn-success" type="submit" id="button-addon2"><i class="fas fa-fw fa-paper-plane"></i> Kirim</button>
							  </div>
							</div>
							<small>Untuk mendapatkan info terbaru tentang kami</small>
		        		</form>
		        	</div>
		        </div> -->
      		</div>
      		<div class="col-lg-6 my-3">
		    	<h3 class="oleo-font">JNE Tangsel BSD Nusaloka</h3>
		    	<div class="row mt-2">
		    		<div class="col-lg">
						<span>&copy; Copyright <?= date('Y'); ?> All rights Reserved By Andri Firman Saputra.</span>
		    		</div>
		    	</div>
				<div class="row mt-3">
					<div class="col-lg">
				        <h4 class="mb-3 font-weight-bold">Admin</h4>
				        <div class="row my-2">
				        	<div class="col-lg">
						        <a class="text-white" target="_blank" href="<?= base_url('auth/login'); ?>">Pegawai Masuk</a>
				        	</div>
				        </div>
				        <div class="row my-2">
				        	<div class="col-lg">
						        <!-- <a class="text-white" target="_blank" href="<?= base_url('assets/file/User Manual Andry Laundry.pdf'); ?>">Panduan Penggunaan</a> -->
				        	</div>
				        </div>
					</div>
				</div>	
				<!-- <div class="row">
					<div class="col-lg text-center">
		        		<img class="img-fluid rounded" src="<?= base_url('assets/img/img_properties/footer.png'); ?>" alt="side-img">
					</div>
				</div> -->	    	
			</div>
		</div>
	</div>
</footer>