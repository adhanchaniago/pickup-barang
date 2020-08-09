<style>
	.font{
		font-size: 40px;
		position: absolute;
		top: 35%;
		left: 50%;
		transform: translate(-50%,-50%);
	}
	.total{
		position: absolute;
		top: 80%;
		left: 50%;
		transform: translate(-50%,-50%);	
	}
	.relative{
		position: relative;
		height: 100px;
		margin-bottom: 0px;
	}
	a:hover{
		text-decoration: none;
	}
</style>
<div class="container my-3">
	<a href="<?= base_url('pickupBarang') ?>" class="close"><i class="fas fa-fw fa-times"></i></a>
	<h5>Daftar Pickup Barang</h5>	
	<div class="row">
		<div class="col-md-6">
			<div class="forn-group">
				<label for="status">Status</label>
				<select id="status" class="form-control">
					<?php foreach ($status as $key): ?>
						<option value="<?= $key["id_status"]; ?>"><?= $key["status"]; ?></option>
					<?php endforeach ?>
					<option value="">Semua</option>
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="search">Cari</label>
				<input type="search" class="form-control" id="search" placeholder="Cari">
			</div>
		</div>
	</div>

	<div id="preloader" class="loader"></div>
	<div class="row mt-3" id="content"></div>
</div>