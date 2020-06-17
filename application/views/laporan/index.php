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
<?php 
    if (isset($_POST['status'])) {
      if ($_POST['status'] == '1') {
        $status = 'Pending';
      } elseif ($_POST['status'] == '2') {
        $status = 'Kurir Menjemput';
      } elseif ($_POST['status'] == '3') {
        $status = 'Barang Masuk Logistik';
      } else {
        $status = 'Semua';
      }
    } 
?>
  	<!-- Main content -->
  	<section class="content">
	  	<div class="container-fluid">
	  		<div class="row tidak_diprint">
	  			<div class="col-lg">
	  				<form method="post">
			            <div class="row">
			              <div class="col-lg my-1">
			                <?php if (isset($_POST['dari_tanggal'])): ?>
			                  <div class="form-group">
			                    <label for="dari_tanggal">Dari Tanggal</label>
			                    <input type="text" class="form-control" id="dari_tanggal" name="dari_tanggal" required value="<?= $_POST['dari_tanggal']; ?>">
			                  </div>
			                <?php else: ?>
			                  <div class="form-group">
			                    <label for="dari_tanggal">Dari Tanggal</label>
			                    <input type="text" class="form-control" id="dari_tanggal" name="dari_tanggal" required value="<?= date('Y/m/01'); ?>">
			                  </div>
			                <?php endif ?>
			              </div>
			              <div class="col-lg my-1">
			                <?php if (isset($_POST['sampai_tanggal'])): ?>
			                  <div class="form-group">
			                    <label for="sampai_tanggal">Sampai Tanggal</label>
			                    <input type="text" class="form-control" id="sampai_tanggal" name="sampai_tanggal" required value="<?= $_POST['sampai_tanggal']; ?>">
			                  </div>
			                <?php else: ?>
			                  <div class="form-group">
			                    <label for="sampai_tanggal">Sampai Tanggal</label>
			                    <input type="text" class="form-control" id="sampai_tanggal" name="sampai_tanggal" required value="<?= date('Y/m/d'); ?>">
			                  </div>
			                <?php endif ?>
			              </div>
			              <div class="col-lg my-1">
			                <label for="status">Status</label>
			                <select name="status" id="status" class="form-control">
			                  <?php if (isset($_POST['status'])): ?>
			                    <option value="<?= $_POST['status']; ?>"><?= $status; ?></option>
			                    <option disabled>-----</option>
			                    <option value="3">Barang Masuk Logistik</option>
			                    <option value="2">Kurir Menjemput</option>
			                    <option value="1">Pending</option>
			                    <option value="4">Semua</option>
			                  <?php else: ?>
			                    <option value="3">Barang Masuk Logistik</option>
			                    <option value="2">Kurir Menjemput</option>
			                    <option value="1">Pending</option>
			                    <option value="4">Semua</option>
			                  <?php endif ?>
			                </select>
			              </div>
			            </div>
				        <div class="row">
				        	<div class="col-lg my-2">
				        		<a href="<?= base_url('laporan'); ?>" class="btn btn-danger"><i class="fas fa-fw fa-sync"></i> Reset</a>
						        <button type="submit" class="btn btn-primary"> <i class="fas fa-fw fa-filter"></i> Filter</button>
						        <?php if (isset($_POST['dari_tanggal'])): ?>
							        <button type="button" onclick="return window.print()" class="btn btn-success"> <i class="fas fa-fw fa-print"></i> Print</button>
						        <?php endif ?>
				        	</div>
				        </div>
				    </form>
	  			</div>
	  		</div>
	  		<?php if (isset($_POST['dari_tanggal'])): ?>
	  			<div class="row ukuran_font">
		  			<div class="col-lg">
		  				<h5>Laporan dari tanggal <?= $_POST['dari_tanggal']; ?> s/d <?= $_POST['sampai_tanggal']; ?>, status: <?= $status; ?></h5>
		  				<div class="table-responsive">
		  					<table class="table table-striped table-bordered table-hover">
		  						<thead class="text-center">
		  							<tr>
		  								<th>No.</th>
		  								<th>No. Resi</th>
		  								<th>Nama Pengirim</th>
		  								<th>Nama Penerima</th>
		  								<th>Nama Barang</th>
		  								<th>Berat Barang (Kg)</th>
		  								<th>Jumlah Barang</th>
		  								<th>Harga Ongkir (Rp)</th>
		  								<th>Tanggal Pemesanan</th>
		  								<th>Tanggal Penjemputan</th>
		  								<th>Tanggal Masuk Logistik</th>
		  								<th>Jenis Layanan</th>
		  								<th>Status</th>
		  							</tr>
		  						</thead>
		  						<tbody>
		  							<?php $i = 1; ?>
		  							<?php foreach ($laporan as $dl): ?>
		  								<?php 
										    if (isset($dl['status'])) {
										      if ($dl['status'] == '1') {
										        $status = 'Pending';
										      } elseif ($dl['status'] == '2') {
										        $status = 'Kurir Menjemput';
										      } elseif ($dl['status'] == '3') {
										        $status = 'Barang Masuk Logistik';
										      } else {
										        $status = 'Semua';
										      }
										    } 
									    ?>
		  								<tr>
		  									<td><?= $i++; ?></td>
		  									<td><?= $dl['no_resi']; ?></td>
		  									<td><?= ucwords(strtolower($dl['nama_pengirim'])); ?></td>
		  									<td><?= ucwords(strtolower($dl['nama_penerima'])); ?></td>
		  									<td><?= ucwords(strtolower($dl['nama_barang'])); ?></td>
		  									<td><?= $dl['berat_barang']; ?></td>
		  									<td><?= number_format($dl['jumlah_barang']); ?></td>
		  									<td><?= number_format($dl['harga']); ?></td>
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
		  									<td><?= $dl['jenis_layanan']; ?></td>
		  									<td><?= $status; ?></td>
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