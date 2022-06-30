<h1 class="h3 mb-4 text-gray-800"> <?= $title; ?></h1>

<div class="row">
  <div class="col-lg-6">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Form Ubah Pegawai</h6>
      </div>
      <div class="card-body">
        <form action="<?= base_url('ubah-pegawai?nip='.$pegawai['no_id']); ?>" method="post">
        	<input type="text" hidden name="id" value="<?= $pegawai['id']; ?>">
	        <div class="form-group mb-1">
	          <label class="mb-0" class="mb-0">Kode</label>
	            <input type="text" class="form-control form-control-sm" name="nip" value="<?= $pegawai['no_id']; ?>" disabled>
	        </div>
	        <div class="form-group">
	          <label class="mb-0">Nama Pegawai</label>
	          <input type="text" class="form-control form-control-sm" name="nama" value="<?= $pegawai['nama']; ?>">
            <?php echo form_error('nama'); ?>
	        </div>
	        	        
	        <div class="form-group">
	        	<a href="<?= base_url('pegawai'); ?>" class="btn btn-secondary">Kembali</a>
	        	<button type="submit" class="btn btn-primary">Simpan</button>
	        </div>
        </form>
      </div>
    </div>
      
  </div>  
</div>