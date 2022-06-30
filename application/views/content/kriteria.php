<h1 class="h3 mb-4 text-gray-800"> <?= $title; ?></h1>

<div class="row">
  <div class="col-lg-10">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Data Kriteria</h6>
        <a href="<?= base_url('tambah-kriteria'); ?>" class="btn btn-sm btn-primary">
          Tambah
        </a>
        
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-bordered">
            <thead>
              <tr>
                <th>Kode</th>
                <th>Kriteria</th>
                <th>Tipe</th>
                <th width="100">Bobot</th>
                <th width="150">Cara Penilaian</th>
                <th width="200">Tindakan</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($kriteria != null) : ?>
                <?php foreach ($kriteria as $k) : ?>
                  <tr>
                    <td><?= $k['kode']; ?></td>
                    <td><?= $k['nama']; ?></td>
                    <td><?= ucwords($k['tipe']); ?></td>
                    <td><?= $k['bobot']; ?></td>
                    <td><?= ucwords($k['jenis_input']); ?></td>
                    <td>
                      <?php if($k['jenis_input']=="pilihan") : ?>
                        <a href="#" class="detail badge badge-primary" id="<?= 'var'.$k['kode']; ?>">
                          Variabel
                        </a>
                      <?php endif; ?>
                      <a class="badge badge-success" href="<?= base_url('ubah-kriteria?kode='.$k['kode']); ?>">
                        Edit
                      </a>
                      <a href="<?= base_url('hapus-kriteria?i='.$k['id']); ?>" class="badge badge-danger" onclick="return confirm('Yakin menghapus data ini?')">
                        Delete
                      </a>
                    </td>
                  </tr>
                  <tr class="table-borderless" id="<?= 'view-var'.$k['kode']; ?>" style="display: none;">
                    <td colspan="4">
                      <table class="table table-sm table-borderless">
                        <thead>
                          <tr>
                            <th>Variabel</th>
                            <th>Nilai</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($pilihan as $p) : if ($p['id_kriteria']==$k['id']) : ?>
                            <tr>
                              <td><?= $p['nama']; ?></td>
                              <td><?= $p['nilai']; ?></td>
                            </tr>
                          <?php endif; ?>  
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="6" class="text-center small">Tidak Ada Kriteria Yang Ditambahkan!</td>
                </tr>  
              <?php endif; ?>
            </tbody>
          </table>

        </div>
      </div>
    </div>
      
  </div>  
</div>

<script>
  $('a.detail').on("click", function () {
    const id = "#view-"+$(this).attr("id");

    $(id).toggle();
  })

</script>