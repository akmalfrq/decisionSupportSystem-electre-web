<h1 class="h3 mb-4 text-gray-800"> <?= $title; ?></h1>

<?php if ($kosong) { ?>
		TIDAK ADA PEMOHON
<?php } else { ?>

<div class="card shadow mb-4">
	<a href="#matrixKeputusan" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="f" aria-controls="matrixKeputusan">
  	<h6 class="m-0 font-weight-bold text-primary">Matriks Keputusan</h6>
  </a>
  <div class="collapse show" id="matrixKeputusan">
		<div class="card-body p-1">
			
			<table class="table table-bordered">
				<thead class="text-center">
					<tr>
						<th class="align-middle" rowspan="2">Alternatif</th>
						<th colspan="<?= $kriteria->num_rows(); ?>">Kriteria</th>
					</tr>
					<tr>
						<?php foreach($kriteria->result_array() as $k): ?>
							<th>
								<?= $k['nama']; ?>
							</th>
						<?php endforeach; ?>
					</tr>
				</thead>
				<tbody>
					<?php $urut_prev = ""; ?>
					<?php foreach($pemohon->result_array() as $k => $v): ?>
						<tr>
							<th><?= $v['no_urut']; ?></th>
							<?php foreach($kriteria->result_array() as $krit): ?>
								<td><?= $matrix[$v['id']][$krit['id']]; ?></td>
							<?php endforeach; ?>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
	<a href="#matrixTernormalisasi" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="matrixTernormalisasi">
  	<h6 class="m-0 font-weight-bold text-primary">Ternormalisasi</h6>
  </a>
  <div class="collapse show" id="matrixTernormalisasi">
		<div class="card-body p-1">
			
			<table class="table table-bordered">
				<thead class="text-center">
					<tr>
						<th class="align-middle" rowspan="2">Alternatif</th>
						<th colspan="<?= $kriteria->num_rows(); ?>">Kriteria</th>
					</tr>
					<tr>
						<?php foreach($kriteria->result_array() as $k): ?>
							<th>
								<?= $k['nama']; ?>
							</th>
						<?php endforeach; ?>
					</tr>
				</thead>
				<tbody>
					<?php foreach($pemohon->result_array() as $key=>$p): ?>
						<tr>
							<th><?= $p['no_urut']; ?></th>
							<?php foreach($matrix_r[$p['id']] as $k => $val): ?>
									<?php echo "<td>{$val}</td>"; ?>
							<?php endforeach; ?>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
	<a href="#matrixPembobotan" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="matrixPembobotan">
  	<h6 class="m-0 font-weight-bold text-primary">Pembobotan</h6>
  </a>
  <div class="collapse show" id="matrixPembobotan">
		<div class="card-body p-1">
			
			<table class="table table-bordered">
				<thead class="text-center">
					<tr>
						<th class="align-middle" rowspan="2">Alternatif</th>
						<th colspan="<?= $kriteria->num_rows(); ?>">Kriteria</th>
					</tr>
					<tr>
						<?php foreach($kriteria->result_array() as $k): ?>
							<th>
								<?= $k['nama']; ?>
							</th>
						<?php endforeach; ?>
					</tr>
				</thead>
				<tbody>
					<?php foreach($pemohon->result_array() as $key=>$p): ?>
						<tr>
							<th><?= $p['no_urut']; ?></th>
							<?php foreach($matrix_v[$key+1] as $k => $val): ?>
									<?php echo "<td>{$val}</td>"; ?>
							<?php endforeach; ?>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="card shadow mb-4">
			<a href="#himpunanconcordance" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="himpunanconcordance">
      	<h6 class="m-0 font-weight-bold text-primary">Himpunan Concordance</h6>
      </a>
      <div class="collapse show" id="himpunanconcordance">
				<div class="card-body p-1">
					
					<table class="table table-bordered">
						<thead class="text-center">
							<tr>
								<th>C<small>kl</small></th>
								<th>Himpunan</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($c as $key => $value): ?>
									<?php foreach($value as $k => $val): ?>
								<tr>
									<?php if($key!=$k): ?>
										<th>C<small><?= $key.$k; ?></small></th>
										<td>
											<?php foreach($val as $i => $v){
												echo $v+1;
												if ($i<count($val)-1) {
													echo ",";
												}
											} ?>
										</td>
									<?php endif; ?>
								</tr>
									<?php endforeach; ?>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card shadow mb-4">
			<a href="#himpunandiscordance" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="himpunandiscordance">
      	<h6 class="m-0 font-weight-bold text-primary">Himpunan Discordance</h6>
      </a>
      <div class="collapse show" id="himpunandiscordance">
				<div class="card-body p-1">
					
					<table class="table table-bordered">
						<thead class="text-center">
							<tr>
								<th>D<small>kl</small></th>
								<th>Himpunan</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($d as $key => $value): ?>
									<?php foreach($value as $k => $val): ?>
								<tr>
									<?php if($key!=$k): ?>
										<th>C<small><?= $key.$k; ?></small></th>
										<td>
											<?php foreach($val as $i => $v){
												echo $v+1;
												if ($i<count($val)-1) {
													echo ",";
												}
											} ?>
										</td>
									<?php endif; ?>
								</tr>
									<?php endforeach; ?>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="card shadow mb-4">
			<a href="#matrixconcordance" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="matrixconcordance">
      	<h6 class="m-0 font-weight-bold text-primary">Concordance</h6>
      </a>
      <div class="collapse show" id="matrixconcordance">
				<div class="card-body p-1">
					
					<table class="table table-bordered">
						<thead class="text-center">
							<tr>
								<th colspan="<?= $pemohon->num_rows(); ?>">C</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($matrix_c as $key => $value): ?>
								<tr>
									<?php foreach($value as $k => $val): ?>
										<td><?= $val; ?></td>
									<?php endforeach; ?>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card shadow mb-4">
			<a href="#matrixdiscordance" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="matrixdiscordance">
      	<h6 class="m-0 font-weight-bold text-primary">Discordance</h6>
      </a>
      <div class="collapse show" id="matrixdiscordance">
				<div class="card-body p-1">
					
					<table class="table table-bordered">
						<thead class="text-center">
							<tr>
								<th colspan="<?= $pemohon->num_rows(); ?>">D</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($matrix_d as $key => $value): ?>
								<tr>
									<?php foreach($value as $k => $val): ?>
										<td><?= $val; ?></td>
									<?php endforeach; ?>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="card shadow mb-4">
			<a href="#dominanconcordance" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="dominanconcordance">
      	<h6 class="m-0 font-weight-bold text-primary">Dominan Concordance</h6>
      </a>
      <div class="collapse show" id="dominanconcordance">
				<div class="card-body p-1">
					
					<table class="table table-bordered">
						<thead class="text-center">
							<tr>
								<th colspan="<?= $pemohon->num_rows(); ?>">F</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($matrix_f as $key => $value): ?>
								<tr>
									<?php foreach($value as $k => $val): ?>
										<td><?= $val; ?></td>
									<?php endforeach; ?>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card shadow mb-4">
			<a href="#dominandiscordance" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="dominandiscordance">
      	<h6 class="m-0 font-weight-bold text-primary">Dominan Discordance</h6>
      </a>
      <div class="collapse show" id="dominandiscordance">
				<div class="card-body p-1">
					
					<table class="table table-bordered">
						<thead class="text-center">
							<tr>
								<th colspan="<?= $pemohon->num_rows(); ?>">G</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($matrix_g as $key => $value): ?>
								<tr>
									<?php foreach($value as $k => $val): ?>
										<td><?= $val; ?></td>
									<?php endforeach; ?>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
	<a href="#agregatdominan" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="agregatdominan">
  	<h6 class="m-0 font-weight-bold text-primary">Agregat Dominan Matriks</h6>
  </a>
  <div class="collapse show" id="agregatdominan">
		<div class="card-body p-1">
			
			<table class="table table-bordered">
				<thead class="text-center">
					<tr>
						<th colspan="<?= $pemohon->num_rows(); ?>">E</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($matrix_e as $key => $value): ?>
						<tr>
							<?php foreach($value as $k => $val): ?>
								<td><?= $val; ?></td>
							<?php endforeach; ?>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php } ?>