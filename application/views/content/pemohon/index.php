<h1 class="h3 mb-4 text-gray-800"> <?= $title; ?></h1>

<div class="row">
  <div class="col-lg-8">
    <?= $this->session->flashdata('msg'); ?>
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Data Pemohon</h6>
        <a href="<?= base_url('tambah-pemohon'); ?>" class="btn btn-sm btn-primary">
          Tambah
        </a>
        
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-bordered">
            <thead>
              <tr>
                <th width="20">Alternatif</th>
                <th width="200">No. KK</th>
                <th>Nama</th>
                <th width="150">Tindakan</th>
              </tr>
            </thead>
            <tbody>
              <?php if(empty($pemohon->result_array())) : ?>
              	<tr>
              		<td class="font-weight-bold text-center py-3" colspan="4">Silahkan masukkan data pemohon!</td>
              	</tr>
              <?php else: foreach ($pemohon->result_array() as $p) : ?>
                <tr>
                  <th><?= $p['no_urut']; ?></th>
                  <td><?= $p['kk']; ?></td>
                  <td><?= $p['nama']; ?></td>
                  <td>
                    <a class="badge badge-primary" href="<?= base_url('pemohon?i='.$p['id']); ?>">
                      Detail
                    </a>
                    <a class="badge badge-success" href="<?= base_url('ubah-pemohon/'.$p['id']); ?>">
                      Edit
                    </a>
                    <a 
                      class="badge badge-danger" 
                      href="<?= base_url('hapus-pemohon?i='.$p['id']); ?>" 
                      onclick="return confirm('Pemohon akan di hapus. Yakin?')"
                    >
                      Delete
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