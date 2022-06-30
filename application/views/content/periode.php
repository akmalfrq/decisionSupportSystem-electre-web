<h1 class="h3 mb-4 text-gray-800"> <?= $title; ?></h1>

<div class="row">
  <div class="col-lg-6 col-md-10">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Data Periode</h6>
        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal">
          Tambah
        </button>
        
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm table-bordered">
            <thead>
              <tr>
                <th width="60%">Periode</th>
                <th>Tindakan</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($periode as $p) : ?>
                <tr>
                  <td><?= $p['periode']; ?></td>
                  <td>
                    <div class="badge badge-danger">
                      Delete
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>

        </div>
      </div>
    </div>
      
  </div>  
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Periode</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form method="post" action="<?php base_url('periode'); ?>">
        <div class="form-group">
          <label for="exampleInputEmail1">Periode</label>
          <input type="number" class="form-control" name="periode">
        </div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>