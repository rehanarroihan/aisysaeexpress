<script>
  $(document).ready(function() {
    $(document.body).on('hide.bs.modal,hidden.bs.modal', function () {
      $('body').css('padding-right','0');
    });

    $('.side-modal').on('show.bs.modal', function (e) {
      e.stopPropagation();
      
      setTimeout(function() {
        $('.side-modal').css('padding-right','0px');
      }, 100);
    });

    // ----------- Branch Section ----------- //
    $("#branchTable").dataTable({
      "columnDefs": [
        { "sortable": false, "targets": [5] }
      ]
    });

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

    $("#submitBranch").click(function() {
      submitBranch();
    });


    $("#adminPassword").keypress(function(e) {
      if (e.which == 13) {
        submitBranch();
      }
    });

    // ----------- Shipping Section ----------- //
    $("#shippingTable").dataTable({
      "columnDefs": [
        { "sortable": false, "targets": [6] }
      ]
    });

    shippingFormValidation();

    $("#submitShipping").click(function() {
      submitShipping();
    });

    maskSomeShippingForm();
});

function shippingFormValidation() {
  $('#senderName').addClass('is-invalid');
  $('#senderAddress').addClass('is-invalid');
  $('#payment').addClass('is-invalid');

  $("#senderName").on("change paste keyup", function() {
    if (!$('#senderName').val()) {
      $('#senderName').addClass('is-invalid');
    } else {
      $('#senderName').removeClass('is-invalid');
    }
  });

  $("#senderAddress").on("change paste keyup", function() {
    if (!$('#senderAddress').val()) {
      $('#senderAddress').addClass('is-invalid');
    } else {
      $('#senderAddress').removeClass('is-invalid');
    }
  });

  $("#payment").change(function(){
    if (!$('#payment').val()) {
      $('#payment').addClass('is-invalid');
    } else {
      $('#payment').removeClass('is-invalid');
    }
  });
}

function maskSomeShippingForm() {
  $('#price').mask('000.000.000', {reverse: true});
  $('#senderPhone').mask('0000-0000-0000 000');
  $('#receiverPhone').mask('0000-0000-0000 000');
}

function submitBranch() {
  let branchName = $("#branchName").val();
  let branchAddress = $("#branchAddress").val();
  let fullName = $("#adminName").val();
  let username = $("#adminUsername").val();
  let password = $("#adminPassword").val();
  
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
      let table = $('#branchTable').DataTable();
      table.row.add( [
        table.rows().data().length +1,
        res.data.name,
        res.data.address,
        res.data.full_name,
        res.data.username,
        "<a href='#' class='btn btn-success'><i class='fa fa-edit'></i></a>"
      ]).draw( true );

      $("#branchName").val('');
      $("#branchAddress").val('');
      $("#adminName").val('');
      $("#adminUsername").val('');
      $("#adminPassword").val('');
    },
    error: function (jqXhr, textStatus, errorMessage) {
      
    }
  });
}

function submitShipping() {
  // Unmask some field for a while to get pure input
  $('#price').unmask();
  $('#receiverPhone').unmask();
  $('#senderPhone').unmask();

  var branchId = "<?php echo $this->session->userdata('branch_id') ?>";
  var shippingData = {
    branch_id: branchId,
    tracking_no: $('#trackingNumber').val(),
    status: $('#statusSelect').val(),
    service: $('#serviceSelect').val(),
    mode: $('#modeSelect').val(),
    price: $('#price').val(),
    payment: $('#payment').val(),
    sender_name: $('#senderName').val(),
    sender_address: $('#senderAddress').val(),
    sender_phone: $('#senderPhone').val(),
    receiver_name: $('#receiverName').val(),
    receiver_address: $('#receiverAddress').val(),
    receiver_phone: $('#receiverPhone').val(),
    stuff_content: $('#stuffContent').val(),
    stuff_weight: $('#stuffWeight').val(),
    stuff_colly: $('#stuffColly').val(),
    stuff_reference_no: $('#stuffRefNo').val()
  };

  // Run some validation
  if (!shippingData.sender_name) {
    $('#senderName').focus();
    maskSomeShippingForm();
    return;
  }
  if (!shippingData.sender_address) {
    $('#senderAddress').focus();
    maskSomeShippingForm();
    return;
  }
  if (!shippingData.payment) {
    $('#payment').focus();
    maskSomeShippingForm();
    return;
  }

  $.ajax('<?php echo base_url() ?>dashboard/shipping/submit', {
    type: 'POST',
    data: shippingData,
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

      // INFO : resetting form value
      $('#statusSelect').val(""); $('#serviceSelect').val("");
      $('#modeSelect').val(""); $('#price').val("");
      $('#payment').val(""); $('#senderName').val("");
      $('#senderAddress').val(""); $('#senderPhone').val("");
      $('#receiverName').val(""); $('#receiverAddress').val("");
      $('#receiverPhone').val(""); $('#stuffContent').val("");
      $('#stuffWeight').val(""); $('#stuffColly').val(""); $('#stuffRefNo').val("");

      $('#modal_create_shipping').modal('toggle');

      // INFO : append inserted data to table
      const ss = JSON.stringify(<?php echo json_encode($this->shippingStatus) ?>);
      const shippingStatus = JSON.parse(ss);
      let statusTitle = '';
      let statusBadgeColorClass = ''; 
      shippingStatus.forEach((status) => {
        if (status.id == res.data.status) {
          statusTitle = status.badge_title;
          if (status.id == 1) {
            statusBadgeColorClass = "info";
          } else if (status.id == 2) {
            statusBadgeColorClass = "warning";
          } else if (status.id == 3) {
            statusBadgeColorClass = "primary";
          } else if (status.id == 4) {
            statusBadgeColorClass = "success";
          } else if (status.id == 5) {
            statusBadgeColorClass = "danger";
          }
        }
      });

      let table = $('#shippingTable').DataTable();
      table.row.add([
        table.rows().data().length +1,
        res.data.tracking_no,
        res.data.sender_name,
        res.data.receiver_name,
        res.data.created_at,
        "<span class='badge badge-" + statusBadgeColorClass + "'>" + statusTitle +"</span>",
        "<button data-toggle='tooltip' title='Edit' class='btn btn-link text-success'><i class='fa fa-edit'></i></button><button data-toggle='tooltip' title='Print' class='btn btn-link text-info'><i class='fa fa-print'></i></button><button data-toggle='tooltip' title='Hapus' class='btn btn-link text-danger'><i class='fa fa-trash'></i></button>"
      ]).draw( true );

      maskSomeShippingForm();
    },
    error: function (jqXhr, textStatus, errorMessage) {
      maskSomeShippingForm();
    }
  });
}
</script>