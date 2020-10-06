<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?php echo $page_title; ?> &mdash; Aisy Sae Express</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.css" integrity="sha512-0p3K0H3S6Q4bEWZ/WmC94Tgit2ular2/n0ESdfEX8l172YyQj8re1Wu9s/HT9T/T2osUw5Gx/6pAZNk3UKbESw==" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.css" integrity="sha512-rBi1cGvEdd3NmSAQhPWId5Nd6QxE8To4ADjM2a6n0BrqQdisZ/RPUlm0YycDzvNL1HHAh1nKZqI0kSbif+5upQ==" crossorigin="anonymous" />
  <!-- DataTable -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/components.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/custom.css">
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="<?php echo base_url() ?>assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
              <div class="d-sm-none d-lg-inline-block">
                <?php echo $this->session->userdata('full_name') ?>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <div style="text-align: center; margin: 10px 0">
                <p style="font-size: 14px; padding: 0; margin: 0 0 4px 0; line-height: 18px">
                  <?php echo $this->session->userdata('branch_name') ?> (<b><?php echo $this->session->userdata('branch_regist') ?></b>)</p>
                <p style="font-size: 12px; padding: 0; margin: 0; line-height: 14px">
                  <?php echo $this->session->userdata('branch_address') ?>
                </p>
              </div>
              <div class="dropdown-divider"></div>
              <a href="<?php echo base_url() ?>logout" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">Aisy<b>Sae</b>Express</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">ASE</a>
          </div>
          
          <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="<?php if ($this->uri->segment(2) == '') { echo 'active'; } ?>">
              <a class="nav-link" href="<?php echo base_url() ?>dashboard">
                <i class="fas fa-chart-bar"></i> <span>Dashboard</span>
              </a>
            </li>
            <?php if ($this->session->userdata('role') == 1): ?>
            <li class="menu-header">Data Utama</li>
            <li class="<?php if ($this->uri->segment(2) == 'branch') { echo 'active'; } ?>">
              <a class="nav-link" href="<?php echo base_url() ?>dashboard/branch">
                <i class="far fa-building"></i> <span>Cabang</span>
              </a>
            </li>
            <li class="<?php if ($this->uri->segment(2) == 'vehicle') { echo 'active'; } ?>">
              <a class="nav-link" href="<?php echo base_url() ?>dashboard/vehicle">
                <i class="fas fa-car"></i> <span>Kendaraan</span>
              </a>
            </li>
            <li class="menu-header">Monitoring</li>
            <li class="<?php if ($this->uri->segment(2) == 'report') { echo 'active'; } ?>">
              <a class="nav-link" href="<?php echo base_url() ?>dashboard/report">
                <i class="fas fa-scroll"></i> <span>Laporan</span>
              </a>
            </li>
            <?php endif; ?>
            <?php if ($this->session->userdata('role') == 2): ?>
            <li class="menu-header">Data Utama</li>
            <li class="<?php if ($this->uri->segment(2) == 'shipping' && $this->uri->segment(3) == null) { echo 'active'; } ?>">
              <a class="nav-link" href="<?php echo base_url() ?>dashboard/shipping">
                <i class="fas fa-shipping-fast"></i> <span>Pengiriman</span>
              </a>
            </li>
            <li class="<?php if ($this->uri->segment(2) == 'shipping' && $this->uri->segment(3) == 'incoming') { echo 'active'; } ?>">
              <a class="nav-link" href="<?php echo base_url() ?>dashboard/shipping/incoming">
                <i class="fas fa-tasks"></i> <span>Daftar Tugas</span>
              </a>
            </li>
            <li class="menu-header">Laporan</li>
            <li class="<?php if ($this->uri->segment(2) == 'report' && $this->uri->segment(3) == 'manifest') { echo 'active'; } ?>">
              <a class="nav-link" href="<?php echo base_url() ?>dashboard/report/manifest">
                <i class="fas fa-stream"></i> <span>Manifes Tercetak</span>
              </a>
            </li>
            <li class="<?php if ($this->uri->segment(2) == 'report' && $this->uri->segment(3) == 'cash-statement') { echo 'active'; } ?>">
              <a class="nav-link" href="<?php echo base_url() ?>dashboard/report/cash-statement">
                <i class="fas fa-money-bill-alt"></i> <span>Laporan Kas</span>
              </a>
            </li>
            <li class="<?php if ($this->uri->segment(2) == 'report' && $this->uri->segment(3) == 'sales-trx') { echo 'active'; } ?>">
              <a class="nav-link" href="<?php echo base_url() ?>dashboard/report/sales-trx">
                <i class="fas fa-hand-holding-usd"></i> <span>Transaksi Penjualan</span>
              </a>
            </li>
            <?php endif; ?>
          </ul>
        </aside>
      </div>

      <!-- Main Content -->
      <?php $this->load->view($primary_view); ?>
      
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
        </div>
        <div class="footer-right">
          2.3.0
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="<?php echo base_url() ?>assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js" integrity="sha512-lOrm9FgT1LKOJRUXF3tp6QaMorJftUjowOWiDcG5GFZ/q7ukof19V0HKx/GWzXCdt9zYju3/KhBNdCLzK8b90Q==" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js" integrity="sha512-mh+AjlD3nxImTUGisMpHXW03gE6F4WdQyvuFRkjecwuWLwD2yCijw4tKA3NsEFpA1C3neiKhGXPSIGSfCYPMlQ==" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous"></script>
  <!-- DataTable -->
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>

  <!-- Template JS File -->
  <script src="<?php echo base_url() ?>assets/js/scripts.js"></script>
  <script src="<?php echo base_url() ?>assets/js/custom.js"></script>

  <!-- Page Specific JS File -->
  <?php $this->load->view('project_js.php') ?>
</body>
</html>
