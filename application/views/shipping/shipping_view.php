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
                <table class="table table-striped" id="shippingTable">
                  <thead>
                    <tr>
                      <th class="text-center">
                        #
                      </th>
                      <th>No Tracking</th>
                      <th>Nama Pengirim</th>
                      <th>Nama Penerima</th>
                      <th>Date</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1;foreach($shipping_data_list as $shipping): ?>
                    <tr>
                      <td><?php echo $i ?></td>
                      <td><?php echo $shipping->tracking_no ?></td>
                      <td><?php echo $shipping->sender_name ?></td>
                      <td><?php echo $shipping->receiver_name ?></td>
                      <td><?php echo $shipping->created_at ?></td>
                      <td class="text-center">
                        <?php
                          $statusTitle = "";
                          $statusBadgeColorClass = "";
                          foreach ($this->shippingStatus as $status) {
                            if ($status['id'] == $shipping->status) {
                              $statusTitle = $status['badge_title'];
                              if ($status['id'] == 1) {
                                $statusBadgeColorClass = "info";
                              } else if ($status['id'] == 2) {
                                $statusBadgeColorClass = "warning";
                              } else if ($status['id'] == 3) {
                                $statusBadgeColorClass = "primary";
                              } else if ($status['id'] == 4) {
                                $statusBadgeColorClass = "success";
                              } else if ($status['id'] == 5) {
                                $statusBadgeColorClass = "danger";
                              }
                              break;
                            }
                          }
                        ?>
                        <span class="badge <?php echo 'badge-'.$statusBadgeColorClass ?>">
                          <?php echo $statusTitle ?>
                        </span>
                      </td>
                      <td>
                        <button data-toggle="tooltip" title="Edit" class="btn btn-link text-success"><i class="fa fa-edit"></i></button>
                        <button data-toggle="tooltip" title="Print" class="btn btn-link text-info"><i class="fa fa-print"></i></button>
                        <button data-toggle="tooltip" title="Hapus" class="btn btn-link text-danger"><i class="fa fa-trash"></i></button>
                      </td>
                    </tr>
                    <?php $i++;endforeach; ?>
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
        <form id="shippingForm">
          <div class="form-group">
            <label>Nomor Tracking / No. Resi</label>
            <input id="trackingNumber" readonly value="SBY-220920001" type="text" class="form-control">
          </div>
          <div class="form-group">
            <label>Status Pengiriman</label>
            <select id="statusSelect" class="form-control">
              <option value="" selected>-- Pilih Status Pengiriman --</option>
              <?php foreach($this->shippingStatus as $status): ?>
                <option value="<?php echo $status['id'] ?>">
                  <?php echo $status['title'] ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <h6 class="text-primary">Detail Pengirim</h6>
              <div class="form-group">
                <label>Nama Pengirim</label>
                <input id="senderName" type="text" class="form-control" required>
                <div class="invalid-feedback">
                  Nama pengirim harus di isi
                </div>
              </div>
              <div class="form-group">
                <label>Alamat Pengirim</label>
                <textarea style="height: 64px" id="senderAddress" type="text" class="form-control" required></textarea>
                <div class="invalid-feedback">
                  Alamat pengirim harus di isi
                </div>
              </div>
              <div class="form-group">
                <label>Nomor Telepon</label>
                <input id="senderPhone" type="text" class="form-control phone-mask" required>
                <div class="invalid-feedback">
                  Nomor telepon pengirim harus di isi
                </div>
              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
              <h6 class="text-primary">Detail Penerima</h6>
              <div class="form-group">
                <label>Nama Penerima</label>
                <input id="receiverName" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label>Alamat Penerima</label>
                <textarea style="height: 64px" id="receiverAddress" type="text" class="form-control"></textarea>
              </div>
              <div class="form-group">
                <label>Nomor Telepon</label>
                <input id="receiverPhone" type="text" class="form-control phone-mask">
              </div>
            </div>
          </div>

          <h6 class="text-primary">Detail Barang</h6>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="form-group">
                <label>Isi Barang</label>
                <input id="stuffContent" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label>Jumlah Colly</label>
                <input id="stuffColly" type="text" class="form-control">
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="form-group">
                <label>Berat</label>
                <input id="stuffWeight" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label>No. Referensi</label>
                <input id="stuffRefNo" type="text" class="form-control">
              </div>
            </div>
          </div>

          <h6 class="text-primary">Detail Pengiriman</h6>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="form-group">
                <label>Pelayanan</label>
                <select id="serviceSelect" class="form-control">
                  <option selected value="">-- Pilih Jenis Pelayanan --</option>
                  <?php foreach($this->shippingType as $type): ?>
                    <option value="<?php echo $type['id'] ?>">
                      <?php echo $type['title'] ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="form-group">
                <label>Moda</label>
                <select id="modeSelect" class="form-control">
                  <option selected value="">-- Pilih Moda --</option>
                  <?php foreach($this->shippingMode as $mode): ?>
                    <option value="<?php echo $mode['id'] ?>">
                      <?php echo $mode['title'] ?>
                    </option>
                  <?php endforeach; ?>
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
                <select id="payment" class="form-control">
                  <option selected value="">-- Pilih Tipe Pembayaran --</option>
                  <?php foreach($this->shippingPaymentType as $paymentType): ?>
                    <option value="<?php echo $paymentType['id'] ?>">
                      <?php echo $paymentType['title'] ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                  Tipe Pembayaran harus di pilih
                </div>
              </div>
            </div>
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
</div> <!-- modal.// -->