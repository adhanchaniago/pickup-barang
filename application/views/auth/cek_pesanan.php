<style>
	.d-none {
		display: none;
	}
	@media print {
		.not_print {
			display: none;
		}
		.is_print {
			display: block!important;
		}
	}
</style>


<section class="bg-light p-3 rounded bg-white shadow-sm container my-2">

	<div class="table-responsive not_print">
		<a href="<?= base_url('auth') ?>" class="close"><i class="fas fa-fw fa-times"></i></a>
		<h5>Pengirim</h5>
		<table class="table text-left">
            <tr>
              <td class="font-weight-bold">Nama Pengirim</td>
              <td class="px-1"> : </td>
              <td><?= $pengirim['nama_pengirim']; ?></td>
            </tr>
            <tr>
              <td class="font-weight-bold">No. WhatsApp Pengirim</td>
              <td class="px-1"> : </td>
              <td><?= $pengirim['no_wa_pengirim']; ?></td>
            </tr>
            <tr>
              <td class="font-weight-bold">Alamat Pengirim</td>
              <td class="px-1"> : </td>
              <td><?= $pengirim['alamat_pengirim']; ?></td>
            </tr>
        </table>
    </div>
    <div class="not_print dropdown-divider"></div>
	
	<form method="post" class="not_print" action="<?= base_url('auth/cek_status_pesanan/'); ?>">
		<?php if (isset($_POST['no_wa_pengirim'])): ?>
			<input type="hidden" name="no_wa_pengirim" value="<?= $_POST['no_wa_pengirim']; ?>">
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
				<button type="button" onclick="window.print()" class="btn btn-success"><i class="fas fa-fw fa-print"></i> Print</button>
			</li>
		</ul>
	</form>

    <h5>Penerima <?= $headline; ?></h5>

    <div class="table-responsive">
    	<table class="table table-bordered">
    		<thead>
    			<tr>
	    			<th>No</th>
	    			<th>No Resi</th>
	    			<th>Nama Penerima</th>
	    			<th>No. WhatsApp</th>
	    			<th>Alamat</th>
	    			<th>Keterangan Barang</th>
	    			<th>Status</th>
    			</tr>
    		</thead>
    		<tbody>
    			<?php $no=1;foreach ($pesanan as $key): ?>
	    			<tr>
		    			<td><?= $no; ?></td>
		    			<td><?= $key["no_resi"]; ?></td>
		    			<td><?= $key["nama_penerima"]; ?></td>
		    			<td><?= $key["no_wa_penerima"]; ?></td>
		    			<td><?= $key["alamat_penerima"]; ?></td>
		    			<td>
		    				<strong>Nama Barang: </strong> <?= $key["nama_barang"]; ?>,  
		    				<strong>Jumlah Barang: </strong> <?= number_format($key['jumlah_barang']); ?> Unit, 
		    				<strong>Berat Barang: </strong> <?= number_format($key['berat_barang']); ?> Kg
		    			</td>
		    			<td>
		    				<div class="text-center">
			    				<a href="#" data-target="#progressModal<?= $key['id_pickup_barang']; ?>" data-toggle="modal" class="not_print btn btn-sm <?= bg_status($key["id_status"]); ?> <?= text_status($key["id_status"]); ?>">
			    					<i class="fas fa-fw <?= icon_status($key["id_status"]); ?>"></i>
				    			</a>
				    			<?php if ($key['status'] == '1'): ?>
				    				<span class="d-none is_print text-dark">Pending</span>
				    			<?php elseif ($key['status'] == '2'): ?>
				    				<span class="d-none is_print text-dark">Kurir Menjemput</span>
				    			<?php elseif ($key['status'] == '3'): ?>
					    			<span class="d-none is_print text-dark">Barang Masuk Logistik</span>
				    			<?php else: ?>
					    			<span class="d-none is_print text-dark">No. Resi Dicetak</span>
				    			<?php endif ?>
			    			</div>
			    		</td>
	    			</tr>
    			<?php $no++;endforeach ?>
    		</tbody>
    	</table>
    </div>

