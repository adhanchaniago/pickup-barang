<style>
	.font{
		font-size: 50px;
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%,-50%);
	}
	.relative{
		position: relative;
		height: 100px;
	}
	a:hover{
		text-decoration: none;
	}
</style>
<div class="container my-3">
	<h5>Daftar Pickup Barang</h5>
	<div class="row">
		<div class="col-md-6">
			<div class="forn-group">
				<label for="status">Status</label>
				<select id="status" class="form-control">
					<?php foreach ($status as $key => $value): ?>
						<option value="<?= $key; ?>"><?= $value; ?></option>
					<?php endforeach ?>
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

	<div class="row mt-3" id="content"></div>
</div>