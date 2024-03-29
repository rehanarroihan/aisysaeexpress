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
        Daftar data pengiriman dari cabang
        <b><?php echo $this->session->userdata('branch_name') ?>
        (<?php echo $this->session->userdata('branch_regist') ?>)</b>
      </p>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <h4 class="text-muted">Daftar Data Pengiriman</h4>
              <div class="d-flex">
                <button id="printManifestButton" class="btn btn-warning" type="button"><i class="fas fa-tag"></i>&nbsp;Cetak Manifest</button>
                <button id="open_shipping_button" class="btn btn-primary ml-2" type="button"><i class="fas fa-exchange-alt"></i>&nbsp;Tambah Pengiriman Baru</button>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="shippingTable">
                  <thead>
                    <tr>
                      <th class="text-center">
                        #
                      </th>
                      <th width="12%">No Tracking</th>
                      <th>Nama Pengirim</th>
                      <th>Cabang Tujuan</th>
                      <th>Tanggal Masuk</th>
                      <th>Status</th>
                      <th style="display:none">statusid</th>
                      <th style="display:none">shippingid</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1;foreach($shipping_data_list as $shipping): ?>
                    <tr>
                      <td><?php echo $i ?></td>
                      <td><?php echo $shipping->tracking_no ?></td>
                      <td><?php echo $shipping->sender_name ?></td>
                      <td><?php echo $shipping->dest_branch_name ?> (<?php echo $shipping->dest_branch_code ?>)</td>
                      <td><?php echo $this->ms_variable->date($shipping->created_at) ?></td>
                      <td class="text-center">
                        <span class="badge <?php echo 'badge-'.$this->ms_variable->getShppingStatusTitleAndColor($shipping->status)[1] ?>">
                          <?php echo $this->ms_variable->getShppingStatusTitleAndColor($shipping->status)[0] ?>
                        </span>
                      </td>
                      <td style="display:none"><?php echo $shipping->status ?></td>
                      <td style="display:none"><?php echo $shipping->id ?></td>
                      <td>
                        <button data-toggle="tooltip" shippingid="<?php echo $shipping->id ?>" title="Print Surat Jalan" class="btn btn-link text-info printWaybill"><i class="fa fa-print"></i></button>
                        <!-- <a href="<?php echo base_url() ?>shipping/printwb/<?php echo $shipping->id ?>" title="Print Surat Jalan" class="btn btn-link text-info"><i class="fa fa-print"></i></a> -->
                        <?php if ($shipping->status == 1): ?>
                          <button data-toggle="tooltip" shippingId="<?php echo $shipping->id ?>" title="Edit" class="btn btn-link text-success btnEditShipping"><i class="fa fa-edit"></i></button>
                          <button data-toggle="tooltip" title="Hapus" shippingId="<?php echo $shipping->id ?>" class="btn btn-link text-danger btnDeleteShipping"><i class="fa fa-trash"></i></button>
                        <?php endif; ?>
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

          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="form-group">
                <label>Cabang Tujuan</label>
                <select id="destBranchSelect" class="form-control">
                  <option value="" selected>-- Pilih Cabang Tujuan --</option>
                  <?php foreach($dest_branch_list as $branch): ?>
                    <option value="<?php echo $branch->id ?>">
                      <?php echo $branch->name ?> (<?php echo $branch->registration_code ?>)
                    </option>
                  <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                  Cabang Tujuan harus di pilih
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="form-group">
                <label>Status Pengiriman</label>
                <select id="statusSelect" class="form-control" readonly>
                  <option value="" disabled>-- Pilih Status Pengiriman --</option>
                  <?php foreach($this->ms_variable->shippingStatusList() as $status): ?>
                    <?php if ($status['id'] == 1): ?>
                      <option value="<?php echo $status['id'] ?>" selected>
                        <?php echo $status['title'] ?>
                      </option>
                    <?php else: ?>
                      <option value="<?php echo $status['id'] ?>" disabled>
                        <?php echo $status['title'] ?>
                      </option>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
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
                <div class="input-group">
                  <input id="stuffColly" type="text" class="form-control text-right">
                  <div class="input-group-append">
                    <div class="input-group-text">Koli</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="form-group">
                <label>Berat</label>
                <div class="input-group">
                  <input id="stuffWeight" type="text" class="form-control text-right">
                  <div class="input-group-append">
                    <div class="input-group-text">Kg</div>
                  </div>
                </div>
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
                  <?php foreach($this->ms_variable->shippingType as $type): ?>
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
                  <?php foreach($this->ms_variable->shippingMode as $mode): ?>
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
                  <?php foreach($this->ms_variable->shippingPaymentType as $paymentType): ?>
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
</div>

