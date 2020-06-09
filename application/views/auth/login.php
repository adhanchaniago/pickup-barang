<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
	min-height: 100vh;
  	background: -webkit-linear-gradient(34deg, rgba(221,26,31,1) 0%, rgba(213,212,230,1) 54%, rgba(28,50,117,1) 100%);
  	background: -o-linear-gradient(34deg, rgba(221,26,31,1) 0%, rgba(213,212,230,1) 54%, rgba(28,50,117,1) 100%);
  	background: linear-gradient(124deg, rgba(221,26,31,1) 0%, rgba(213,212,230,1) 54%, rgba(28,50,117,1) 100%);
  	}	

  .container {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
  }

</style>

<div class="container">
	<div class="row justify-content-center my-2">
		<div class="col-lg-5 mx-3 shadow rounded bg-primary text-white p-4">
			<h2 class="heading_2 text-center">Pickup Barang</h2>
			<h3 class="heading_3">Masuk</h3>
			<form method="post">
			  <div class="form-group">
			    <label for="username"><i class="fas fa-fw fa-user"></i> Nama Pengguna</label>
			    <input required type="text" autocomplete="off" id="username" class="form-control rounded-pill" name="username" value="<?= set_value('username'); ?>">
			    <?= form_error('username', '<small class="form-text text-danger">', '</small>'); ?>
			  </div>
			  <div class="form-group">
			    <label for="password"><i class="fas fa-fw fa-lock"></i> Kata Sandi</label>
			    <input required type="password" id="password" class="form-control rounded-pill" name="password" value="<?= set_value('password'); ?>">
			    <?= form_error('password', '<small class="form-text text-danger">', '</small>'); ?>
			  </div>
			  <div class="form-group">
			  	<div class="row justify-content-center">
			  		<!-- <div class="col text-left">
			  			<a href="<?= base_url('assets/files/'); ?>" target="_blank" class="btn btn-danger rounded-pill"><i class="fas fa-fw fa-book"></i> Panduan</a>
			  		</div> -->
			  		<div class="col text-right">
					    <button type="submit" name="login" class="btn btn-success rounded-pill"><i class="fas fa-fw fa-sign-in-alt"></i> Masuk</button>
			  		</div>
			  	</div>
			  </div>
			</form>
		</div>
	</div>
</div>