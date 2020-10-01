<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><?php echo $page_title; ?></h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active">
          <a href="<?php echo base_url() ?>dashboard">Dashboard</a>
        </div>
        <div class="breadcrumb-item">Cabang</div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Data Cabang dan Admin Cabang</h2>
      <p class="section-lead">
        Daftar data cabang dan admin dari cabang tersebut</a>.
      </p>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <h4 class="text-muted">Daftar Cabang</h4>
              <button data-toggle="modal" data-target="#modal_create_branch" class="btn btn-primary" type="button"><i class="fa fa-edit"></i> Tambah Cabang Baru</button>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="branchTable">
                  <thead>
                    <tr>
                      <th class="text-center">
                        #
                      </th>
                      <th>Nama Cabang</th>
                      <th>Alamat Cabang</th>
                      <th>Nama Admin</th>
                      <th>Username Admin</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1; foreach($branchList as $item): ?>
                    <tr>
                      <td><?php echo $i ?></td>
                      <td><?php echo $item->name.' ('.$item->registration_code.')' ?></td>
                      <td><?php echo $item->address ?></td>
                      <td><?php echo $item->full_name ?></td>
                      <td><?php echo $item->username ?></td>
                      <td>
                        <button data-toggle="tooltip" title="Edit" class="btn btn-link text-success"><i class="fa fa-edit"></i></button>
                        <button data-toggle="tooltip" title="Hapus" class="btn btn-link text-danger"><i class="fa fa-trash"></i></button>
                      </td>
                    </tr>
                    <?php $i++; endforeach; ?>
                  </tbody>
                </table>
              </div>  
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Modal Create New Branch -->
<div id="modal_create_branch" class="modal side-modal fixed-left fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-aside side-modal-size" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Buat Data Cabang Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
              <label>Nama Cabang</label>
              <input id="branchName" type="text" class="form-control" required>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
              <label>Kode Registrasi Cabang</label>
              <input style="text-transform: uppercase" maxlength="4" id="registrationCode" type="text" class="form-control" required>
              <label class="text-muted">
                <span class="text-danger">*</span> 
                digunakan untuk prefix nomor resi, tidak dapat di sunting kembali
              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Alamat Cabang</label>
          <textarea id="branchAddress" class="form-control" style="height: 80px" required></textarea>
        </div>
        <hr>
        <h6 class="mt-4 mb-3">
          Data Admin Cabang<br>
          <small>Digunakan untuk login ke dashboard cabang</small>
        </h6>
        <div class="form-group">
          <label>Nama Lengkap Admin</label>
          <input id="adminName" class="form-control" required/>
        </div>
        <div class="form-group">
          <label>Username</label>
          <input id="adminUsername" type="text" class="form-control" required/>
        </div>
        <div class="form-group">
          <label>Password</label>
          <div class="input-group" id="show_hide_password">
            <input id="adminPassword" class="form-control" type="password" required>
            <div class="input-group-append">
              <span class="input-group-text">
                <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
              </span>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
        <button type="button" id="submitBranch" value="Simpan" class="btn btn-primary">
          <i class="fa fa-save"></i>&nbsp;Simpan
        </button>
      </div>
    </div>
  </div> <!-- modal-bialog .// -->
</div> <!-- modal.// -->