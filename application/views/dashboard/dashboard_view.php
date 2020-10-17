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
      <h6>Data Hari Ini</h6>
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
              <i class="far fa-user"></i>
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
              <i class="far fa-newspaper"></i>
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
              <i class="far fa-file"></i>
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
              <i class="fas fa-circle"></i>
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

      <h6>Data Bulan Ini</h6>
    </div>
  </section>
</div>