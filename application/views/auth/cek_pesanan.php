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
			<a class="nav-item nav-link text-white btn btn-primary rounded-pill px-3 mx-2 my-1 page-scroll" href="<?= base_url('auth/index'); ?>#home"><i class="fas fa-fw fa-home"></i> Beranda</a>
		  	<a class="nav-item nav-link text-white btn btn-primary rounded-pill px-3 mx-2 my-1 page-scroll" href="<?= base_url('auth/index'); ?>#tentang-50"><i class="fas fa-fw fa-book"></i> Tentang Kami</a>
		  	<a class="nav-item nav-link text-white btn btn-primary rounded-pill px-3 mx-2 my-1 page-scroll" href="<?= base_url('auth/index'); ?>#tracking"><i class="fas fa-fw fa-align-right"></i> Cek Tracking</a>
		</div>
	    <div class="navbar-nav ml-auto">
	      	<a class="nav-item nav-link text-white btn btn-danger rounded-pill px-3 mx-2 my-1 page-scroll" href="<?= base_url('pickupBarang/form') ?>"><i class="fas fa-fw fa-shipping-fast"></i><sup><i class="fas fa-1x fa-plus"></i></sup> Buat Pesanan</a>
	      	<a class="nav-item nav-link text-white btn btn-success rounded-pill px-3 mx-2 my-1" href="https://www.jne.co.id/id/tracking/trace" target="_blank"><i class="fas fa-fw fa-check"></i> Cek No. Resi</a>
	    </div>
	</div>
  </div>
</nav>

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
		.table {
			font-size: 8.5px;
			padding: 0;
			margin: 0;
		}
		.headline {
			font-size: 10px;
		}
		.table_head, .table_data {
			padding: .3rem !important;
		}

	}
</style>


<section class="bg-light p-3 rounded bg-white shadow-sm container my-2">

	<div class="table-responsive not_print">
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
		                  	<input type="text" class="form-control dated-input" id="dari_tanggal" name="dari_tanggal" required value="<?= $val_dari_tanggal; ?>">
						</div>											
					</div>
					<div class="col-lg">
						<div class="form-group">
							<label for="sampai_tanggal">Sampai Tanggal</label>
		                  	<input type="text" class="form-control dated-input" id="sampai_tanggal" name="sampai_tanggal" required value="<?= $val_sampai_tanggal; ?>">
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

    <h5 class="headline">Penerima <?= $headline; ?></h5>

    <div class="table-responsive">
    	<table class="table table-bordered">
    		<thead class="text-center">
    			<tr>
	    			<th class="table_head">No</th>
	    			<th class="table_head">No Resi</th>
	    			<th class="table_head">Layanan</th>
	    			<th class="table_head">Berat</th>
	    			<th class="table_head">Jumlah</th>
	    			<th style="min-width: 16rem!important">Destinasi</th>
	    			<th class="table_head">Nama Pengirim</th>
	    			<th class="table_head">No. WA Pengirim</th>
	    			<th class="table_head">Nama Penerima</th>
	    			<th class="table_head">No. WA Penerima</th>
	    			<th class="table_head">Harga Pengiriman</th>
	    			<th class="table_head">Status</th>
    			</tr>
    		</thead>
    		<tbody>
    			<?php $no=1;foreach ($pesanan as $key): ?>
	    			<tr>
		    			<td class="table_data"><?= $no; ?></td>
		    			<td class="table_data"><?= $key["no_resi"]; ?></td>
		    			<td class="table_data"><?= $key["jenis_layanan"]; ?></td>
		    			<td class="table_data"><?= $key["berat_barang"]; ?> Kg</td>
		    			<td class="table_data"><?= $key["jumlah_barang"]; ?></td>
		    			<td class="table_data"><?= $key["alamat_penerima"]; ?></td>
		    			<td class="table_data"><?= $key["nama_pengirim"]; ?></td>
		    			<td class="table_data"><?= $key["no_wa_pengirim"]; ?></td>
		    			<td class="table_data"><?= $key["nama_penerima"]; ?></td>
		    			<td class="table_data"><?= $key["no_wa_penerima"]; ?></td>
		    			<td class="table_data">Rp. <?= number_format($key["harga_pengiriman"]); ?></td>
		    			<td class="table_data">
		    				<div class="text-center">
			    				<a href="#" data-id="<?= $key["id_pickup_barang"]; ?>" class="not_print btn btn-sm btn-detail-status <?= bg_status($key["id_status"]); ?> <?= text_status($key["id_status"]); ?>">
			    					<i class="fas fa-fw <?= icon_status($key["id_status"]); ?>"></i>
				    			</a>
				    			<span class="d-none text-left is_print text-dark"><?= $key["status"]; ?></span>
			    			</div>
			    		</td>
	    			</tr>
    			<?php $no++;endforeach ?>
    			<?php if (count($pesanan) == 0): ?>
    				<tr>
    					<td colspan="7" class="text-center">Data Tidak Ditemukan</td>
    				</tr>
    			<?php endif ?>
    		</tbody>
    	</table>
    </div>

<!-- Modal -->
<div class="modal fade" id="progressModal" tabindex="-1" role="dialog" aria-labelledby="progressModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="progressModalLabel"></h5>
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
        	<div class="col">
				<div class="progress">
              	  <div class="progress-bar" role="progressbar" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
			</div>
		</div>

		<div class="table-responsive my-2">
			<table class="table table-bordered table-hover table-striped text-center"></table>
		</div>

      </div>

    </div>
  </div>
</div>

</section>