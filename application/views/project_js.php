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
    $("#table-1").dataTable({
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
    shippingFormValidation();

    $("#submitShipping").click(function() {
      submitShipping();
    });

    maskSomeShippingForm();
});

function shippingFormValidation() {
  $('#senderName').addClass('is-invalid');
  $('#senderAddress').addClass('is-invalid');

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

  var shippingData = {
    branch_id: <?php echo $this->session->userdata('branch_id') ?>,
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
    return;
  }
  if (!shippingData.sender_address) {
    $('#senderAddress').focus();
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

      $('#modal_create_shipping').modal('toggle');

      maskSomeShippingForm();
    },
    error: function (jqXhr, textStatus, errorMessage) {
      maskSomeShippingForm();
    }
  });
}
</script>