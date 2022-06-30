<h1 class="h3 mb-4 text-gray-800"> <?= $title; ?></h1>


<?= $this->session->flashdata('msg'); ?>
<div class="card shadow mb-4">
  <div class="card-header py-3 d-flex justify-content-between align-items-center">
    <h6 class="m-0 font-weight-bold text-primary">Form Ubah Data Pemohon</h6>
  </div>
  <div class="card-body">
  	<div class="row">
		  <div class="col-md-6">

        <div class="table-responsive">
          
        	<form method="post" action="<?php base_url('ubah-pemohon/'.$pemohon['id']); ?>">
        		<table class="table table-borderless">
        			<thead hidden>
        				<tr>
        					<th width="150"></th>
        					<th width="10"></th>
        					<th></th>
        				</tr>
        			</thead>
	        		<tbody>
	        			<tr>
	        				<td>Periode</td>
	        				<td>:</td>
	        				<td>
	        					<select name="periode" class="form-control form-control-sm">
		      						<option selected value="">Pilih...</option>
		      						<?php foreach($periode as $p): ?>
		      							<option value="<?= $p['id']; ?>" <?= ($pemohon['id_periode']==$p['id']) ? 'selected' : ''; ?>><?= $p['periode']; ?></option>
		      						<?php endforeach; ?>
		      					</select>
		      					<?= form_error('periode'); ?>
	        				</td>
	        			</tr>
	        			<tr>
	        				<td>Nomor KK</td>
	        				<td>:</td>
	        				<td>
	        					<input type="number" class="form-control form-control-sm" name="kk" autocomplete="off" value="<?= $pemohon['kk']; ?>">
	        					<?= form_error('kk'); ?>
	        				</td>
	        			</tr>
	        			<tr>
	        				<td>NIK</td>
	        				<td>:</td>
	        				<td>
	        					<input type="number" class="form-control form-control-sm" name="nik" autocomplete="off" value="<?= $pemohon['nik']; ?>">
	        					<?= form_error('nik'); ?>
	        				</td>
	        			</tr>
	        			<tr>
	        				<td>Nama</td>
	        				<td>:</td>
	        				<td>
					          <input type="text" class="form-control form-control-sm" name="nama" value="<?= $pemohon['nama']; ?>">
					          <?= form_error('nama'); ?>
	        				</td>
	        			</tr>
	        			<tr>
	        				<td>Email</td>
	        				<td>:</td>
	        				<td>
					          <input type="email" class="form-control form-control-sm" name="email" autocomplete="off" value="<?= $pemohon['email']; ?>">
					          <?= form_error('email'); ?>
	        				</td>
	        			</tr>
	        			<tr>
	        				<td>No Handphone</td>
	        				<td>:</td>
	        				<td>
					          <input type="number" class="form-control form-control-sm" name="hp" autocomplete="off" value="<?= $pemohon['no_hp']; ?>">
					          <?= form_error('hp'); ?>
	        				</td>
	        			</tr>
	        			<tr>
	        				<td>Alamat</td>
	        				<td>:</td>
	        				<td>
					          <textarea class="form-control form-control-sm" name="alamat" rows="3"> <?= $pemohon['alamat']; ?></textarea>
					          <?= form_error('alamat'); ?>
	        				</td>
	        			</tr>
	        		</tbody>
        		</table>		        
		        
        </div>

      </div>
      <div class="col-md-6">
      	<h1 class="h4 text-gray-700">Nilai Kriteria</h1>
      	<?php foreach ($kriteriaNilai as $k => $v) : ?>
  			
  				<div class="form-group">
	          <label class="mb-0"><?= $v['nama']; ?></label>
	          	
	          	<?php if($v['jenis_input']=='pilihan') : ?>

			          <select name="nilai[<?= $v['id_nilai']; ?>]" class="form-control form-control-sm">
				          <option selected>Pilih...</option>

				          <?php foreach($pilihan as $p): ?>
				          	<?php if($p['id_kriteria']==$v['id']): ?>
				          		<option value="<?= $p['nilai']; ?>" <?= ($p['nilai']==$v['nilai']) ? 'selected' : '' ; ?>><?= $p['nama']; ?></option>
				          	<?php endif; ?>
			          	<?php endforeach; ?>
			          </select>

			        <?php else: ?>  
			        	<input type="number" step="0.001" name="nilai[<?= $v['id_nilai']; ?>]" class="form-control form-control-sm" value="<?= $v['nilai']; ?>">
		          <?php endif; ?>

	        </div>

  			<?php endforeach; ?>
      </div>

    </div>
    <div class="float-right">
	    <a href="<?= base_url('pemohon'); ?>" class="btn btn-secondary">Batal</a>
	    <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
  </form>
      
  </div>  
</div>