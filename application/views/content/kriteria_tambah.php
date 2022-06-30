<h1 class="h3 mb-4 text-gray-800"> <?= $title; ?></h1>

<div class="row">
  <div class="col-lg-6">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Form Tambah Kriteria</h6>        
      </div>
      <div class="card-body">
        <form action="<?= base_url('tambah-kriteria'); ?>" method="post">
	        <div class="form-group mb-1">
	          <label class="mb-0" class="mb-0">Kode</label>
	            <input type="text" class="form-control form-control-sm" name="kode" value="<?= set_value('kode'); ?>">
              <?php echo form_error('kode'); ?>
	        </div>
	        <div class="form-group mb-1">
	          <label class="mb-0">Nama Kriteria</label>
	          <input type="text" class="form-control form-control-sm" name="nama" value="<?= set_value('nama'); ?>">
            <?php echo form_error('nama'); ?>
	        </div>
	        <div class="form-group mb-1">
	          <label class="mb-0">Tipe</label>
	          <select name="tipe" class="form-control form-control-sm">
	            <option selected="">Pilih...</option>
	            <option value="cost">Cost</option>
	            <option value="benefit">Benefit</option>
	          </select>
            <?php echo form_error('tipe'); ?>
	        </div>
	        <div class="form-group mb-1">
	          <label class="mb-0">Bobot</label>
	          <input type="number" step="0.01" class="form-control" name="bobot" value="<?= set_value('bobot'); ?>">
            <?php echo form_error('bobot'); ?>
	        </div>
	        <div class="form-group">
	          <label class="mb-0">Jenis Inputan</label>
	          <select name="jenis" class="form-control form-control-sm" id="jenis_input">
	            <option value="langsung" selected <?php echo set_select('jenis', 'langsung'); ?>>Input Langsung</option>
	            <option value="pilihan" <?php echo set_select('jenis', 'pilihan'); ?>>Pilihan</option>
	          </select>
            <?php echo form_error('jenis'); ?>
	        </div>

	        <div id="pilihan" class="collapse mt-4" data-toggle="collapse">
	        	<h4 class="text-gray-900">Pilihan Variabel</h4>

	        	<table class="table border-bottom">
	        		<thead class="bg-gradient-success">
	        			<tr class="text-white">
	        				<th>Nama Variabel</th>
                  <th width="50">Nilai</th>
                  <th width="100">Tindakan</th>
	        			</tr>
	        		</thead>
	        		<tbody>

	        		</tbody>
	        	</table>
            <div class="form-group text-right">
              <button id="tambah_var" type="button" class="btn btn-sm btn-success">Tambah Variabel</button>
            </div>
	        </div>
	        <div class="form-group">
            <a href="<?= base_url('kriteria'); ?>" class="btn btn-secondary">Batal</a>
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
    $(this).parent().parent().remove();
  })

</script>