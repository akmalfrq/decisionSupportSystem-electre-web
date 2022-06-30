<h1 class="h3 mb-4 text-gray-800"> <?= $title; ?></h1>

<div class="row">
  <div class="col-lg-7 col-md-10">
  	<?php if (validation_errors()) : ?>
	  	<div class="alert alert-danger alert-dismissible fade show" role="alert">
	  		<?= validation_errors('<div class="mb-0">','</div>'); ?>
	  		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	  			<span aria-hidden="true">&times;</span>
	  		</button>
	  	</div>
  	
  	<?php endif; ?>

    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Data Pegawai</h6>
        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal">
          Tambah
        </button>
        
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-bordered">
            <thead>
              <tr>
                <th width="150">NIP</th>
                <th>Nama</th>
                <th width="100">Status</th>
                <th width="150">Tindakan</th>
              </tr>
            </thead>
            <tbody>
              <?php if(empty($pegawai)) : ?>
              	<tr>
              		<td class="font-weight-bold text-center py-3" colspan="4">Data Pegawai Belum Ada!</td>
              	</tr>
              <?php else:
               foreach ($pegawai as $p) : 
               	?>
                <tr>
                  <td><?= $p['no_id']; ?></td>
                  <td><?= $p['nama']; ?></td>
                  <td>
                    <?php 
                      if ($p['is_active']==0) {
                        echo 'Tidak Aktif';
                      } else {
                        echo 'Aktif';
                      }
                    ?>
                  </td>
                  <td>
                    <a class="badge badge-success" href="<?= base_url('ubah-pegawai?nip='.$p['no_id']); ?>">
                      Edit
                    </a>
                      <?php 
                        if ($p['is_active']==0) {
                          $badge = 'success';
                          $konf = 'aktifkan';
                          $btn = 'Aktifkan';
                        } else {
                          $badge = 'danger';
                          $konf = 'non-aktifkan';
                          $btn = 'Nonaktifkan';
                        }
                      ?>
                      <a class="badge badge-<?= $badge; ?>" href="<?= base_url('ubah-status-pegawai?i='.$p['id'].'&s='.$p['is_active']); ?>" onclick="return confirm('User akan di <?= $konf; ?>. Yakin?')">
                        <?= $btn; ?>
                      </a>

                    
                  </td>
                </tr>
              <?php
               endforeach;
             	endif;
                ?>
            </tbody>
          </table>

        </div>
      </div>
    </div>
      
  </div>  
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Pegawai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form method="post" action="<?php base_url('pegawai'); ?>">
        <div class="form-group">
          <label>NIP</label>
          <input type="number" class="form-control" name="nip" autocomplete="off">
        </div>
        <div class="form-group">
          <label>Nama</label>
          <input type="text" class="form-control" name="nama">
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" class="form-control" name="email" autocomplete="off">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>