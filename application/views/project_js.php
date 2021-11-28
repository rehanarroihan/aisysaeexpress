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

    // ----------- Manager Dashboard Section ---------//
    $('#managerBranchOptions').on('change', function(e) {
      window.location.replace('<?php echo base_url() ?>dashboard?branch='+$(this).val());
    });

    // ----------- Dashboard Section ----------- //
    $(".month").on('click', async function(event)  {
      $("#orders-month").html($(this).attr("monthName"));
      
      try {
        $(".loader").show();
        $(".monthlyValue").hide();

        const result = await getMonthlyDashboardData($(this).attr("monthId"));
        $(".loader").hide();
        $(".monthlyValue").show();

        $("#monthlyTrx").html(result.data.trx_count);
        $("#monthlyTonase").html(result.data.tonnage);
        $("#monthlyColly").html(result.data.colly);
        
        $("#monthlyTurnover").html(currencyIDR(result.data.turnover));
      } catch (e) {
        console.log(e);
      }
    });

    // ----------- Branch Section ----------- //
    $("#branchTable").dataTable({
      "columnDefs": [
        { "sortable": false, "targets": [5] }
      ],
      "language": {
        "emptyTable": "Belum ada data cabang"
      }
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
    var shippingTable = $("#shippingTable").DataTable({
      responsive: true,
      "columnDefs": [
        { "sortable": false, "targets": [0, 8] },
        {
          'targets': 0,
          'checkboxes': {
            'selectRow': true
          }
        }
      ],
      'select': {
        'style': 'multi',
        'selector': 'td:not(:last-child)'
      },
      "language": {
        "emptyTable": "Belum ada data pengiriman dari cabang <?php echo $this->session->userdata('branch_name') ?> (<?php echo $this->session->userdata('branch_regist') ?>)"
      },
    });

    $("#adminShippingTable").dataTable({
      responsive: true,
      "language": {
        "emptyTable": "Belum ada data pengiriman dari cabang manapun"
      }
    });

    $("#incomingShippingTable").dataTable({
      responsive: true,
      "columnDefs": [
        { "sortable": false, "targets": [0, 6] },
      ],
      "language": {
        "emptyTable": "Belum ada pengiriman ke cabang <?php echo $this->session->userdata('branch_name') ?> (<?php echo $this->session->userdata('branch_regist') ?>)"
      }
    });

    $("#open_shipping_button").click(function() {
      Swal.fire({
        title: 'Silahkan Tunggu',
        html: 'sedang membuat nomor resi baru...',
        willOpen: async () => {
          Swal.showLoading();
          try {
            const tracking_no = await generateResi();
            $('#trackingNumber').val(tracking_no);
            Swal.close();
            $("#modal_create_shipping").modal('toggle');
          } catch (e) {
            Swal.close();
          }
        },
      }).then((result) => {
        
      });
    });

    $("#shippingTable tbody").on("click", "tr .printWaybill", function() {
      Swal.fire({
        title: 'Silahkan Tunggu',
        html: 'Memuat detail pengiriman',
        willOpen: async () => {
          Swal.showLoading();
          $.ajax('<?php echo base_url() ?>dashboard/shipping/print/'+$(this).attr("shippingId"), {
            type: 'GET',
            success: function (data, status, xhr) {
              Swal.close();
              $('#waybills').empty();
              $(data).appendTo('#waybills');
              printJS({
                printable: "waybills",
                type: 'html'
              });
              $('#waybills').empty();
            },
            error: function (jqXhr, textStatus, errorMessage) {
              Swal.close();
            }
          });
          
        },
      }).then((result) => {
        
      })
    });

    var willUpdateShippingId = "";
    var updateStatusTo = "";
    $("#incomingShippingTable tbody").on("click", "tr .btnOpenShippingDetail", function() {
      var shippingId = $(this).attr("shippingId");
      willUpdateShippingId = shippingId;

      Swal.fire({
        title: 'Silahkan Tunggu',
        html: 'Memuat detail pengiriman',
        willOpen: async () => {
          Swal.showLoading();
          const res = await getShippingDetailById(shippingId);
          Swal.close();

          $('#detailTitle').html("Detail Pengiriman (" + res.data.tracking_no + ")");
        
          $('#detailSenderName').html(res.data.sender_name);
          $('#detailSenderPhone').html(res.data.sender_phone);
          $('#detailSenderAddress').html(res.data.sender_address);
          $('#detailSenderBranch').html(res.data.origin_branch + " ("+res.data.origin_branch_code+")");

          $('#detailReceiverName').html(res.data.receiver_name);
          $('#detailReceiverPhone').html(res.data.receiver_phone);
          $('#detailReceiverAddress').html(res.data.receiver_address);
          $('#detailReceiverBranch').html(res.data.destination_branch + " ("+res.data.destination_branch_code+")");

          var dropdown = $("#updateStatusSelect");
          statusList = <?php echo json_encode($this->ms_variable->shippingStatus) ?>;
          // Clearing previos options 
          $("#updateStatusSelect option").each(function() {
            if ( $(this).val() != "" ) {
              $(this).remove();
            }
          });
          
          if (res.data.status == "3") {
            // if transit, then show "Perjalanan"
            dropdown.append($("<option />").val("2").text("Perjalanan ke Kota Tujuan"));
          }
          $.each(statusList, function() {
            // Insert status that can be use for update status

            if (this.id > res.data.status)
              dropdown.append($("<option />").val(this.id).text(this.title));
          });

          $("#updateStatusCTA").prop('disabled', true);
          $("#updateStatusCTA").removeClass('btn-info');
          $("#updateStatusCTA").addClass('btn-secondary');
          $("#updateStatusCTA").html("<i class='fa fa-location-arrow'></i>&nbsp;&nbsp;Update Status");

          dropdown.change(function(val) {
            if ($('#updateStatusSelect option:selected').val() != "") {
              updateStatusTo = $('#updateStatusSelect option:selected').val();
              $("#updateStatusCTA").prop('disabled', false);

              $("#updateStatusCTA").removeClass('btn-secondary');
              $("#updateStatusCTA").addClass('btn-info');
              $("#updateStatusCTA").html("<i class='fa fa-location-arrow'></i>&nbsp;&nbsp;Update Status Menjadi <b>"+$('#updateStatusSelect option:selected').html()+"</b>");

              return;
            }
            // Disble button due to unselected status
            $("#updateStatusCTA").removeClass('btn-info');
            $("#updateStatusCTA").addClass('btn-secondary');
            $("#updateStatusCTA").html("<i class='fa fa-location-arrow'></i>&nbsp;&nbsp;Update Status");

            $("#updateStatusCTA").prop('disabled', true);
          });

          $("#updateStatusModal").modal("show");
        },
      }).then((result) => {
        
      })
    });

    $("#incomingShippingTable tbody").on("click", "tr .printWaybill", function() {
      Swal.fire({
        title: 'Silahkan Tunggu',
        html: 'Memuat detail pengiriman',
        willOpen: async () => {
          Swal.showLoading();
          $.ajax('<?php echo base_url() ?>dashboard/shipping/print/'+$(this).attr("shippingId"), {
            type: 'GET',
            success: function (data, status, xhr) {
              Swal.close();
              $('#waybills').empty();
              $(data).appendTo('#waybills');
              printJS({
                printable: "waybills",
                type: 'html'
              });
              $('#waybills').empty();
            },
            error: function (jqXhr, textStatus, errorMessage) {
              Swal.close();
            }
          });
          
        },
      }).then((result) => {
        
      })
    });

    $("#updateStatusCTA").click(function() {
      $("#updateStatusCTA").addClass('disabled btn-progress');

      $.ajax('<?php echo base_url() ?>dashboard/shipping/update-status', {
        type: 'POST',
        data: { ids: willUpdateShippingId, status: updateStatusTo, remarks: $("#updateRemarks").val() },
        success: function (data, status, xhr) {
          $("#updateStatusCTA").removeClass('disabled btn-progress');

          const res = JSON.parse(data);
          
          if (!res.status) {
            new Noty({
              theme: 'metroui',
              type: 'error',
              text: 'Gagal melakukan aksi',
              timeout: 3000
            }).show();
            
            return;
          }

          new Noty({
            theme: 'metroui',
            type: 'success',
            text: 'Berhasil update staus pengiriman',
            timeout: 3000
          }).show();

          $("#updateStatusModal").modal("hide");

          reloadPageInSix();
        },
        error: function (jqXhr, textStatus, errorMessage) {
          new Noty({
            theme: 'metroui',
            type: 'error',
            text: 'Gagal melakukan aksi',
            timeout: 3000
          }).show();

          $("#updateStatusCTA").removeClass('disabled btn-progress');
        }
      });
    });

    shippingFormValidation();
    shippingFormEditValidation();

    $("#submitShipping").click(function() {
      submitShipping();
    });

    maskSomeShippingForm();

    var ids = "";
    var checkedShippingSts = [];
    $("#printManifestButton").click(function() {
      var rowsSelected = shippingTable.column(0).checkboxes.selected();
      
      if (rowsSelected.length == 0) {
        return Swal.fire({
          title: 'Peringatan',
          text: "Anda belum mencentang satupun data pada tabel di bawah",
          icon: 'warning',
          confirmButtonText: 'Oke',
          reverseButtons: true
        });
      }

      let showModal = true;
      let manifestIds = [];
      $.each(rowsSelected, function(index, rowId) {
         // Create a hidden element
         const rowData = shippingTable.row(rowId-1).data();

         const shippingStatus = rowData[6];
         if (shippingStatus != "1") {
           showModal = false;
            return Swal.fire({
              title: "Peringatan",
              text: "Cetak manifest hanya bisa di lakukan untuk pengiriman ber-status Order Masuk",
              icon: 'error',
              confirmButtonText: "Oke",
              allowOutsideClick: false,
              focusCancel: true
            });
          }

          if (shippingStatus == "1") {
            manifestIds.push(rowData[7]); //pushing tracking id (resi)
          }
      });

      if (showModal) {
        ids = manifestIds.join();
        $("#printManifestTitle").html('Cetak Manifes ('+rowsSelected.length+' Resi)')
        $("#dataCount").html(rowsSelected.length);
        $("#manifestDetailDialogModal").modal('toggle');
      }
    });

    var willUpdateShipId = "";
    $("#shippingTable tbody").on("click", "tr .btnEditShipping", function() {
      const shipid =  $(this).attr("shippingId");
      willUpdateShipId = shipid;

      Swal.fire({
        title: 'Silahkan Tunggu',
        html: 'sedang memuat data...',
        willOpen: async () => {
          Swal.showLoading();
          const res = await getShippingDetailById(shipid);
          Swal.close();

          // Inject data to form
          maskSomeShippingEditForm();
          $("#editTrackingNumber").val(res.data.tracking_no);
          $("#editDestBranchSelect").val(res.data.destination_branch_id);
          $("#editStatusSelect").val(res.data.status);
          $("#editSenderName").val(res.data.sender_name);
          $("#editSenderAddress").val(res.data.sender_address);
          $("#editSenderPhone").val(res.data.sender_phone);
          $("#editReceiverName").val(res.data.receiver_name);
          $("#editReceiverAddress").val(res.data.receiver_address);
          $("#editReceiverPhone").val(res.data.receiver_phone);
          $("#editStuffContent").val(res.data.stuff_content);
          $("#editStuffColly").val(res.data.stuff_colly);
          $("#editStuffWeight").val(res.data.stuff_weight);
          $("#editStuffRefNo").val(res.data.stuff_reference_no);
          $("#editServiceSelect").val(res.data.service);
          $("#editModeSelect").val(res.data.mode);
          $("#editPrice").val(res.data.price);
          $("#editPayment").val(res.data.payment_type);

          // Need trigger for jquery mask auto mask, 
          $('#editPrice').trigger('input');
          $('#editSenderPhone').trigger('input');
          $('#editReceiverPhone').trigger('input');
          $('#editStuffWeight').trigger('input');
          $('#editStuffColly').trigger('input');
          // and for validation needs
          $('#editSnderName').trigger('paste');
          $('#editSenderAddress').trigger('paste');
          
          $("#editDestBranchSelect option[value="+res.data.destination_branch_id+"]").prop('selected', true);
          $('#editDestBranchSelect').change();
          
          $("#editPayment option[value="+res.data.payment_type+"]").prop('selected', true);
          $('#editPayment').change();
          
          $('#modal_edit_shipping').modal('show');
        },
      });
    });

    $("#submitEditShipping").click(function() {
      submitShippingEdit(willUpdateShipId);
    });

    $("#shippingTable tbody").on("click", "tr .btnDeleteShipping", function() {
      const willDeleteShippingId =  $(this).attr("shippingId");
      deleteShippingById(willDeleteShippingId);
    });
      
    $("#goPrintManifestButton").click(function() {
      // Updating status and insert history
      $("#goPrintManifestButton").addClass('disabled btn-progress');
      $.ajax('<?php echo base_url() ?>dashboard/shipping/update-status', {
        type: 'POST',
        data: { ids: ids, status: 2, remarks: '' },
        success: function (data, status, xhr) {          
          const res = JSON.parse(data);
          
          if (!res.status) {
            new Noty({
              theme: 'metroui',
              type: 'error',
              text: 'Gagal melakukan aksi',
              timeout: 3000
            }).show();
            
            return;
          }

          $.ajax('<?php echo base_url() ?>dashboard/shipping/manifest', {
            type: 'POST',
            data: { ids: ids, driver: $('#driverInput').val(), nopol: $('#nopolInput').val() },
            success: function (data, status, xhr) {
              $("#goPrintManifestButton").removeClass('disabled btn-progress');
              window.open(data);
              reloadPageInSix();
            },
            error: function (jqXhr, textStatus, errorMessage) {
              $("#goPrintManifestButton").removeClass('disabled btn-progress');
            }
          });

        },
        error: function (jqXhr, textStatus, errorMessage) {
          new Noty({
            theme: 'metroui',
            type: 'error',
            text: 'Gagal melakukan aksi',
            timeout: 3000
          }).show();

          $("#goPrintManifestButton").removeClass('disabled btn-progress');
        }
      });

    });

    // ----------- Report Section ----------- //
    $('.daterange-btn').daterangepicker({
      ranges: {
        'Hari Ini'       : [moment(), moment()],
        'Kemarin'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        '7 Hari Terakhir' : [moment().subtract(6, 'days'), moment()],
        '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
        'Bulan Ini'  : [moment().startOf('month'), moment().endOf('month')],
        'Bulan Kemarin'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate  : moment()
    }, function (start, end) {
      $('.daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
      $('#daterangepreview').html('('+start.format('D MMMM YYYY') + ' s/d ' + end.format('D MMMM YYYY')+')');
      window.location.href = "<?php echo base_url() ?>dashboard/report/sales-trx?startDate=" + encodeURIComponent(start.format('YYYY-MM-DD HH:mm:ss')) + "&endDate=" + encodeURIComponent(end.format('YYYY-MM-DD HH:mm:ss'));
    });

    $("#transactionReportTable").dataTable({
      responsive: true,
      dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf'
        ],
      "language": {
        "emptyTable": "Tidak ada data pengiriman dalam jangka waktu ini"
      },
    });

    $("#printedManifestList").dataTable({
      "columnDefs": [
        { "sortable": false, "targets": [6] }
      ],
      "language": {
        "emptyTable": "Tidak ada manifest tercetak dari cabang ini"
      },
    });
});

function currencyIDR(input) {
  var	number_string = input.toString(),
    sisa 	= number_string.length % 3,
    rupiah 	= number_string.substr(0, sisa),
    ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
      
  if (ribuan) {
    separator = sisa ? ',' : '';
    rupiah += separator + ribuan.join(',');
  }

  return rupiah;
}

function getMonthlyDashboardData(monthNumber) {
  return new Promise((resolve, reject) => {
    $.ajax('<?php echo base_url() ?>dashboard/monthly?month='+monthNumber, {
      type: 'GET',
      success: function (data, status, xhr) {
        resolve(JSON.parse(data));
      },
      error: function (jqXhr, textStatus, errorMessage) {
        reject(errorMessage);
      }
    });
  });
}

function shippingFormValidation() {
  $('#destBranchSelect').addClass('is-invalid');
  $('#senderName').addClass('is-invalid');
  $('#senderAddress').addClass('is-invalid');
  $('#payment').addClass('is-invalid');

  $("#destBranchSelect").on("change paste keyup", function() {
    if (!$('#destBranchSelect').val()) {
      $('#destBranchSelect').addClass('is-invalid');
    } else {
      $('#destBranchSelect').removeClass('is-invalid');
    }
  });

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

function shippingFormEditValidation() {
  $('#editDestBranchSelect').addClass('is-invalid');
  $('#editSnderName').addClass('is-invalid');
  $('#editSenderAddress').addClass('is-invalid');
  $('#editPayment').addClass('is-invalid');

  $("#editDestBranchSelect").on("change paste keyup", function() {
    if (!$('#editDestBranchSelect').val()) {
      $('#editDestBranchSelect').addClass('is-invalid');
    } else {
      $('#editDestBranchSelect').removeClass('is-invalid');
    }
  });

  $("#editSenderName").on("change paste keyup", function() {
    if (!$('#editSenderName').val()) {
      $('#editSenderName').addClass('is-invalid');
    } else {
      $('#editSenderName').removeClass('is-invalid');
    }
  });

  $("#editSenderAddress").on("change paste keyup", function() {
    if (!$('#editSenderAddress').val()) {
      $('#editSenderAddress').addClass('is-invalid');
    } else {
      $('#editSenderAddress').removeClass('is-invalid');
    }
  });

  $("#editPayment").change(function(){
    if (!$('#editPayment').val()) {
      $('#editPayment').addClass('is-invalid');
    } else {
      $('#editPayment').removeClass('is-invalid');
    }
  });
}

function maskSomeShippingForm() {
  $('#price').mask('000.000.000', {reverse: true});
  $('#senderPhone').mask('0000-0000-0000 000');
  $('#receiverPhone').mask('0000-0000-0000 000');

  $('#stuffWeight').mask('000000000');
  $('#stuffColly').mask('000000000');
}

function maskSomeShippingEditForm() {
  $('#editPrice').mask('000.000.000', {reverse: true});
  $('#editSenderPhone').mask('0000-0000-0000 000');
  $('#editReceiverPhone').mask('0000-0000-0000 000');

  $('#editStuffWeight').mask('000000000');
  $('#editStuffColly').mask('000000000');
}

function generateResi() {
  return new Promise((resolve, reject) => {
    $.ajax('<?php echo base_url() ?>dashboard/shipping/resi', {
      type: 'POST',
      data: {
        branch_id: "<?php echo $this->session->userdata('branch_id') ?>",
      },
      success: function (data, status, xhr) {
        const res = JSON.parse(data);
        if (!res.status) {
          reject('Gagal mendapatkan data resi, mohon refresh');
          return;
        }

        resolve(res.data);
      },
      error: function (jqXhr, textStatus, errorMessage) {
        reject(errorMessage);
      }
    });
  });
}

function submitBranch() {
  let branchName = $("#branchName").val();
  let registrationCode = $("#registrationCode").val();
  let branchAddress = $("#branchAddress").val();
  let fullName = $("#adminName").val();
  let username = $("#adminUsername").val();
  let password = $("#adminPassword").val();
   
  // NOTE : run validation
  if (!(branchName && registrationCode && branchAddress && fullName && username && password)) {
    new Noty({
      theme: 'metroui',
      type: 'warning',
      text: 'Pastikan semua kolom terisi',
      timeout: 3000
    }).show();
    return;
  }

  $("#submitBranch").addClass('disabled btn-progress');

  $.ajax('<?php echo base_url() ?>dashboard/branch/submit', {
    type: 'POST',
    data: {
      branch_name: branchName,
      branch_address: branchAddress,
      registration_code: registrationCode.toUpperCase(),
      full_name: fullName,
      username: username,
      password: password
    },
    success: function (data, status, xhr) {
      const res = JSON.parse(data);

      $("#submitBranch").removeClass('disabled btn-progress');
      
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
        res.data.name + ' (' + res.data.registration_code + ')',
        res.data.address,
        res.data.full_name,
        res.data.username,
        "<button data-toggle='tooltip' title='Edit' class='btn btn-link text-success'><i class='fa fa-edit'></i></button><button data-toggle='tooltip' title='Hapus' class='btn btn-link text-danger'><i class='fa fa-trash'></i></button>"
      ]).draw( true );

      $("#branchName").val('');
      $("#registrationCode").val('');
      $("#branchAddress").val('');
      $("#adminName").val('');
      $("#adminUsername").val('');
      $("#adminPassword").val('');
    },
    error: function (jqXhr, textStatus, errorMessage) {
      new Noty({
        theme: 'metroui',
        type: 'error',
        text: errorMessage,
        timeout: 3000
      }).show();
      $("#submitBranch").removeClass('disabled btn-progress');
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
    origin_branch_id: branchId,
    destination_branch_id: $('#destBranchSelect').val(),
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

  $("#submitShipping").addClass('disabled btn-progress');

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
      shippingFormValidation();

      $("#submitShipping").removeClass('disabled btn-progress');
      $('#modal_create_shipping').modal('toggle');

      maskSomeShippingForm();

      reloadPageInSix();
    },
    error: function (jqXhr, textStatus, errorMessage) {
      new Noty({
        theme: 'metroui',
        type: 'error',
        text: errorMessage,
        timeout: 3000
      }).show();
      $("#submitShipping").removeClass('disabled btn-progress');
      maskSomeShippingForm();
    }
  });
}

