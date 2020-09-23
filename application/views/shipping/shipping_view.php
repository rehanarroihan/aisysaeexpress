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
      <h2 class="section-title">Data Pengiriman Barang</h2>
      <p class="section-lead">
        Daftar data pengiriman</a>.
      </p>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <h4 class="text-muted">Daftar Data Pengiriman</h4>
              <button data-toggle="modal" data-target="#modal_create_shipping" class="btn btn-primary" type="button"><i class="fas fa-exchange-alt"></i>&nbsp;Tambah Pengiriman Baru</button>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                  <thead>
                    <tr>
                      <th class="text-center">
                        #
                      </th>
                      <th>No Tracking</th>
                      <th>Agent</th>
                      <th>Nama Pengirim</th>
                      <th>Nama Penerima</th>
                      <th>Date</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    
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

<!-- Modal Create New Shipping Data -->
<div id="modal_create_shipping" class="modal side-modal fixed-left fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-aside side-trx-modal-size" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambahkan Pengiriman Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Nomor Tracking / No. Resi</label>
          <input id="trackingNumber" readonly value="SBY-220920001" type="text" class="form-control" required>
        </div>
        
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-12">
            <h6 class="text-primary">Detail Pengirim</h6>
            <div class="form-group">
              <label>Nama Pengirim</label>
              <input id="senderName" type="text" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Alamat Pengirim</label>
              <textarea style="height: 64px" id="receiverAddress" type="text" class="form-control" required></textarea>
            </div>
            <div class="form-group">
              <label>Nomor Telepon</label>
              <input id="senderPhone" type="text" class="form-control phone-mask" required>
            </div>
          </div>

          <div class="col-lg-6 col-md-6 col-sm-12">
            <h6 class="text-primary">Detail Penerima</h6>
            <div class="form-group">
              <label>Nama Penerima</label>
              <input id="receiverName" type="text" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Alamat Penerima</label>
              <textarea style="height: 64px" id="receiverAddress" type="text" class="form-control" required></textarea>
            </div>
            <div class="form-group">
              <label>Nomor Telepon</label>
              <input id="receiverPhone" type="text" class="form-control phone-mask" required>
            </div>
          </div>
        </div>

        <h6 class="text-primary">Detail Barang</h6>
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
              <label>Isi Barang</label>
              <input id="senderAddress" type="text" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Jumlah Colly</label>
              <input id="collyCount" type="text" class="form-control" required>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
              <label>Berat</label>
              <input id="weight" type="text" class="form-control" required>
            </div>
            <div class="form-group">
              <label>No. Referensi</label>
              <input id="referenceNumber" type="text" class="form-control" required>
            </div>
          </div>
        </div>

        <h6 class="text-primary">Detail Pengiriman</h6>
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
              <label>Pelayanan</label>
              <select id="inputState" class="form-control">
                <option selected>-- Pilih Jenis Pelayanan --</option>
                <option>One Day Service</option>
                <option>Cargo</option>
              </select>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
              <label>Moda</label>
              <select id="inputState" class="form-control">
                <option selected>-- Pilih Moda --</option>
                <option>Trucking</option>
                <option>Kereta</option>
                <option>Pesawat</option>
                <option>Kapal Laut</option>
              </select>
            </div>
          </div>
        </div>

        <h6 class="text-primary">Detail Pembayaran</h6>
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
            <label>Biaya</label>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text">Rp</div>
                </div>
                <input type="text" class="form-control" id="price">
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="form-group">
            <label>Pembayaran</label>
              <select id="inputState" class="form-control">
                <option selected>-- Pilih Pembayaran --</option>
                <option>FBB</option>
                <option>COD</option>
                <option>Cash</option>
              </select>
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