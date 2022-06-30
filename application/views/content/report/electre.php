<h1 class="h3 mb-4 text-gray-800"> <?= $title; ?></h1>
<?php if ($kosong) { ?>
		TIDAK ADA PEMOHON
<?php } else { ?>

<div class="card shadow mb-4">
  <div class="card-header py-3 d-flex justify-content-between align-items-center">
    <h6 class="m-0 font-weight-bold text-primary">Data Hasil Perhitungan Electre</h6>
    <a href="<?= base_url('report/electre?p='.$periode."&report=true"); ?>" class="btn btn-sm btn-primary" target="_blanl">
      Cetak Data
    </a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-sm table-bordered">
        <thead>
          <tr>
            <th width="10" class="text-center">No</th>
            <th>Alternatif</th>
            <th>Total Nilai</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($report as $key => $value): ?>
          	<?php 
          		$sum = 0;
          		foreach ($value as $k => $v) {
          			if ($v!="-") {
          				$sum+=$v;
          			}
          		}
          	?>
          	<tr>
          		<th class="text-center"><?php echo $key; ?></th>
          		<td><?php echo "Alternatif".$key; ?></td>
          		<td><?php echo $sum; ?></td>
          		<td> <?= ($sum>0)? '<div class="badge badge-primary">Layak</div>' :'<div class="badge badge-danger">Tidak Layak</div>'; ?> </td>
          	</tr>
          <?php endforeach; ?>
        </tbody>
      </table>

    </div>
  </div>
</div>

<?php } ?>