<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= $title; ?></title>

  <!-- Custom fonts for this template-->
  <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
  <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>

</head>

<body id="page-top">
  <div class="container-fluid">
    <div class="card shadow mb-4">
      <div class="card-header py-3 text-center">
        <h3 class="m-0 font-weight-bold">Data Hasil Perhitungan Electre</h3>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-bordered">
            <thead>
              <tr class="text-center">
                <th width="70">No</th>
                <th>Alternatif</th>
                <th width="100">Total Nilai</th>
                <th width="300">Keterangan</th>
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
              	<tr class="text-center">
              		<th><?php echo $key; ?></th>
              		<td class="text-left"><?php echo "Alternatif".$key; ?></td>
              		<td><?php echo $sum; ?></td>
              		<td> <?= ($sum>0)? '<div>Layak</div>' :'<div>Tidak Layak</div>'; ?> </td>
              	</tr>
              <?php endforeach; ?>
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>

<script>
  $(window).on("load",function () {
    window.print();
  })
</script>

</body>

</html>