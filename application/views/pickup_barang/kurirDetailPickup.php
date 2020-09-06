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
	}
	a:hover{
		text-decoration: none;
	}
	p{
		margin: 0;
	}
	.boxSubmit{
		position: fixed;
		bottom: 30px;
		left: 0;
		right: 0;
	}
	.pickup_barang{
		margin: 10px auto 150px;
	}
</style>
<div id="preloader" class="loader"></div>
<form action="" method="post">
	<div class="container pickup_barang">
		<span id="data-detailPickup" data-status="<?= $status; ?>" data-alamat="<?= $pickup_barang["alamat_pengirim"]; ?>"></span>
        <input type="hidden" name="alamat_pengirim" value="<?= $pickup_barang["alamat_pengirim"]; ?>">
		<a href="<?= base_url('pickupBarang/kurir') ?>" class="close"><i class="fas fa-fw fa-times"></i></a>
		<h5>Daftar Pickup Barang</h5>
		<h6>Status : <?= $statusText; ?></h6>
		<h6>Alamat : <?= $pickup_barang["alamat_pengirim"]; ?></h6>
		<div class="row">
			<div class="col-12">
				<div class="form-group">
					<label for="cari">Cari</label>
					<input type="search" class="form-control" id="search" placeholder="Cari">
				</div>
			</div>
		</div>
		<div class="row " id="content"></div>
	</div>
	<div class="bg-white p-3 boxSubmit container">
		<div class="row">
			<div class="col-12 col-sm pr-0 mb-3">
				Total Barang : <span id="total" class="float-right"></span>
			</div>
			<div class="col-12 col-sm-8 text-sm-right pl-0 text-center">
				<button class="btn btn-danger btn-sm" id="btnPending" type="submit" name="btnPending" value="1"><i class="fas fa-fw fa-paper-plane"></i> Ambil <span id="preloaderAmbil" class="loader-small" style="display: none;"></span> </button>
				<button class="btn btn-success btn-sm" id="btnPickup" type="submit" name="btnPickup" value="1"><i class="fas fa-fw fa-paper-plane"></i> Submit (<span id="angka">0</span>) <span id="preloaderSubmit" class="loader-small" style="display: none;"></span></button>
			</div>
		</div>
	</div>	
</form>

<div class="modal" tabindex="-1" role="dialog" id="modalDetail">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Pickup</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
        	<tr>
        		<td>No Resi</td>
        		<td id="no_resi"></td>
        	</tr>
			<tr>
        		<td>Nama Pengirim</td>
        		<td id="nama_pengirim"></td>
        	</tr>
        	<tr>
        		<td>No Wa Pengirim</td>
        		<td id="no_wa_pengirim"></td>
        	</tr>
			<tr>
        		<td>Alamat Pengirim</td>
        		<td id="alamat_pengirim"></td>
        	</tr>
        	<tr>
        		<td>Nama Penerima</td>
        		<td id="nama_penerima"></td>
        	</tr>
        	<tr>
        		<td>No Wa Penerima</td>
        		<td id="no_wa_penerima"></td>
        	</tr>
			<tr>
        		<td>Alamat Penerima</td>
        		<td id="alamat_penerima"></td>
        	</tr>
        	<tr>
        		<td>Nama Barang</td>
        		<td id="nama_barang"></td>
        	</tr>
        	<tr>
        		<td>Jumlah Barang</td>
        		<td id="jumlah_barang"></td>
        	</tr>
        	<tr>
        		<td>Berat Barang</td>
        		<td id="berat_barang"></td>
        	</tr>
        	<tr>
        		<td>Layanan</td>
        		<td id="jenis_layanan"></td>
        	</tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Close</button>
      </div>
    </div>
  </div>
</div>