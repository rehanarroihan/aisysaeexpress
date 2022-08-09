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
      <div class="row">
        <div class="col-6">
          <h2 class="section-title">Data aktifitas armada</h2>
          <p class="section-lead">
            detail informasi armada dan riwayat perjalanan armada
          </p>
        </div>
        <div class="col-6">
          <div class="row">
          <div class="col-6">
            <div class="card card-statistic-1">
              <div class="card-icon bg-primary">
                <i class="fa fa-info text-white"></i>
              </div>
              <div class="card-wrap">
                <div class="card-header">
                  <h4>Status</h4>
                </div>
                <div class="card-body">
                  Perjalanan
                </div>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="card card-statistic-1">
              <div class="card-icon bg-danger">
                <i class="fa fa-road text-white"></i>
              </div>
              <div class="card-wrap">
                <div class="card-header">
                  <h4>Total Km</h4>
                </div>
                <div class="card-body">
                  4,456 Km
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <h4 class="text-muted">Detail Armada</h4>
              <div class="d-flex">
                <button class="btn btn-success ml-2" type="button"><i class="fas fa-edit"></i>&nbsp;Update Detail Armada</button>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-6">
                  <p><b>Merk: &nbsp;</b><span><?php echo $armada_detail->brand ?></span></p>
                  <p><b>Model: &nbsp;</b><span><?php echo $armada_detail->model ?></span></p>
                  <p><b>Plat Nomor: &nbsp;</b><span><?php echo $armada_detail->registration_no ?></span></p>
                  <p><b>Tahun Pembuatan: &nbsp;</b><span><?php echo $armada_detail->manufacture_year ?></span></p>
                  <p><b>Nomor Mesin: &nbsp;</b><span><?php echo $armada_detail->machine_number ?></span></p>
                </div>
                <div class="col-6">
                  <p><b>Didaftarkan ke sistem pada: &nbsp;</b>1 Juli 2022 12:30 WIB</span></p>
                  <p><b>Didaftarkan oleh: &nbsp;</b>Manager Azril</span></p>
                  <p><b>Data terakhir di update pada: &nbsp;</b>1 Juli 2022 12:30 WIB</span></p>
                </div>
              </div>
              <div class="row">
                
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <h4 class="text-muted">Riwayat Perjalanan Armada</h4>
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
                      <th>Waktu Berangkat</th>
                      <th>Origin</th>
                      <th>Waktu Sampai</th>
                      <th>Destination</th>
                      <th>Jumlah Km</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>11 Juli 2022 12.01 WIB</td>
                      <td>Agen Bandung (BDG)</td>
                      <td>-</td>
                      <td>Agen Jakarta (JKT)</td>
                      <td>-</td>
                      <td><button data-toggle="tooltip" title="Download PDF" class="btn btn-sm btn-primary"><i class="fa fa-file-pdf"></i> Unduh Daftar Muat</a></td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>10 Juli 2022 14:31 WIB</td>
                      <td>Agen Surabaya (SBI)</td>
                      <td>11 Juli 2022 07.12 WIB</td>
                      <td>Agen Bandung (BDG)</td>
                      <td>778</td>
                      <td><button data-toggle="tooltip" title="Download PDF" class="btn btn-sm btn-primary"><i class="fa fa-file-pdf"></i> Unduh Daftar Muat</a></td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>9 Juli 2022 14:31 WIB</td>
                      <td>Agen Surabaya (SBY)</td>
                      <td>9 Juli 2022 07.12 WIB</td>
                      <td>Agen Surabaya (SBI)</td>
                      <td>5</td>
                      <td><button data-toggle="tooltip" title="Download PDF" class="btn btn-sm btn-primary"><i class="fa fa-file-pdf"></i> Unduh Daftar Muat</a></td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>8 Juli 2022 06:24 WIB</td>
                      <td>Agen Banyuwangi (BWI)</td>
                      <td>8 Juli 2022 17.12 WIB</td>
                      <td>Agen Surabaya (SBY)</td>
                      <td>309</td>
                      <td><button data-toggle="tooltip" title="Download PDF" class="btn btn-sm btn-primary"><i class="fa fa-file-pdf"></i> Unduh Daftar Muat</a></td>
                    </tr>
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