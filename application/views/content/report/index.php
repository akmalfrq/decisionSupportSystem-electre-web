<h1 class="h3 mb-4 text-gray-800"> <?= $title; ?></h1>

<div class="row">
	<div class="col-lg-5">
		<div class="card shadow mb-4"> 
			<div class="card-header bg-primary p-1">
      </div>
			<div class="card-body">
				<form action="<?= base_url('report'); ?>" method="post">
					<div class="form-group">
						<label>Pilih Periode</label>
						<select name="periode" class="form-control">
							<option value="" selected>Pilih...</option>
							<?php foreach($periode as $p): ?>
								<option value="<?= $p['id']; ?>"><?= $p['periode']; ?></option>
							<?php endforeach; ?>
						</select>
						<?= form_error('periode', '<small class="text-danger">','</small>'); ?>
						
					</div>
					<button type="submit" class="btn btn-primary float-right">Proses</button>
				</form>
			</div>
		</div>
		
	</div>
</div>