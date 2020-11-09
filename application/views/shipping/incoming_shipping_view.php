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
      <h2 class="section-title">Data Barang Masuk</h2>
      <p class="section-lead">
        Daftar data kiriman barang dari cabang lain ke cabang ini,
        <b><?php echo $this->session->userdata('branch_name') ?>
        (<?php echo $this->session->userdata('branch_regist') ?>)</b>
      </p>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <h4 class="text-muted">Daftar Data Pengiriman Masuk</h4>
              <div class="d-flex">
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="incomingShippingTable">
                  <thead>
                    <tr>
                      <th class="text-center">
                        #
                      </th>
                      <th>No Tracking</th>
                      <th>Cabang Asal</th>
                      <th>Nama Penerima</th>
                      <th>Tanggal Dikirim</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1;foreach($incoming_shipping_list as $shipping): ?>
                    <tr>
                      <td class="text-center"><?php echo $i ?></td>
                      <td><?php echo $shipping->tracking_no ?></td>
                      <td><?php echo $shipping->origin_branch_name ?> (<?php echo $shipping->origin_branch_code ?>)</td>
                      <td><?php echo $shipping->receiver_name ?></td>
                      <td><?php echo $this->ms_variable->date($shipping->created_at); ?></td>
                      <td class="text-center">
                        <span class="badge <?php echo 'badge-'.$this->ms_variable->getShppingStatusTitleAndColor($shipping->status)[1] ?>">
                          <?php echo $this->ms_variable->getShppingStatusTitleAndColor($shipping->status)[0] ?>
                        </span>
                      </td>
                      <td>
                        <button data-toggle="tooltip" shippingId="<?php echo $shipping->id ?>" title="Update Status" class="btn btn-link text-info btnOpenShippingDetail"><i class="fa fa-location-arrow"></i></button>
                        <button data-toggle="tooltip" shippingid="<?php echo $shipping->id ?>" title="Print Surat Jalan" class="btn btn-link text-info printWaybill"><i class="fa fa-print"></i></button>
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

<!-- Modal Print Manifest -->
<div class="modal fade" tabindex="-1" role="dialog" id="updateStatusModal">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailTitle">Detail Pengiriman</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-12">
            <span><b>Nama Pengirim:</b><br><span id="detailSenderName"></span></span><br><br>
            <span><b>Telpon Pengirim:</b><br><span id="detailSenderPhone"></span></span><br><br>
            <span><b>Alamat Pengirim:</b><br><span id="detailSenderAddress"></span></span><br><br>
            <span><b>Cabang Pengirim:</b><br><span id="detailSenderBranch"></span></span><br><br>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12">
          <span><b>Nama Penerima:</b><br><span id="detailReceiverName"></span></span><br><br>
            <span><b>Telpon Penerima:</b><br><span id="detailReceiverPhone"></span></span><br><br>
            <span><b>Alamat Penerima:</b><br><span id="detailReceiverAddress"></span></span><br><br>
            <span><b>Cabang Penerima:</b><br><span id="detailReceiverBranch"></span></span><br><br>
          </div>
        </div>
        <h6 class="text-primary">Update Status</h6>
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
              <label>Status Pengiriman</label>
              <select id="updateStatusSelect" class="form-control">
                <option value="">-- Pilih Status Pengiriman --</option>
              </select>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
              <label>Catatan</label>
              <input type="text" class="form-control" id="updateRemarks">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" id="updateStatusCTA" class="btn btn-info btn-lg btn-block"><i class="fa fa-location-arrow"></i>&nbsp;&nbsp;Update Status</button>
      </div>
    </div>
  </div>
</div>