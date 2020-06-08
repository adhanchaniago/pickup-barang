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
	    	<a class="nav-item nav-link text-white btn btn-primary rounded-pill px-3 mx-2 my-1 page-scroll" href="#home">Beranda</a>
	      	<a class="nav-item nav-link text-white btn btn-primary rounded-pill px-3 mx-2 my-1 page-scroll" href="#tentang">Tentang Kami</a>
	    </div>
	    <div class="navbar-nav ml-auto">
	      	<a class="nav-item nav-link text-white btn btn-success rounded-pill px-3 mx-2 my-1 page-scroll" href="#pesanan"><i class="fas fa-fw fa-shipping-fast"></i> Buat Pesanan</a>
	    </div>
	</div>
  </div>
</nav>

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
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit fugiat, quis a optio? Vero sapiente ab suscipit consequuntur iure nam obcaecati fugit numquam adipisci excepturi reiciendis reprehenderit, ut minima, sit. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit commodi, provident asperiores ullam, inventore sit alias accusamus saepe mollitia voluptas eos deleniti consectetur tempora hic porro molestiae fuga temporibus voluptatem!</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse magnam debitis neque quos eos obcaecati perspiciatis sit quibusdam. Ipsa, odio illo animi consequatur voluptate natus officiis magni fugit quisquam dolore dolorum et iusto itaque, quasi amet architecto aliquam esse. Autem expedita velit, deserunt assumenda sequi facilis corporis recusandae hic ipsam.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam ipsa laudantium minima natus doloribus at maxime ab, delectus, saepe sed debitis, id in voluptatibus, officiis optio accusantium magni nisi. Consequuntur voluptate dolores, maiores quod, eos sit expedita ipsum quisquam recusandae corrupti veritatis nam placeat voluptatem quasi! Ipsam cum totam aut, commodi quo perspiciatis eveniet amet aspernatur fuga reprehenderit, nesciunt, ipsa dolorum aliquid temporibus nam. Itaque nesciunt totam, soluta ex enim. Nisi eum adipisci libero sint, suscipit? Molestias laudantium nesciunt hic optio, fugiat, numquam delectus quia totam temporibus!</p>
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
				<form action="<?= base_url('auth/pesanan'); ?>" method="post">
					<div class="row">
						<div class="col-lg">
							<div class="form-group">
								<label for="nama_pengirim"><i class="fas fa-fw fa-user"></i> Nama Pengirim</label>
								<input value="<?= set_value('nama_pengirim'); ?>" type="text" name="nama_pengirim" id="nama_pengirim" class="form-control" required>
							</div>
						</div>
						<div class="col-lg">
							<div class="form-group">
								<label for="no_whatsapp_pengirim"><i class="fab fa-fw fa-whatsapp"></i> No. Whatsapp Pengirim</label>
								<input value="<?= set_value('no_whatsapp_pengirim'); ?>" type="number" name="no_whatsapp_pengirim" id="no_whatsapp_pengirim" class="form-control" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="alamat_pengirim"><i class="fas fa-fw fa-map-marked-alt"></i> Alamat Pengirim</label>
						<textarea name="alamat_pengirim" id="alamat_pengirim" class="form-control" required><?= set_value('alamat_pengirim'); ?></textarea>
					</div>
					<div class="form-group">
						<label for="nama_barang"><i class="fas fa-fw fa-box"></i> Nama Barang</label>
						<input value="<?= set_value('nama_barang'); ?>" type="text" name="nama_barang" id="nama_barang" class="form-control" required>
					</div>
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label for="berat_barang"><i class="fas fa-fw fa-weight"></i> Berat Barang (Kg)</label>
								<input value="<?= set_value('berat_barang'); ?>" type="number" step="0.001" name="berat_barang" id="berat_barang" class="form-control" required>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label for="jumlah_barang"><i class="fas fa-fw fa-boxes"></i> Jumlah Barang</label>
								<input value="<?= set_value('jumlah_barang'); ?>" type="number" name="jumlah_barang" id="jumlah_barang" class="form-control" required min="1">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg">
							<div class="form-group">
								<label for="nama_penerima"><i class="fas fa-fw fa-user-tie"></i> Nama Penerima</label>
								<input value="<?= set_value('nama_penerima'); ?>" type="text" name="nama_penerima" id="nama_penerima" class="form-control" required>
							</div>
						</div>
						<div class="col-lg">
							<div class="form-group">
								<label for="no_whatsapp_penerima"><i class="fab fa-fw fa-whatsapp"></i> No. Whatsapp Penerima</label>
								<input value="<?= set_value('no_whatsapp_penerima'); ?>" type="number" name="no_whatsapp_penerima" id="no_whatsapp_pengirim" class="form-control" placeholder="(Optional)">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="alamat_penerima"><i class="fas fa-fw fa-map-marked-alt"></i> Alamat Penerima</label>
						<textarea name="alamat_penerima" id="alamat_penerima" class="form-control" required><?= set_value('alamat_penerima'); ?></textarea>
					</div>
					<div class="form-group">
						<label for="id_layanan_paket"><i class="fas fa-fw fa-shipping-fast"></i> Layanan Paket</label>
						<select name="id_layanan_paket" id="id_layanan_paket" class="form-control">
							<?php foreach ($layanan_paket as $dlp): ?>
								<?php if ($dlp['harga_layanan_paket'] !== '0'): ?>
									<option value="<?= $dlp['id_layanan_paket']; ?>"><?= $dlp['layanan_paket']; ?> | Rp. <?= number_format($dlp['harga_layanan_paket']); ?> | <?= $dlp['durasi_pengiriman']; ?> Jam</option>
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

<footer class="bg-dark text-white p-4">
	<div class="container-fluid">
		<div class="row justify-content-center">
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
						        <a class="text-white" target="_blank" href="<?= base_url('assets/file/User Manual Andry Laundry.pdf'); ?>">Panduan Penggunaan</a>
				        	</div>
				        </div>
					</div>
				</div>	
				<div class="row">
					<div class="col-lg text-center">
		        		<img class="img-fluid rounded" src="<?= base_url('assets/img/img_properties/footer.png'); ?>" alt="side-img">
					</div>
				</div>	    	
			</div>

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
		        <div class="row px-3 my-4">
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
		        </div>
      		</div>
		</div>
	</div>
</footer>