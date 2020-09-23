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
        <div class="col-12">
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
          <label>Nomor Tracking</label>
          <input id="trackingNumber" readonly value="SBY-220920001" type="text" class="form-control" required>
        </div>
        <div class="row">
          <div class="col-6">
            <h6 class="text-primary">Detail Pengirim</h6>
            <div class="form-group">
              <label>Nama Pengirim</label>
              <input id="senderName" type="text" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Nomor Telepon</label>
              <input id="senderPhone" type="text" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <input id="senderAddress" type="text" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input id="senderPhone" type="text" class="form-control" required>
            </div>
          </div>
          <div class="col-6">
            <h6 class="text-primary">Detail Penerima</h6>
            <div class="form-group">
              <label>Nama Penerima</label>
              <input id="receiverName" type="text" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Nomor Telepon</label>
              <input id="receiverPhone" type="text" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <input id="receiverAddress" type="text" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input id="receiverPhone" type="text" class="form-control" required>
            </div>
          </div>
        </div>
        <h6 class="text-primary">Detail Pengiriman</h6>
        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <label>Jenis Pengiriman</label>
              <select id="inputState" class="form-control">
                <option selected>-- Pilih Jenis Pengiriman --</option>
                <option>One Day Service</option>
                <option>One Cargo</option>
                <option>Carter</option>
              </select>
            </div>
            <div class="form-group">
              <label>Berat</label>
              <input id="senderPhone" type="text" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Isi Barang</label>
              <input id="senderAddress" type="text" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Banyak Colly</label>
              <input id="senderPhone" type="text" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Moda</label>
              <select id="inputState" class="form-control">
                <option selected>-- Pilih Moda --</option>
                <option>Truk</option>
                <option>Kereta</option>
                <option>Kapal Laut</option>
                <option>Pesawat Udara</option>
              </select>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label>Biaya</label>
              <input id="receiverName" type="text" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Pembayaran</label>
              <select id="inputState" class="form-control">
                <option selected>-- Pilih Pembayaran --</option>
                <option>Lunas</option>
                <option>FBB</option>
                <option>Bayar Tujuan</option>
              </select>
            </div>
            <div class="form-group">
              <label>Pengangkut</label>
              <select id="inputState" class="form-control">
                <option selected>-- Pilih Pengangkut --</option>
                <option>Door to Door</option>
                <option>Ambil Kantor Cabang</option>
              </select>
            </div>
            <div class="form-group">
              <label>Asal</label>
              <input id="receiverAddress" readonly value="Surabaya" type="text" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Tujuan</label>
              <input id="receiverPhone" type="text" class="form-control" required>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Komentar / Keterangan</label>
          <textarea id="branchAddress" class="form-control" style="height: 80px" required></textarea>
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