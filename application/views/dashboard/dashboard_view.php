<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Dashboard Cabang (<?php echo $this->session->userdata('branch_name') ?>)</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active">
          <a href="<?php echo base_url() ?>dashboard">Dashboard</a>
        </div>
        <div class="breadcrumb-item"></div>
      </div>
    </div>

    <div class="section-body">
      <h6>Data Hari Ini (<?php echo $this->ms_variable->date(Date('Y-m-d')) ?>)</h6>
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
              <i class="far fa-money-bill-alt"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Omset</h4>
              </div>
              <div class="card-body">
                Rp. <?php echo number_format($daily_data->turnover) ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
              <i class="fas fa-exchange-alt"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Transaksi</h4>
              </div>
              <div class="card-body">
                <?php echo number_format($daily_data->trx_count) ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
              <i class="fas fa-dumbbell"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Tonase</h4>
              </div>
              <div class="card-body">
                <?php echo number_format($daily_data->trx_count) ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-success">
              <i class="fas fa-boxes"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Colly</h4>
              </div>
              <div class="card-body">
                <?php echo number_format($daily_data->colly) ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
          <h6>
            Data Bulan
            <div class="dropdown d-inline">
              <a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#" id="orders-month"><?php echo strftime("%B", strtotime(Date('Y-m-d'))) ?></a>
              <ul class="dropdown-menu dropdown-menu-sm">
                <li class="dropdown-title">Select Month</li>
                <li><a href="#" class="dropdown-item">Januari</a></li>
                <li><a href="#" class="dropdown-item">Februari</a></li>
                <li><a href="#" class="dropdown-item">Maret</a></li>
                <li><a href="#" class="dropdown-item">April</a></li>
                <li><a href="#" class="dropdown-item">Mai</a></li>
                <li><a href="#" class="dropdown-item">Juni</a></li>
                <li><a href="#" class="dropdown-item">Juli</a></li>
                <li><a href="#" class="dropdown-item">Agustus</a></li>
                <li><a href="#" class="dropdown-item">September</a></li>
                <li><a href="#" class="dropdown-item">Oktober</a></li>
                <li><a href="#" class="dropdown-item">November</a></li>
                <li><a href="#" class="dropdown-item">Desember</a></li>
              </ul>
            </div>
          </h6>
          <div class="card card-statistic-2">
            <div class="card-stats">
              <div class="card-stats-items mt-4">
                <div class="card-stats-item">
                  <div class="card-stats-item-count">24</div>
                  <div class="card-stats-item-label">Transaksi</div>
                </div>
                <div class="card-stats-item">
                  <div class="card-stats-item-count">12</div>
                  <div class="card-stats-item-label">Tonase</div>
                </div>
                <div class="card-stats-item">
                  <div class="card-stats-item-count">23</div>
                  <div class="card-stats-item-label">Colly</div>
                </div>
              </div>
            </div>
            <div class="card-icon shadow-primary bg-info">
              <i class="fas fa-archive"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Omset</h4>
              </div>
              <div class="card-body">
                Rp.
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12">
          <h6>Tugas Belum Terselesaikan</h6>
          <div class="card">
            <div class="card-header">
              <h4>5 Tugas Belum Terselesaikan</h4>
              <div class="card-header-action">
                <a href="<?php echo base_url() ?>dashboard/shipping" class="btn btn-danger">Lihat <?php echo $unfinished->total ?> Lainnya <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive table-invoice">
                <table class="table table-striped">
                  <tr>
                    <th>Resi</th>
                    <th>Tujuan</th>
                    <th>Tanggal Masuk</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  <?php foreach($unfinished->data as $five): ?>
                  <tr>
                    <td><a href="#"><?php echo $five->tracking_no ?></a></td>
                    <td class="font-weight-600"><?php echo $five->sender_name ?></td>
                    <td><?php echo $five->created_at ?></td>
                    <td><div class="badge badge-warning"><?php echo $five->status ?></div></td>
                    <td>
                      <a href="#" class="btn btn-primary">Detail</a>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>