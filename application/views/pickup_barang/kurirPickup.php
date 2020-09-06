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
	<h5>Daftar Pickup Barang</h5>
	<div class="row mt-5" id="menu">
		<div class="col-12">
			<?php foreach ($status as $key => $val): ?>
			<a href="#" class="btn btn-<?= $warna[$key]; ?> text-<?= $warna[$key]; ?> bg-white p-4 mb-2 d-block text-left status" data-id="<?= $val["id_status"]; ?>">
				<h6 class="p-0 m-0"><span class="text"><?= $val["status"]; ?></span> <div class="float-right"><?= $val["total"]; ?></div></h6>
			</a>
			<?php endforeach ?>
			<!-- <a href="#" class="btn btn-dark text-dark bg-white p-4 mb-2 d-block text-left status" data-id="">
				<h6 class="p-0 m-0"><span class="text">Semua</span> <div class="float-right"><?= $total_semua; ?></div></h6>
			</a> -->
			<!-- <div class="forn-group">
				<label for="status">Status</label>
				<select id="status" class="form-control">
					<?php foreach ($status as $key): ?>
						<option value="<?= $key["id_status"]; ?>"><?= $key["status"]; ?></option>
					<?php endforeach ?>
					<option value="">Semua</option>
				</select>
			</div> -->
		</div>
		<!-- <div class="col-12">
			<div class="form-group">
				<label for="search">Cari</label>
				<input type="search" class="form-control" id="search" placeholder="Cari">
			</div>
		</div> -->
	</div>

	<div id="preloader" class="loader" style="display: none;"></div>
	<div style="display: none;min-height: 100vh" class="pb-5" id="box">
		<a href="#" class="close" id="back"><i class="fas fa-fw fa-times"></i></a>
		<h6>Status 	: <span id="textStatus"></span></h6>
		<div class="row mt-" id="content"></div>
	</div>
	
</div>