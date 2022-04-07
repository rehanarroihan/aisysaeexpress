<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Tracking Resi</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/components.css">

  <style>
    ul.timeline {
      list-style-type: none;
      position: relative;
    }
    ul.timeline:before {
      content: ' ';
      background: #d4d9df;
      display: inline-block;
      position: absolute;
      left: 29px;
      width: 2px;
      height: 100%;
      z-index: 400;
    }
    ul.timeline > li {
      margin: 20px 0;
      padding-left: 20px;
    }
    ul.timeline > li:before {
      content: ' ';
      background: white;
      display: inline-block;
      position: absolute;
      border-radius: 50%;
      border: 3px solid #22c0e8;
      left: 20px;
      width: 20px;
      height: 20px;
      z-index: 400;
    }
  </style>
</head>

<body style="background-color: white">
  <div id="app">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-12 col-sm-12">
          <img src="https://aisysaeexpress.com/wp-content/uploads/2020/08/Logo-Banner-768x295.jpg" alt="" height="120px" class="mt-2" srcset="">
        </div>
        <div class="col-lg-8 col-md-12 col-sm-12">
          <div class="form-group">
            <label>Nomor Resi</label>
            <input id="trackingNumber" type="text" class="form-control" placeholder="Masukkan 12 Digit Nomor Resi (Contoh: SUB-20157213)">
          </div>
          <button class="btn btn-info btn-block" id="btnCekResi"><i class="fa fa-location-arrow"></i>&nbsp;&nbsp;Cek Resi</button>
        </div>
      </div>
    </div>
    <div class="container mt-5 mb-5" id="emptySection" style="display:none">
      <div class="text-center mt-4 mb-4">
        <h4>Resi Tidak di Temukan</h4>
      </div>
    </div>
    <div class="container mt-5 mb-5" id="resultSection" style="display:none">
      <div class="row">
        <div class="col-lg-4 col-md-12 col-sm-12 text-right">
          <h4 class="mb-4">Keterangan Paket</h4>
          <div>
            <h6>Kota Asal</h6>
            <p id="originBranch"></p>
          </div>
          <div>
            <h6>Cabang Tujuan</h6>
            <p id="destBranch"></p>
          </div>
          <div>
            <h6>Pengirim</h6>
            <p>
              <span id="senderName"></span> <br>
              <span id="senderAddress"></span> <br>
              <span id="senderPhone"></span>
            </p>
          </div>
          <div>
            <h6>Penerima</h6>
            <p>
              <span id="receiverName"></span> <br>
              <span id="receiverAddress"></span> <br>
              <span id="receiverPhone"></span>
            </p>
          </div>
        </div>
        <div class="col-lg-8 col-md-12 col-sm-12">
          <h4>Status Terakhir</h4>
          <ul class="timeline" id="timeline"></ul>
        </div>
      </div>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.min.js" integrity="sha512-he8U4ic6kf3kustvJfiERUpojM8barHoz0WYpAUDWQVn61efpm3aVAD8RWL8OloaDDzMZ1gZiubF9OSdYBqHfQ==" crossorigin="anonymous"></script>
  <script src="<?php echo base_url() ?>assets/js/stisla.js"></script>

  <!-- JS Libraies -->

  <!-- Template JS File -->
  <script src="<?php echo base_url() ?>assets/js/scripts.js"></script>
  <script src="<?php echo base_url() ?>assets/js/custom.js"></script>

  <!-- Page Specific JS File -->
  <script>
    $(document).ready(function() {
      $("#btnCekResi").click(function() {
        if (!$("#trackingNumber").val()) {
          return;
        }

        $("#resultSection").hide();
        $("#emptySection").hide();

        $("#btnCekResi").addClass('disabled btn-progress');
        $.ajax('<?php echo base_url() ?>tracking/check', {
          type: 'POST',
          data: { tracking_no: $("#trackingNumber").val() },
          success: function (data, status, xhr) {
            $("#btnCekResi").removeClass('disabled btn-progress');

            const res = JSON.parse(data);
            
            if (!res.status) {
              $("#resultSection").hide();
              $("#emptySection").show();
              return;
            }

            $("#resultSection").show();
            $("#emptySection").hide();

            $("#originBranch").html(res.data.origin_branch);
            $("#destBranch").html(res.data.destination_branch);
            $("#senderName").html(res.data.sender_name);
            $("#senderAddress").html(res.data.sender_address);
            $("#senderPhone").html(res.data.sender_phone);
            $("#receiverName").html(res.data.receiver_name);
            $("#receiverAddress").html(res.data.receiver_address);
            $("#receiverPhone").html(res.data.receiver_phone);

            // Populating histories
            $("#timeline").empty();
            var statusList = <?php echo json_encode($this->ms_variable->shippingStatusList()) ?>;
            res.data.history.reverse();
            for (var milestone of res.data.history) {
              moment.locale('id');
              var date = moment(milestone.created_at).locale('id').format('dddd, DD MMMM YYYY, [Pukul] HH:mm');
              var status = "";
              for (var stats of statusList) {
                if (stats.id == milestone.status_id) {
                  status = stats.title;
                }
              }
              $("#timeline").append("<li><a target='_blank'>"+status+"</a><a href='#' class='float-right'>"+date+"</a><p>"+milestone.remarks+"</p></li>");
            }
          },
          error: function (jqXhr, textStatus, errorMessage) {
            $("#resultSection").hide();
            $("#emptySection").show();
          }
        });
      });
    });
  </script>
</body>
</html>