function submitShippingEdit(shippingId) {
  // Unmask some field for a while to get pure input
  $('#editPrice').unmask();
  $('#editReceiverPhone').unmask();
  $('#editSenderPhone').unmask();

  var branchId = "<?php echo $this->session->userdata('branch_id') ?>";
  var shippingData = {
    id: shippingId,
    origin_branch_id: branchId,
    destination_branch_id: $('#editDestBranchSelect').val(),
    tracking_no: $('#editTrackingNumber').val(),
    status: $('#editStatusSelect').val(),
    service: $('#editServiceSelect').val(),
    mode: $('#editModeSelect').val(),
    price: $('#editPrice').val(),
    payment: $('#editPayment').val(),
    sender_name: $('#editSenderName').val(),
    sender_address: $('#editSenderAddress').val(),
    sender_phone: $('#editSenderPhone').val(),
    receiver_name: $('#editReceiverName').val(),
    receiver_address: $('#editReceiverAddress').val(),
    receiver_phone: $('#editReceiverPhone').val(),
    stuff_content: $('#editStuffContent').val(),
    stuff_weight: $('#editStuffWeight').val(),
    stuff_colly: $('#editStuffColly').val(),
    stuff_reference_no: $('#editStuffRefNo').val()
  };

  // Run some validation
  if (!shippingData.sender_name) {
    $('#editSenderName').focus();
    maskSomeShippingEditForm();
    return;
  }
  if (!shippingData.sender_address) {
    $('#editSenderAddress').focus();
    maskSomeShippingEditForm();
    return;
  }
  if (!shippingData.payment) {
    $('#editPayment').focus();
    maskSomeShippingEditForm();
    return;
  }

  $("#submitEditShipping").addClass('disabled btn-progress');

  $.ajax('<?php echo base_url() ?>dashboard/shipping/update', {
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

      $("#submitEditShipping").removeClass('disabled btn-progress');
      $('#modal_edit_shipping').modal('toggle');

      maskSomeShippingForm();

      reloadPageInSix();
    },
    error: function (jqXhr, textStatus, errorMessage) {
      new Noty({
        theme: 'metroui',
        type: 'error',
        text: errorMessage,
        timeout: 3000
      }).show();
      $("#submitShipping").removeClass('disabled btn-progress');
      maskSomeShippingForm();
    }
  });
}

