<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><?php echo $page_title; ?></h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active">
          <a href="<?php echo base_url() ?>dashboard">Dashboard</a>
        </div>
        <div class="breadcrumb-item">Laporan</div>
        <div class="breadcrumb-item"><?php echo $page_title; ?></div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Laporan Transaksi Penjualan</h2>
      <p class="section-lead">
        Daftar data cabang dan admin dari cabang tersebut</a>.
      </p>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <h4 class="text-muted">Daftar Data Pengiriman</h4>
            </div>
            <div class="card-body">
              <div class="d-flex justify-content-end align-items-center mb-4">
                <h6 class="p-0 m-0">Filter Tanggal</h6>
                <a href="javascript:;" class="btn btn-primary daterange-btn icon-left btn-icon mr-2 ml-2"><i class="fas fa-calendar"></i> Pilih Jangka Waktu</a>
                <p class="text-primary p-0 m-0" id="daterangepreview">
                  <?php if ($this->input->get('startDate') == null && $this->input->get('endDate') == null): ?>
                    (<?php echo date_create(Date('d F Y'))->modify('-29 days')->format('d F Y'); ?> s/d <?php echo Date('d F Y') ?>)
                  <?php else: ?>
                    (<?php echo date_create($this->input->get('startDate'))->format('d F Y') ?> s/d <?php echo date_create($this->input->get('endDate'))->format('d F Y') ?>)
                  <?php endif; ?>
                </p>
              </div>
              <div class="table-responsive">
                <table class="table table-striped" id="transactionReportTable">
                  <thead>
                    <tr>
                      <th rowspan="2">#</th>
                      <th rowspan="2">No Resi</th>
                      <th rowspan="2">Colly</th>
                      <th rowspan="2">Kg</th>
                      <th rowspan="2">Pengirim</th>
                      <th rowspan="2">Penerima</th>
                      <th rowspan="2">Tujuan</th>
                      <th colspan="3" class="text-center">Pembayaran</th>
                    </tr>
                    <tr class="text-center">
                      <th>CASH</th>
                      <th>TAGIHAN</th>
                      <th>COD</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1; foreach ($trxList['shippingList'] as $trx): ?>
                    <tr>
                      <th><?php echo $i ?></th>
                      <th><?php echo $trx->tracking_no ?></th>
                      <th><?php echo $trx->stuff_colly ?></th>
                      <th><?php echo $trx->stuff_weight ?></th>
                      <th><?php echo $trx->sender_name ?></th>
                      <th><?php echo $trx->receiver_name ?></th>
                      <th><?php echo $trx->name ?> (<?php echo $trx->registration_code ?>)</th>
                      <th><?php if ($trx->payment_type == 3) { echo 'Rp. '.number_format($trx->price); } ?></th>
                      <th><?php if ($trx->payment_type == 1) { echo 'Rp. '.number_format($trx->price); } ?></th>
                      <th><?php if ($trx->payment_type == 2) { echo 'Rp. '.number_format($trx->price); } ?></th>
                    </tr>
                    <?php $i++; endforeach; ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="7" rowspan="2" class="text-right"><b>Total Penjualan</b></td>
                      <td class="text-center"><?php echo 'Rp. '.number_format($trxList["totalCashCount"]) ?></td>
                      <td class="text-center"><?php echo 'Rp. '.number_format($trxList["totalInvoiceCount"]) ?></td>
                      <td class="text-center"><?php echo 'Rp. '.number_format($trxList["totalCodCount"]) ?></td>
                    </tr>
                    <tr>
                      <?php $total = (int) $trxList["totalCashCount"] + (int) $trxList["totalCodCount"] + (int) $trxList["totalInvoiceCount"] ?>
                      <td colspan="3" class="text-center">Rp. <?php echo number_format($total) ?></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>