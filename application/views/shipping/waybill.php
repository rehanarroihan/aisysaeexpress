<table border="1" class="main-table tbl">
  <tr class="height-40">
    <td rowspan="2" class="height-40">
      <img class="kop-logo" src="https://aisysaeexpress.com/wp-content/uploads/2020/08/Logo-Banner-scaled.jpg" alt="Logo">
    </td>
    <td colspan="2" class="bg-yellow" style="width: 300px; height: 8%;">Surat muatan</td>
  </tr>
  <tr>
    <td><?php echo $data->tracking_no ?></td>
    <td><?php echo $type ?></td>
  </tr>
  <tr>
    <td colspan="3" style="height: 30px; text-align: left; padding-left: 12px">
      No Ref:
      <?php 
        if ($data->stuff_reference_no != "") {
        	echo $data->stuff_reference_no;
        }
        ?>
    </td>
  </tr>
  <tr class="height-40">
    <td rowspan="2" style="text-align: left">
      Pengirim: <?php echo $data->sender_name ?> <br>
      <span style="text-transform: none"><?php echo $data->sender_address ?></span>
    </td>
    <td colspan="2" class="bg-yellow height-ten-percent">Pengakuan Isi</td>
  </tr>
  <tr>
    <td class="height-64" colspan="2">
		<?php if ($data->stuff_content != "" && $data->stuff_content != null) {
			echo $data->stuff_content;
		} else {
			echo "<span style='color:white; visibility: hidden'>White Space</span>";
		} ?>
	</td>
  </tr>
  <tr class="height-40">
    <td rowspan="2" style="text-align: left">
      Penerima: <?php echo $data->receiver_name ?> <br>
      <span style="text-transform: none"><?php echo $data->receiver_address ?>
    </td>
    <td class="bg-yellow height-ten-percent">Berat</td>
    <td class="bg-yellow height-ten-percent">Colly</td>
  </tr>
  <tr>
    <td class="height-64">
      <?php
        if ($data->stuff_weight != "") {
        	echo $data->stuff_weight.' Kg';
        } else {
			echo "<span style='color:white; visibility: hidden'>White Space</span>";
		}
        ?>
    </td>
    <td>
      <?php
        if ($data->stuff_colly != "") {
        	echo $data->stuff_colly.' Koli';
        }
        ?>
    </td>
  </tr>
  <tr class="height-40">
    <td rowspan="3">
      <table border="1" style="border-collapse: collapse; height: 118px; width: 251px; margin-bottom: 0px; margin-right: 0px; border: white;" border="0">
        <tr style="height: 16%;">
          <td class="bg-blue">Penerima</td>
          <td class="bg-blue" style="max-width: 88px;">Transporter</td>
        </tr>
        <tr>
          <td style="border-right: 1px solid black;"></td>
          <td class="date-box">
			  <span><?php echo date("d", strtotime($data->created_at)); ?></span>
			  <span><?php echo date("m", strtotime($data->created_at)); ?></span>
			  <span><?php echo date("y", strtotime($data->created_at)); ?></span>
		  </td>
        </tr>
      </table>
    </td>
    <td colspan="2" class="bg-yellow" style="height: 12%;">Pembayaran</td>
  </tr>
  <tr>
    <td class="height-64">
      <?php
        if ($data->price != "") {
        	echo 'Rp. '.number_format($data->price);
        }
        ?>
    </td>
    <td>
      <?php 
        if ($data->payment_type == 1) {
        	echo "Tagihan";
        } else if ($data->payment_type == 2) {
        	echo "COD";
        } else if ($data->payment_type == 3) {
        	echo "Cash";
        }
        ?>
    </td>
  </tr>
  <tr>
    <td colspan="2" class="bg-red">Isi Tidak di Periksa</td>
  </tr>
</table>