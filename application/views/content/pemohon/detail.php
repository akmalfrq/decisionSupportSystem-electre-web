<h1 class="h3 mb-4 text-gray-800"> <?= $title; ?></h1>

<div class="row">
  <div class="col-lg-6 col-md-10">
  	<?= $this->session->flashdata('msg'); ?>
  	<div class="card shadow mb-4">
      <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Data Pemohon</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          
        	<form method="post" action="<?php base_url('pemohon'); ?>">
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
	        				<td><?= $pemohon['periode']; ?></td>
	        			</tr>
	        			<tr>
	        				<td>Nomor KK</td>
	        				<td>:</td>
	        				<td><?= $pemohon['kk']; ?></td>
	        			</tr>
	        			<tr>
	        				<td>NIK</td>
	        				<td>:</td>
	        				<td><?= $pemohon['nik']; ?></td>
	        			</tr>
	        			<tr>
	        				<td>Nama</td>
	        				<td>:</td>
	        				<td><?= $pemohon['nama']; ?></td>
	        			</tr>
	        			<tr>
	        				<td>Email</td>
	        				<td>:</td>
	        				<td><?= $pemohon['email']; ?></td>
	        			</tr>
	        			<tr>
	        				<td>No Handphone</td>
	        				<td>:</td>
	        				<td><?= $pemohon['no_hp']; ?></td>
	        			</tr>
	        			<tr>
	        				<td>Alamat</td>
	        				<td>:</td>
	        				<td width="300"><?= $pemohon['alamat']; ?></td>
	        			</tr>
	        		</tbody>
        		</table>		        
		        <a href="<?= base_url('pemohon'); ?>" class="btn btn-secondary">kembali</a>
		      </form>

        </div>
      </div>
    </div>
      
  </div>  
  <div class="col-lg-6 col-md-10">
  	<table class="table table-bordered">
  		<thead class="bg-gradient-info text-white">
  			<tr>
  				<th width="5">No.</th>
  				<th>Kriteria</th>
  				<th>Nilai</th>
  			</tr>
  		</thead>
  		<tbody>
  			<?php foreach($nilaiPemohon as $k => $v): ?>
	  			<tr>
	  				<td><?= $k+1; ?></td>
	  				<td><?= $v['nama']; ?></td>
	  				<td><?= ($v['nilai']) ? $v['nilai'] : 0; ?></td>
	  			</tr>
  			<?php endforeach; ?>
  		</tbody>
  	</table>
  </div>
</div>