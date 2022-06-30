<h1 class="h3 mb-4 text-gray-800"> <?= $title; ?></h1>

<div class="row">
  <div class="col-lg-6">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Form Ubah Kriteria</h6>        
      </div>
      <div class="card-body">
        <form action="<?= base_url('ubah-kriteria?kode='.$kriteria['kode']); ?>" method="post">
        	<input type="text" hidden name="id" value="<?= $kriteria['id']; ?>">
	        <div class="form-group mb-1">
	          <label class="mb-0" class="mb-0">Kode</label>
	            <input type="text" class="form-control form-control-sm" name="kode" value="<?= $kriteria['kode']; ?>" disabled>
              <?php echo form_error('kode'); ?>
	        </div>
	        <div class="form-group mb-1">
	          <label class="mb-0">Nama Kriteria</label>
	          <input type="text" class="form-control form-control-sm" name="nama" value="<?= $kriteria['nama']; ?>">
            <?php echo form_error('nama'); ?>
	        </div>
	        <div class="form-group mb-1">
	          <label class="mb-0">Tipe</label>
	          <select name="tipe" class="form-control form-control-sm">
	            <option selected="">Pilih...</option>
	            <option value="cost" <?php echo set_select('tipe', 'cost'); echo selected($kriteria['tipe'], 'cost'); ?> >Cost</option>
	            <option value="benefit" <?php echo set_select('tipe', 'benefit'); echo selected($kriteria['tipe'], 'benefit'); ?> >Benefit</option>
	          </select>
            <?php echo form_error('tipe'); ?>
	        </div>
	        <div class="form-group mb-1">
	          <label class="mb-0">Bobot</label>
	          <input type="number" step="0.01" class="form-control" name="bobot" value="<?= $kriteria['bobot'];; ?>">
            <?php echo form_error('bobot'); ?>
	        </div>
	        <div class="form-group">
	          <label class="mb-0">Jenis Inputan</label>
	          <select name="jenis" class="form-control form-control-sm" id="jenis_input">
	            <option value="langsung" <?php echo set_select('jenis', 'langsung'); echo ($kriteria['jenis_input'] == 'langsung') ? "selected" : ""; ?>>Input Langsung</option>
	            <option value="pilihan" <?php echo set_select('jenis', 'pilihan'); echo ($kriteria['jenis_input'] == 'pilihan') ? "selected" : ""; ?>>Pilihan</option>
	          </select>
            <?php echo form_error('jenis'); ?>
	        </div>

	        <div id="pilihan" class="<?= $jenis; ?> mt-4" data-toggle="collapse">
	        	<h4 class="text-gray-900">Pilihan Variabel</h4>

	        	<table class="table border-bottom">
	        		<thead class="bg-gradient-success">
	        			<tr class="text-white">
	        				<th>Nama Variabel</th>
                  <th width="90">Nilai</th>
                  <th width="100">Tindakan</th>
	        			</tr>
	        		</thead>
	        		<tbody>
	        			<?php foreach($pilihan as $p): ?>
	        				<tr>
	        					<td>
	        						<input type="text" name="id_pil[]" value="<?= $p['id']; ?>" hidden>
	        						<input type="text" name="variabel[]" class="form-control" value="<?= $p['nama']; ?>">
	        					</td>
	        					<td>
	        						<input type="text" name="nilai[]" class="form-control" value="<?= $p['nilai']; ?>">
	        					</td>
	        					<td class="text-center">
						          <button type="button" class="btn btn-sm btn-danger rmv_var" data-toggle="tooltip" title="Hapus Variabel">
						            <i class="fas fa-trash"></i>
						          </button>
						        </td>
	        				</tr>
	        			<?php endforeach; ?>
	        		</tbody>
	        	</table>
            <div class="form-group text-right">
              <button id="tambah_var" type="button" class="btn btn-sm btn-success">Tambah Variabel</button>
            </div>
	        </div>
	        <div class="form-group">
	        	<a href="<?= base_url('kriteria'); ?>" class="btn btn-secondary">Kembali</a>
	        	<button type="submit" class="btn btn-primary">Simpan</button>
	        </div>
        </form>
      </div>
    </div>
      
  </div>  
</div>


<script type="text/javascript">
	$('#jenis_input').on('change', function () {
    nilai = this.value;
    if (nilai=='pilihan') {
      $('#pilihan').collapse('show');
    } else {
      $('#pilihan').collapse('hide');
    }
  })

  $('#tambah_var').on("click", function () {
    $('#pilihan table tbody').append(`
      <tr>
        <td>
          <input type="text" name="variabel[]" class="form-control form-control-sm">
        </td>
        <td>
          <input type="text" name="nilai[]" class="form-control form-control-sm">
        </td>
        <td class="text-center">
          <button type="button" class="btn btn-sm btn-danger rmv_var" data-toggle="tooltip" title="Hapus Variabel">
            <i class="fas fa-trash"></i>
          </button>
        </td>
      </tr>
    `);
  })

  $('body').on("click", ".rmv_var", function () {
  	var konfirm = confirm('Yakin menghapus data ini?');
  	if (konfirm) {
	    $(this).parent().parent().remove();
  	}
  	return false;
  })
</script>