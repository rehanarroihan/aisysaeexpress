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
                        <!-- <div class="custom-checkbox custom-control ml-23">
                          <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                          <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                        </div> -->
                      </th>
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
                      <td class="text-center">
                        <div class="custom-checkbox custom-control">
                          <input
                            type="checkbox"
                            data-checkboxes="mygroup"
                            shipping="<?php echo $shipping->id ?>"
                            resi="<?php echo $shipping->tracking_no ?>"
                            class="custom-control-input"
                            id="checkbox<?php echo $i ?>"
                          >
                          <label for="checkbox<?php echo $i ?>" class="custom-control-label">&nbsp;</label>
                        </div>
                      </td>
                      <td><?php echo $i ?></td>
                      <td><?php echo $shipping->tracking_no ?></td>
                      <td><?php echo $shipping->origin_branch_name ?> (<?php echo $shipping->origin_branch_code ?>)</td>
                      <td><?php echo $shipping->receiver_name ?></td>
                      <td><?php
                        setlocale (LC_TIME, 'INDONESIA');
                        $tanggal = date("D, d M Y", strtotime($shipping->created_at)); 
                        echo $tanggal; 
                      ?></td>
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
                        <a href="<?php echo base_url() ?>dashboard/shipping/print/<?php echo $shipping->id ?>" data-toggle="tooltip" shippingid="<?php echo $shipping->id ?>" title="Print" class="btn btn-link text-info"><i class="fa fa-print"></i></a>
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