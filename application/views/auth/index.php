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

<section id="cek_status_pesanan" class="cek_status_pesanan bg-blue">
	<div class="container pb-4">
		<div class="row pt-5">
			<div class="col-lg-12 text-center">
				<h2 class="text-white">Cek Status Pesanan</h2>
				<hr>
				<form action="<?= base_url('auth/cek_status_pesanan#cek_status_pesanan'); ?>" method="post">
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label class="text-white" for="no_wa_pengirim">No. WhatsApp Pengirim</label>
								<?php if (isset($_GET['no_wa_pengirim'])): ?>
									<input style="font-size: 25px; text-align: center;" type="text" name="no_wa_pengirim" class="form-control" required value="<?= $_GET['no_wa_pengirim']; ?>">
								<?php else: ?>
									<input style="font-size: 25px; text-align: center;" type="text" name="no_wa_pengirim" class="form-control" required value="<?= set_value('no_wa_pengirim'); ?>">
								<?php endif ?>
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-search"></i> Lacak</button>
				</form>
				<br>
			</div>
		</div>
		<?php if (isset($berhasil)): ?>
			<div class="row my-2">
				<div class="col-lg-6 my-2 text-left">
					<ul class="list-group list-group-flush rounded">
						<li class="list-group-item active"><i class="fas fa-fw fa-id-card"></i> Data Pengirim</li>
						<li class="list-group-item"><strong><i class="fas fa-fw fa-address-card text-info"></i></strong> <?= $cek_status_pesanan['nama_pengirim']; ?></li>
						<li class="list-group-item"><strong><i class="fab fa-fw fa-whatsapp text-success"></i></strong> <a href="https://api.whatsapp.com/send?phone=<?= $cek_status_pesanan['no_wa_pengirim']; ?>"><?= $cek_status_pesanan['no_wa_pengirim']; ?></a></li>
						<li class="list-group-item"><strong><i class="fas fa-fw fa-map-marker-alt text-danger"></i></strong> <?= $cek_status_pesanan['alamat_pengirim']; ?></li>
					</ul>
					<ul class="list-group list-group-flush rounded my-1">
						<li class="list-group-item active"><i class="fas fa-fw fa-id-card"></i> Jumlah Status</li>
			            <?php if ($jml_status != NULL): ?>
							<li class="list-group-item text-center">
								<span class="mx-2 bg-danger text-white rounded p-2">
									<i class="fas fa-fw fa-stopwatch"></i> <?= $jml_status['pending']; ?>
								</span>
								<span class="mx-2 bg-warning rounded p-2">
									<i class="fas fa-fw fa-shipping-fast"></i> <?= $jml_status['kurir_menjemput']; ?>
								</span>
								<span class="mx-2 bg-success text-white rounded p-2">
									<i class="fas fa-fw fa-pallet"></i> <?= $jml_status['barang_masuk_logistik']; ?>
								</span>
								<span class="mx-2 bg-primary text-white rounded p-2">
									<i class="fas fa-fw fa-check"></i> <?= $jml_status['resi_terinput']; ?>
								</span>
							</li>
						<?php else: ?>
							<li class="list-group-item text-center">
								<span class="mx-2 bg-danger text-white rounded p-2">
									<i class="fas fa-fw fa-stopwatch"></i> 0
								</span>
								<span class="mx-2 bg-warning rounded p-2">
									<i class="fas fa-fw fa-shipping-fast"></i> 0
								</span>
								<span class="mx-2 bg-success text-white rounded p-2">
									<i class="fas fa-fw fa-pallet"></i> 0
								</span>
								<span class="mx-2 bg-primary text-white rounded p-2">
									<i class="fas fa-fw fa-check"></i> 0
								</span>
							</li>
						<?php endif ?>
					</ul>
					
				</div>
				<div class="col-lg-6 my-2 text-left">
					<form method="get" action="<?= base_url('auth/cek_status_pesanan_filter/#daftar_pesanan'); ?>">
						<?php if (isset($_GET['no_wa_pengirim'])): ?>
							<input type="hidden" name="no_wa_pengirim" value="<?= $_GET['no_wa_pengirim']; ?>">
						<?php else: ?>
							<input type="hidden" name="no_wa_pengirim" value="<?= set_value('no_wa_pengirim'); ?>">
						<?php endif ?>
						<ul class="list-group list-group-flush rounded">
							<li class="list-group-item active"><i class="fas fa-fw fa-filter"></i> Filter</li>
							<li class="list-group-item">
								<div class="row">
									<div class="col-lg">
										<div class="form-group">
											<label for="dari_tanggal">Dari Tanggal</label>
						                  	<input type="text" class="form-control" id="dari_tanggal" name="dari_tanggal" required value="<?= $val_dari_tanggal; ?>">
										</div>											
									</div>
									<div class="col-lg">
										<div class="form-group">
											<label for="sampai_tanggal">Sampai Tanggal</label>
						                  	<input type="text" class="form-control" id="sampai_tanggal" name="sampai_tanggal" required value="<?= $val_sampai_tanggal; ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg">
										<div class="form-group">
						                	<label for="status">Status</label>
							                <select name="id_status" id="status" class="form-control">
							                    <option value="">Semua</option>
							                    <?php foreach ($allStatus as $key): ?>
							                      <?php if ($key["id_status"] == $status["id_status"]): ?>
							                        <option value="<?= $key["id_status"]; ?>" selected><?= $key["status"]; ?></option>
							                      <?php else: ?>
							                        <option value="<?= $key["id_status"]; ?>"><?= $key["status"]; ?></option>
							                      <?php endif ?>
							                    <?php endforeach ?>
							                </select>
						                </div>
									</div>
								</div>
								<button type="submit" name="btnFilter" class="btn btn-primary"><i class="fas fa-fw fa-filter"></i> Filter</button>
							</li>
						</ul>
					</form>
				</div>
			</div>
			<div class="row my-2">
				<div id="daftar_pesanan" class="col-lg mx-3 rounded bg-white pt-2 pb-0">
					<h4>Daftar Pesanan <?= $headline; ?></h4>
					<div class="table-responsive">
						<!-- id="table_id" data-link="<?= base_url('auth/datatablePesanan') ?>" -->
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<th>No. Resi</th>
								<th>Nama Penerima</th>
								<th>Tanggal Pemesanan</th>
								<th>Status</th>
							</thead>
							<tbody>
								<?php if ($pesanan == NULL): ?>
									<tr class="text-center">
										<td colspan="4">Tidak ada data</td>
									</tr>
								<?php else: ?>
									<?php $i = 1; ?>
									<?php foreach ($pesanan as $dp): ?>
										<tr>
											<td><?= $dp['no_resi']; ?></td>
											<td><?= $dp['nama_penerima']; ?></td>
											<td><?= $dp['tanggal_pemesanan']; ?></td>
											<td><?= $dp['status']; ?></td>
										</tr>
									<?php endforeach ?>
								<?php endif ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		<?php elseif (isset($error)): ?>
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