<?php foreach ($pesanan as $key): ?>
<!-- Modal -->
<div class="modal fade" id="progressModal<?= $key['id_pickup_barang']; ?>" tabindex="-1" role="dialog" aria-labelledby="progressModal<?= $key['id_pickup_barang']; ?>Label" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="progressModal<?= $key['id_pickup_barang']; ?>Label">Status Progress: <?= $key['nama_barang']; ?>, <?= $key['no_resi']; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="row my-2">
			<div class="col">
				<div class="text-white text-center rounded p-1 bg-danger"><i class="fas fa-2x fa-stopwatch"></i></div>
			</div>
			<div class="col">
				<div class="text-white text-center rounded p-1 bg-warning"><i class="fas fa-2x fa-shipping-fast"></i></div>
			</div>
			<div class="col">
				<div class="text-white text-center rounded p-1 bg-success"><i class="fas fa-2x fa-pallet"></i></div>
			</div>
			<div class="col">
				<div class="text-white text-center rounded p-1 bg-primary"><i class="fas fa-2x fa-paper-plane"></i></div>
			</div>
		</div>
        <div class="row text-center my-2">
			<?php if ($key['id_status'] == '1'): ?>
				<div class="col">
					<div class="progress">
	              	  <div class="progress-bar bg-danger" role="progressbar" style="width: 12%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
	                </div>
				</div>
			<?php elseif ($key['id_status'] == '2'): ?>
				<div class="col">
					<div class="progress">
	              	  <div class="progress-bar bg-warning" role="progressbar" style="width: 37%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
	                </div>
				</div>
			<?php elseif ($key['id_status'] == '3'): ?>
				<div class="col">
					<div class="progress">
	              	  <div class="progress-bar bg-success" role="progressbar" style="width: 63%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
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
						<?php if ($key['id_status'] == '1'): ?>
						<th>Pending</th>
						<?php elseif ($key['id_status'] == '2'): ?>
						<th>Pending</th>
						<th>Kurir Menjemput</th>
						<?php elseif ($key['id_status'] == '3'): ?>
						<th>Pending</th>
						<th>Kurir Menjemput</th>
						<th>Barang Sampai Logistik</th>
						<?php else: ?>
						<th>Pending</th>
						<th>Kurir Menjemput</th>
						<th>Barang Sampai Logistik</th>
						<th>No. Resi Terkirim</th>
						<?php endif ?>
					</tr>
				</thead>
				<tbody>
					<tr>
						<?php if ($key['id_status'] == '1'): ?>
							<td><?= $key['tanggal_pemesanan']; ?></td>
						<?php elseif ($key['id_status'] == '2'): ?>
							<td><?= $key['tanggal_pemesanan']; ?></td>
							<td><?= $key['tanggal_penjemputan']; ?></td>
						<?php elseif ($key['id_status'] == '3'): ?>
							<td><?= $key['tanggal_pemesanan']; ?></td>
							<td><?= $key['tanggal_penjemputan']; ?></td>
							<td><?= $key['tanggal_masuk_logistik']; ?></td>
						<?php else: ?>
							<td><?= $key['tanggal_pemesanan']; ?></td>
							<td><?= $key['tanggal_penjemputan']; ?></td>
							<td><?= $key['tanggal_masuk_logistik']; ?></td>
							<td><?= $key['tanggal_input_resi']; ?></td>
						<?php endif ?>
					</tr>
				</tbody>
			</table>
		</div>
      </div>

    </div>
  </div>
</div>
<?php endforeach ?>

<!-- 	<div class="row my-2">
		<div class="col">
			<div class="text-white text-center rounded p-1 bg-danger"><i class="fas fa-2x fa-stopwatch"></i></div>
		</div>
		<div class="col">
			<div class="text-white text-center rounded p-1 bg-warning"><i class="fas fa-2x fa-shipping-fast"></i></div>
		</div>
		<div class="col">
			<div class="text-white text-center rounded p-1 bg-success"><i class="fas fa-2x fa-pallet"></i></div>
		</div>
		<div class="col">
			<div class="text-white text-center rounded p-1 bg-primary"><i class="fas fa-2x fa-paper-plane"></i></div>
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
					<?php else: ?>
					<th>Pending</th>
					<th>Kurir Menjemput</th>
					<th>Barang Sampai Logistik</th>
					<th>No. Resi Terkirim</th>
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
	</div> -->

</section>