<!-- Modal Edit Shipping Data -->
<div id="modal_edit_shipping" class="modal side-modal fixed-left fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-aside side-trx-modal-size" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Data Pengiriman</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="shippingEditForm">
          <div class="form-group">
            <label>Nomor Tracking / No. Resi</label>
            <input id="editTrackingNumber" readonly type="text" class="form-control">
          </div>

          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="form-group">
                <label>Cabang Tujuan</label>
                <select id="editDestBranchSelect" class="form-control">
                  <option value="" selected>-- Pilih Cabang Tujuan --</option>
                  <?php foreach($dest_branch_list as $branch): ?>
                    <option value="<?php echo $branch->id ?>">
                      <?php echo $branch->name ?> (<?php echo $branch->registration_code ?>)
                    </option>
                  <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                  Cabang Tujuan harus di pilih
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="form-group">
                <label>Status Pengiriman</label>
                <select id="editStatusSelect" class="form-control" readonly>
                  <option value="" disabled>-- Pilih Status Pengiriman --</option>
                  <?php foreach($this->ms_variable->shippingStatusList() as $status): ?>
                    <?php if ($status['id'] == 1): ?>
                      <option value="<?php echo $status['id'] ?>" selected>
                        <?php echo $status['title'] ?>
                      </option>
                    <?php else: ?>
                      <option value="<?php echo $status['id'] ?>" disabled>
                        <?php echo $status['title'] ?>
                      </option>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <h6 class="text-primary">Detail Pengirim</h6>
              <div class="form-group">
                <label>Nama Pengirim</label>
                <input id="editSenderName" type="text" class="form-control" required>
                <div class="invalid-feedback">
                  Nama pengirim harus di isi
                </div>
              </div>
              <div class="form-group">
                <label>Alamat Pengirim</label>
                <textarea style="height: 64px" id="editSenderAddress" type="text" class="form-control" required></textarea>
                <div class="invalid-feedback">
                  Alamat pengirim harus di isi
                </div>
              </div>
              <div class="form-group">
                <label>Nomor Telepon</label>
                <input id="editSenderPhone" type="text" class="form-control phone-mask" required>
                <div class="invalid-feedback">
                  Nomor telepon pengirim harus di isi
                </div>
              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
              <h6 class="text-primary">Detail Penerima</h6>
              <div class="form-group">
                <label>Nama Penerima</label>
                <input id="editReceiverName" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label>Alamat Penerima</label>
                <textarea style="height: 64px" id="editReceiverAddress" type="text" class="form-control"></textarea>
              </div>
              <div class="form-group">
                <label>Nomor Telepon</label>
                <input id="editReceiverPhone" type="text" class="form-control phone-mask">
              </div>
            </div>
          </div>

          <h6 class="text-primary">Detail Barang</h6>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="form-group">
                <label>Isi Barang</label>
                <input id="editStuffContent" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label>Jumlah Colly</label>
                <div class="input-group">
                  <input id="editStuffColly" type="text" class="form-control text-right">
                  <div class="input-group-append">
                    <div class="input-group-text">Koli</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="form-group">
                <label>Berat</label>
                <div class="input-group">
                  <input id="editStuffWeight" type="text" class="form-control text-right">
                  <div class="input-group-append">
                    <div class="input-group-text">Kg</div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>No. Referensi</label>
                <input id="editStuffRefNo" type="text" class="form-control">
              </div>
            </div>
          </div>

          <h6 class="text-primary">Detail Pengiriman</h6>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="form-group">
                <label>Pelayanan</label>
                <select id="editServiceSelect" class="form-control">
                  <option selected value="">-- Pilih Jenis Pelayanan --</option>
                  <?php foreach($this->ms_variable->shippingType as $type): ?>
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
                <select id="editModeSelect" class="form-control">
                  <option selected value="">-- Pilih Moda --</option>
                  <?php foreach($this->ms_variable->shippingMode as $mode): ?>
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
                  <input type="text" class="form-control" id="editPrice">
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
              <label>Pembayaran</label>
                <select id="editPayment" class="form-control">
                  <option selected value="">-- Pilih Tipe Pembayaran --</option>
                  <?php foreach($this->ms_variable->shippingPaymentType as $paymentType): ?>
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
        <button type="button" id="submitEditShipping" value="Simpan" class="btn btn-primary">
          <i class="fa fa-save"></i>&nbsp;Simpan
        </button>
      </div>
    </div>
  </div> <!-- modal-bialog .// -->
</div>

<!-- Modal Print Manifest -->
<div class="modal fade" tabindex="-1" role="dialog" id="manifestDetailDialogModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="printManifestTitle">Cetak Manifes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <input type="text" id="driverInput" class="form-control" placeholder="Supir & Kernet">
        </div>
        <div class="form-group">
          <input type="text" id="nopolInput" class="form-control" placeholder="Nopol">
        </div>
        
        <p>Dengan menekan tombol cetak, maka <span id="dataCount"></span> resi terpilih akan di ubah statusnya menjadi <span class="text-info">Perjalanan ke Kota Tujuan</span></p>
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" id="goPrintManifestButton" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</button>
      </div>
    </div>
  </div>
</div>