<style>
	@media print {
		.tidak_diprint {
			display: none;
		}
		.ukuran_font {
			font-size: 10px;
		}
	}	

</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  	<!-- Content Header (Page header) -->
  	<div class="content-header tidak_diprint">
	    <div class="container-fluid">
	      <div class="row">
	        <div class="col-sm header-title">
	          <h1 class="m-0 text-dark">Laporan</h1>
	        </div><!-- /.col -->
	      </div><!-- /.row -->
	      <div class="row">
	        <div class="col-lg-6">
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
	    </div><!-- /.container-fluid -->
  	</div>
  	<!-- /.content-header -->
  	<!-- Main content -->
  	<section class="content">
	  	<div class="container-fluid">
	  		<div class="row tidak_diprint">
	  			<div class="col-lg">
	  				<form method="post">
			            <div class="row">
			              <div class="col-lg my-1">
			                  <div class="form-group">
			                    <label for="dari_tanggal">Dari Tanggal</label>
			                    <input type="text" class="form-control" id="dari_tanggal" name="dari_tanggal" required value="<?= $val_dari_tanggal; ?>">
			                  </div>
			              </div>
			              <div class="col-lg my-1">
			                  <div class="form-group">
			                    <label for="sampai_tanggal">Sampai Tanggal</label>
			                    <input type="text" class="form-control" id="sampai_tanggal" name="sampai_tanggal" required value="<?= $val_sampai_tanggal; ?>">
			                  </div>
			              </div>
			              <div class="col-lg my-1">
			                <label for="id_status">Status</label>
			                <select name="id_status" id="id_status" class="form-control">
			                  <?php foreach ($allStatus as $key): ?>
			                    <?php if ($key["id_status"] == $id_status): ?>
			                      <option value="<?= $key["id_status"]; ?>" selected><?= $key["status"]; ?></option>
			                    <?php else: ?>
			                      <option value="<?= $key["id_status"]; ?>"><?= $key["status"]; ?></option>
			                    <?php endif ?>
			                  <?php endforeach ?>
			                  <?php if ($id_status == ''): ?>
			                  		<option value="" selected>Semua</option>
			                  	<?php else: ?>
			                  		<option value="">Semua</option>
			                   <?php endif ?>
			                </select>
			              </div>
			            </div>
				        <div class="row">
				        	<div class="col-lg my-2">
				        		<a href="<?= base_url('laporan'); ?>" class="btn btn-danger"><i class="fas fa-fw fa-sync"></i> Reset</a>
						        <button type="submit" class="btn btn-primary"> <i class="fas fa-fw fa-filter"></i> Filter</button>
						        <?php if ($dari_tanggal != ''): ?>
							        <button type="button" onclick="return window.print()" class="btn btn-success"> <i class="fas fa-fw fa-print"></i> Print</button>
						        <?php endif ?>
				        	</div>
				        </div>
				    </form>
	  			</div>
	  		</div>

	  		<?php if ($dari_tanggal != ''): ?>
	  			<div class="row ukuran_font">
		  			<div class="col-lg">
		  				<h5>Laporan dari tanggal <?= $dari_tanggal; ?> s/d <?= $sampai_tanggal; ?>, status: <?= $status; ?></h5>
		  				<div class="table-responsive">
		  					<table class="table table-striped table-bordered table-hover">
		  						<thead class="text-center">
		  							<tr>
		  								<th>No.</th>
		  								<th>No. Resi</th>
		  								<th>Nama Pengirim</th>
		  								<th>Nama Penerima</th>
		  								<th>Tanggal Pemesanan</th>
		  								<th>Tanggal Penjemputan</th>
		  								<th>Tanggal Masuk Logistik</th>
		  								<th>Keterangan Barang</th>
		  								<th>Jenis Layanan</th>
		  								<th>Status</th>
		  							</tr>
		  						</thead>
		  						<tbody>
		  							<?php $i = 1; ?>
		  							<?php foreach ($laporan as $dl): ?>
		  								<tr>
		  									<td><?= $i++; ?></td>
		  									<td><?= $dl['no_resi']; ?></td>
		  									<td><?= kapital($dl['nama_pengirim']); ?></td>
		  									<td><?= kapital($dl['nama_penerima']); ?></td>
		  									<td><?= $dl['tanggal_pemesanan']; ?></td>
		  									<?php if ($dl['tanggal_penjemputan'] == ''): ?>
		  										<td>-</td>
	  										<?php else: ?>
		  										<td><?= $dl['tanggal_penjemputan']; ?></td>
		  									<?php endif ?>
		  									<?php if ($dl['tanggal_masuk_logistik'] == ''): ?>
		  										<td>-</td>
	  										<?php else: ?>
			  									<td><?= $dl['tanggal_masuk_logistik']; ?></td>
		  									<?php endif ?>
		  									<td><strong>Nama: </strong> <?= $dl['nama_barang']; ?>, <strong>Jumlah: </strong> <?= number_format($dl['jumlah_barang']); ?>, <strong>Berat: </strong> <?= number_format($dl['berat_barang']); ?> Kg</td>
		  									<td><?= $dl['jenis_layanan']; ?></td>
		  									<td><?= $dl['status']; ?></td>
		  								</tr>
		  							<?php endforeach ?>
		  						</tbody>
		  					</table>
		  				</div>
		  			</div>
		  		</div>
	  		<?php endif ?>
	  	</div>
  	</section>
</div>