function reloadPageInSix() {
  setTimeout(() => {
    location.reload();
  }, 600);
}

function deleteShippingById(shippingId) {
  Swal.fire({
    title: 'Peringatan',
    text: "Apakah anda yakin ingin menghapus data ini ?\nData yang tela dihapus tidak dapat dikembalikan",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Hapus',
    cancelButtonText: 'Batal',
    reverseButtons: true
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire({
        title: 'Silahkan Tunggu',
        html: 'menghapus data pengiriman...',
        willOpen: () => {
          Swal.showLoading();
          $.ajax('<?php echo base_url() ?>dashboard/shipping/delete', {
            type: 'POST',
            data: { shipping_id: shippingId },
            success: function (data, status, xhr) {
              Swal.close();

              const res = JSON.parse(data);
              
              if (!res.status) {
                new Noty({
                  theme: 'metroui',
                  type: 'error',
                  text: 'Gagal melakukan aksi',
                  timeout: 3000
                }).show();
                
                return;
              }

              new Noty({
                theme: 'metroui',
                type: 'success',
                text: 'Berhasil menghapus data',
                timeout: 3000
              }).show();

              reloadPageInSix();
            },
            error: function (jqXhr, textStatus, errorMessage) {
              Swal.close();

              new Noty({
                theme: 'metroui',
                type: 'error',
                text: 'Gagal melakukan aksi',
                timeout: 3000
              }).show();

              $("#goPrintManifestButton").removeClass('disabled btn-progress');
            }
          });
        },
      }).then((result) => {
        
      })
    }
  })
}

async function getShippingDetailById(shippingId) {
  return new Promise((resolve, reject) => {
    $.ajax({
      url: "<?php echo base_url() ?>dashboard/shipping/detail/"+shippingId,
      type: "GET",
      success: function(data){
        resolve(JSON.parse(data));
      },
      error: function (jqXhr, textStatus, errorMessage) { // error callback 
        reject(errorMessage);
      }
    });
  });
}
</script>