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
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
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
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
          <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
            <div class="search-result">
              <div class="search-header">
                Histories
              </div>
              <div class="search-item">
                <a href="#">How to hack NASA using CSS</a>
                <a href="#" class="search-close"><i class="fas fa-times"></i></a>
              </div>
              <div class="search-item">
                <a href="#">Kodinger.com</a>
                <a href="#" class="search-close"><i class="fas fa-times"></i></a>
              </div>
              <div class="search-item">
                <a href="#">#Stisla</a>
                <a href="#" class="search-close"><i class="fas fa-times"></i></a>
              </div>
              <div class="search-header">
                Result
              </div>
              <div class="search-item">
                <a href="#">
                  <img class="mr-3 rounded" width="30" src="<?php echo base_url() ?>assets/img/products/product-3-50.png" alt="product">
                  oPhone S9 Limited Edition
                </a>
              </div>
              <div class="search-item">
                <a href="#">
                  <img class="mr-3 rounded" width="30" src="<?php echo base_url() ?>assets/img/products/product-2-50.png" alt="product">
                  Drone X2 New Gen-7
                </a>
              </div>
              <div class="search-item">
                <a href="#">
                  <img class="mr-3 rounded" width="30" src="<?php echo base_url() ?>assets/img/products/product-1-50.png" alt="product">
                  Headphone Blitz
                </a>
              </div>
              <div class="search-header">
                Projects
              </div>
              <div class="search-item">
                <a href="#">
                  <div class="search-icon bg-danger text-white mr-3">
                    <i class="fas fa-code"></i>
                  </div>
                  Stisla Admin Template
                </a>
              </div>
              <div class="search-item">
                <a href="#">
                  <div class="search-icon bg-primary text-white mr-3">
                    <i class="fas fa-laptop"></i>
                  </div>
                  Create a new Homepage Design
                </a>
              </div>
            </div>
          </div>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Messages
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-message">
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="<?php echo base_url() ?>assets/img/avatar/avatar-1.png" class="rounded-circle">
                    <div class="is-online"></div>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Kusnaedi</b>
                    <p>Hello, Bro!</p>
                    <div class="time">10 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="<?php echo base_url() ?>assets/img/avatar/avatar-2.png" class="rounded-circle">
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Dedik Sugiharto</b>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                    <div class="time">12 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="<?php echo base_url() ?>assets/img/avatar/avatar-3.png" class="rounded-circle">
                    <div class="is-online"></div>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Agung Ardiansyah</b>
                    <p>Sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <div class="time">12 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="<?php echo base_url() ?>assets/img/avatar/avatar-4.png" class="rounded-circle">
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Ardian Rahardiansyah</b>
                    <p>Duis aute irure dolor in reprehenderit in voluptate velit ess</p>
                    <div class="time">16 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="<?php echo base_url() ?>assets/img/avatar/avatar-5.png" class="rounded-circle">
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Alfa Zulkarnain</b>
                    <p>Exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
                    <div class="time">Yesterday</div>
                  </div>
                </a>
              </div>
              <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Notifications
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-icons">
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-icon bg-primary text-white">
                    <i class="fas fa-code"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Template update is available now!
                    <div class="time text-primary">2 Min Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-info text-white">
                    <i class="far fa-user"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>You</b> and <b>Dedik Sugiharto</b> are now friends
                    <div class="time">10 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-success text-white">
                    <i class="fas fa-check"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
                    <div class="time">12 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-danger text-white">
                    <i class="fas fa-exclamation-triangle"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Low disk space. Let's clean it!
                    <div class="time">17 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-info text-white">
                    <i class="fas fa-bell"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Welcome to Stisla template!
                    <div class="time">Yesterday</div>
                  </div>
                </a>
              </div>
              <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li>
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="<?php echo base_url() ?>assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
              <div class="d-sm-none d-lg-inline-block">
                <?php echo $this->session->userdata('full_name') ?>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Logged in 5 min ago</div>
              <a href="features-profile.html" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <a href="features-activities.html" class="dropdown-item has-icon">
                <i class="fas fa-bolt"></i> Activities
              </a>
              <a href="features-settings.html" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Settings
              </a>
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
            <a href="index.html">St</a>
          </div>
          
          <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="<?php if ($this->uri->segment(2) == '') { echo 'active'; } ?>">
              <a class="nav-link" href="<?php echo base_url() ?>dashboard">
                <i class="fas fa-fire"></i> <span>Dashboard</span>
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
            <?php endif; ?>
            <?php if ($this->session->userdata('role') == 2): ?>
            <li class="menu-header">Data Utama</li>
            <li class="<?php if ($this->uri->segment(2) == 'transaction') { echo 'active'; } ?>">
              <a class="nav-link" href="<?php echo base_url() ?>dashboard/transaction">
                <i class="fas fa-exchange-alt"></i> <span>Transaksi</span>
              </a>
            </li>
            <li class="<?php if ($this->uri->segment(2) == 'vehicle') { echo 'active'; } ?>">
              <a class="nav-link" href="<?php echo base_url() ?>dashboard/vehicle">
                <i class="fas fa-car"></i> <span>Kendaraan</span>
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
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

  <!-- Template JS File -->
  <script src="<?php echo base_url() ?>assets/js/scripts.js"></script>
  <script src="<?php echo base_url() ?>assets/js/custom.js"></script>

  <!-- Page Specific JS File -->
  <script>
    $(document).ready(function() {
      $("#show_hide_password a").on('click', function(event) {
          event.preventDefault();
          if ($('#show_hide_password input').attr("type") == "text") {
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
          } else if ($('#show_hide_password input').attr("type") == "password") {
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
          }
      });

      $("#table-1").dataTable({
        "columnDefs": [
          { "sortable": false, "targets": [5] }
        ]
      });

      $("#submitBranch").click(function() {
        submitBranch();
      });


      $("#adminPassword").keypress(function(e) {
        if (e.which == 13) {
          submitBranch();
        }
      });

      $(document.body).on('hide.bs.modal,hidden.bs.modal', function () {
        $('body').css('padding-right','0');
      });

      $('#modal_create_branch').on('show.bs.modal', function (e) {
        e.stopPropagation();
        
        setTimeout(function() {
          $('#modal_create_branch').css('padding-right','0px');
        }, 100);
      }); 
  });

  function submitBranch() {
    const branchName = $("#branchName").val();
    const branchAddress = $("#branchAddress").val();
    const fullName = $("#adminName").val();
    const username = $("#adminUsername").val();
    const password = $("#adminPassword").val();
    
    // NOTE : run validation
    if (!(branchName && branchAddress && fullName && username && password)) {
      new Noty({
        theme: 'metroui',
        type: 'warning',
        text: 'Pastikan semua kolom terisi',
        timeout: 3000
      }).show();
      return;
    }

    $.ajax('<?php echo base_url() ?>dashboard/branch/submit', {
      type: 'POST',
      data: {
        branch_name: branchName, 
        branch_address: branchAddress,
        full_name: fullName,
        username: username,
        password: password
      },
      success: function (data, status, xhr) {
        const res = JSON.parse(data);
        
        if (!res.status) {
          new Noty({
            theme: 'metroui',
            type: 'error',
            text: res.message,
            timeout: 3000
          }).show();
          return;
        }

        new Noty({
          theme: 'metroui',
          type: 'success',
          text: res.message,
          timeout: 3000
        }).show();

        $('#modal_create_branch').modal('toggle');
        
        // INFO : append inserted data to table
        let table = $('#table-1').DataTable();
        console.log(table);
        table.row.add( [
          table.rows().data().length +1,
          res.data.name,
          res.data.address,
          res.data.full_name,
          res.data.username,
          "<a href='#' class='btn btn-success'><i class='fa fa-edit'></i></a>"
        ]).draw( true );
      },
      error: function (jqXhr, textStatus, errorMessage) {
        
      }
    });
  }
  </script>
</body>
</html>
