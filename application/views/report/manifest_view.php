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
      <h2 class="section-title">Daftar Manifest Tercetak</h2>
      <p class="section-lead">
        Unduh kembali manifest tercetak dari cabang ini</a>.
      </p>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <h4 class="text-muted">Daftar Manifest Tercetak <b>(<?php echo $this->session->userdata('branch_regist') ?>)</b></h4>
              <div class="d-flex">
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="printedManifestList">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Tanggal Dicetak</th>
                      <th>Driver</th>
                      <th>Nopol</th>
                      <th>Tujuan</th>
                      <th>Jumlah Resi</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1;foreach($manifest_data as $manifest): ?>
                    <tr>
                      <td class="text-center"><?php echo $no ?></td>
                      <td><?php echo $this->ms_variable->date($manifest->created_at, true) ?></td>
                      <td><?php echo $manifest->driver ?></td>
                      <td><?php echo $manifest->license_plate_number ?></td>
                      <td><?php echo count(explode(',', $manifest->destination_list)); ?> Tujuan (<?php echo $manifest->destination_list ?>)</td>
                      <td class="text-center"><?php echo count(explode(',', $manifest->tracking_no_list)); ?></td>
                      <td>
                        <a href="<?php echo base_url() ?>assets/generated-manifest/<?php echo $manifest->file_name ?>"target="_blank" data-toggle="tooltip" title="Download PDF" class="btn btn-lg text-danger"><i class="fa fa-file-pdf"></i></a>
                      </td>
                    </tr>
                    <?php $no++;endforeach; ?>
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