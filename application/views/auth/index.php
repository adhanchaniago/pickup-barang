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
				<h2>Tenang Kami</h2>
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

<section id="cek_status_pesanan" class="cek_status_pesanan bg-blue text-white">
	<div class="container">
		<div class="row py-5">
			<div class="col-lg-12 text-center">
				<h2>Cek Status Pesanan</h2>
				<hr>
				<form action="<?= base_url('auth/cek_status_pesanan#cek_status_pesanan'); ?>" method="post">
					<div class="form-group">
						<label for="no_wa_pengirim">No. WhatsApp Pengirim</label>
						<input style="font-size: 25px; text-align: center;" type="text" name="no_wa_pengirim" class="form-control" required value="<?= set_value('no_wa_pengirim'); ?>">
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
							<div class="col">
								<div class="text-white rounded p-1 bg-primary"><i class="fas fa-2x fa-paper-plane"></i></div>
							</div>
						</div>
						<div class="row text-center my-2">
							<?php if ($cek_status_pesanan['id_status'] == '1'): ?>
								<div class="col">
									<div class="progress">
				                  	  <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
				                    </div>
								</div>
							<?php elseif ($cek_status_pesanan['id_status'] == '2'): ?>
								<div class="col">
									<div class="progress">
				                  	  <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
				                    </div>
								</div>
							<?php elseif ($cek_status_pesanan['id_status'] == '3'): ?>
								<div class="col">
									<div class="progress">
				                  	  <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
				                    </div>
								</div>
							<?php else: ?>
								<div class="col">
									<div class="progress">
				                  	  <div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
				                    </div>
								</div>
							<?php endif ?>
						</div>
						<div class="table-responsive my-2">
							<table class="table table-bordered table-hover table-striped text-center">
								<thead>
									<tr>
										<?php if ($cek_status_pesanan['id_status'] == '1'): ?>
										<th>Pending</th>
										<?php elseif ($cek_status_pesanan['id_status'] == '2'): ?>
										<th>Pending</th>
										<th>Kurir Menjemput</th>
										<?php elseif ($cek_status_pesanan['id_status'] == '3'): ?>
										<th>Pending</th>
										<th>Kurir Menjemput</th>
										<th>Barang Sampai Logistik</th>
										<?php endif ?>
									</tr>
								</thead>
								<tbody>
									<tr>
										<?php if ($cek_status_pesanan['id_status'] == '1'): ?>
											<td><?= $cek_status_pesanan['tanggal_pemesanan']; ?></td>
										<?php elseif ($cek_status_pesanan['id_status'] == '2'): ?>
											<td><?= $cek_status_pesanan['tanggal_pemesanan']; ?></td>
											<td><?= $cek_status_pesanan['tanggal_penjemputan']; ?></td>
										<?php elseif ($cek_status_pesanan['id_status'] == '3'): ?>
											<td><?= $cek_status_pesanan['tanggal_pemesanan']; ?></td>
											<td><?= $cek_status_pesanan['tanggal_penjemputan']; ?></td>
											<td><?= $cek_status_pesanan['tanggal_masuk_logistik']; ?></td>
										<?php else: ?>
											<td><?= $cek_status_pesanan['tanggal_pemesanan']; ?></td>
											<td><?= $cek_status_pesanan['tanggal_penjemputan']; ?></td>
											<td><?= $cek_status_pesanan['tanggal_masuk_logistik']; ?></td>
											<td><?= $cek_status_pesanan['tanggal_input_resi']; ?></td>
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
			                      <td><?= $cek_status_pesanan['no_resi']; ?></td>
			                    </tr>
			                    <tr>
			                      <td class="font-weight-bold">Nama Pengirim</td>
			                      <td class="px-1"> : </td>
			                      <td><?= $cek_status_pesanan['nama_pengirim']; ?></td>
			                    </tr>
			                    <tr>
			                      <td class="font-weight-bold">No. WhatsApp Pengirim</td>
			                      <td class="px-1"> : </td>
			                      <td><?= $cek_status_pesanan['no_wa_pengirim']; ?></td>
			                    </tr>
			                    <tr>
			                      <td class="font-weight-bold">Alamat Pengirim</td>
			                      <td class="px-1"> : </td>
			                      <td><?= $cek_status_pesanan['alamat_pengirim']; ?></td>
			                    </tr>
			                    <tr>
			                      <td class="font-weight-bold">Nama Penerima</td>
			                      <td class="px-1"> : </td>
			                      <td><?= $cek_status_pesanan['nama_penerima']; ?></td>
			                    </tr>
			                    <tr>
			                      <td class="font-weight-bold">No. WhatsApp Penerima</td>
			                      <td class="px-1"> : </td>
			                      <td><?= $cek_status_pesanan['no_wa_penerima']; ?></td>
			                    </tr>
			                    <tr>
			                      <td class="font-weight-bold">Alamat Penerima</td>
			                      <td class="px-1"> : </td>
			                      <td><?= $cek_status_pesanan['alamat_penerima']; ?></td>
			                    </tr>
			                    <tr>
			                      <td class="font-weight-bold">Layanan Paket</td>
			                      <td class="px-1"> : </td>
			                      <td><?= $cek_status_pesanan['jenis_layanan']; ?></td>
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
