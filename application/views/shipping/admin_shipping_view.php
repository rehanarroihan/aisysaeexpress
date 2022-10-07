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
        Daftar data pengiriman dari semua cabang
      </p>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <h4 class="text-muted">Daftar Data Pengiriman</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="adminShippingTable">
                  <thead>
                    <tr>
                      <th class="text-center">
                        #
                      </th>
                      <th>No Tracking</th>
                      <th>Nama Pengirim</th>
                      <th>Cabang Tujuan</th>
                      <th>Tanggal Masuk</th>
                      <th>Status</th>
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