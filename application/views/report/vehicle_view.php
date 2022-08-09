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
      <h2 class="section-title">Data status aktifitas armada</h2>
      <p class="section-lead">
        Daftar data armada yang siap di gunakan dan yang sedang dalam perjalanan
      </p>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <h4 class="text-muted">Daftar Data Armada</h4>
              <div class="d-flex">
                
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
                      <th>Armada</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1;foreach($armada_list as $vehicle): ?>
                    <tr>
                      <td class="text-center"><?php echo $i ?></td>
                      <td>[<?php echo $vehicle->type ?>]&nbsp;
                        <?php echo $vehicle->brand ?>&nbsp;<?php echo $vehicle->model ?>&nbsp;
                        (<?php echo $vehicle->registration_no ?>)
                      </td>
                      <td>
                        <?php
                          if ($i < 3) {
                            echo 'Standby SBY (Cabang ini)';
                          } else if ($i > 4) {
                            echo 'Standby di cabang SMG';
                          } else {
                            echo 'Perjalanan dari SBI ke JKT';
                          }
                        ?>
                      </td>
                      <td>
                        <a href="<?php echo base_url() ?>dashboard/report/vehicle/<?php echo $vehicle->id ?>" class="btn btn-primary">
                        <i class="fa fa-edit"></i> Detail</a>
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