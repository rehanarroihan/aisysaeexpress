<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><?php echo $page_title; ?></h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active">
          <a href="<?php echo base_url() ?>dashboard">Dashboard</a>
        </div>
        <div class="breadcrumb-item"><?php echo $page_title; ?></div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Data daftar armada</h2>
      <p class="section-lead">
        Daftar data armada yang digunakan untuk angkutan barang
      </p>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <h4 class="text-muted">Daftar Data Armada</h4>
              <div class="d-flex">
                <button id="open_armada_button" class="btn btn-primary ml-2" type="button"><i class="fas fa-exchange-alt"></i>&nbsp;Registrasi Daftar Armada</button>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="armadaTable">
                  <thead>
                    <tr>
                      <th class="text-center">
                        #
                      </th>
                      <th>Plat Nomor</th>
                      <th>Merk</th>
                      <th>Model</th>
                      <th>Tipe</th>
                      <th>Tahun Pembuatan</th>
                      <th>Nomor Mesin</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1;foreach($armada_list as $shipping): ?>
                    <tr>
                      <td class="text-center"><?php echo $i ?></td>
                      <td><?php echo $shipping->registration_no ?></td>
                      <td><?php echo $shipping->brand ?></td>
                      <td><?php echo $shipping->model ?></td>
                      <td><?php echo $shipping->type ?></td>
                      <td><?php echo $shipping->manufacture_year ?></td>
                      <td><?php echo $shipping->machine_number ?></td>
                      <td>
                        <button data-toggle="tooltip" shippingId="<?php echo $shipping->id ?>" title="Edit" class="btn btn-link text-success btnEditShipping"><i class="fa fa-edit"></i></button>
                          <button data-toggle="tooltip" title="Hapus" shippingId="<?php echo $shipping->id ?>" class="btn btn-link text-danger btnDeleteArmada"><i class="fa fa-trash"></i></button>
                      </td>
                    </tr>
                    <?php $i++;endforeach; ?>
                  </tbody>
                </table>
                <div id="waybills" class="print-content"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Modal Create New Armada -->
<div id="modal_create_armada" class="modal side-modal fixed-left fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-aside side-trx-modal-size" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Armada</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="shippingForm">
          <div class="form-group">
            <label>Plat Nomor</label>
            <input id="receiverName" type="text" class="form-control">
          </div>
          <div class="form-group">
            <label>Merk</label>
            <input id="receiverName" type="text" class="form-control">
          </div>
          <div class="form-group">
            <label>Model</label>
            <input id="receiverName" type="text" class="form-control">
          </div>
          <div class="form-group">
            <label>Tipe</label>
            <input id="receiverName" type="text" class="form-control">
          </div>
          <div class="form-group">
            <label>Tahun Pembuatan</label>
            <input id="receiverName" type="text" class="form-control">
          </div>
          <div class="form-group">
            <label>Nomor Mesin</label>
            <input id="receiverName" type="text" class="form-control">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
        <button type="button" id="submitShipping" value="Simpan" class="btn btn-primary">
          <i class="fa fa-save"></i>&nbsp;Simpan
        </button>
      </div>
    </div>
  </div> <!-- modal-bialog .// -->
</div>