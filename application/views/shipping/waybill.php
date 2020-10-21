<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    @page {
      margin: 0px;
      padding: 0px;
    }

    body {
      font-family: "Arial", sans-serif;
    }

    .table-header {
      text-align: center;
      font-style: bold;
      padding-top: 4px;
      padding-bottom: 4px;
    }
  </style>
</head>
<body>

<table width="100%">
  <tr>
    <td width="10%">
      <img src="<?php echo base_url() ?>assets/img/ase.png" style="height: 116px" alt="">
    </td>
    <td width="70%" style="vertical-align: top;">
      <div style="text-align: center">
        <span style="font-size: 48px; color:#363f93; font-style: bold">AISY SAE EXPRESS</span>
        <p style="padding:0; margin:0; font-size: 14px; font-style: bold">
          Kantor pusat JL. Semut Kali, Ruko Semut Indah Blok B No.14 Surabaya <br>
          Tlp: 031-99220818 Email: <span style="color:#363f93"><u>aisysaeexpress1@gmail.com</u></span> Website: <br>
          aisysaeexpress.com
        </p>
      </div>
    </td>
    <td width="20%">
      <p style="font-size: 32px; color:#363f93; font-style: bold; padding: 4px 4px; border: 3px solid red; display: inline-block; border-radius: 8px">
        <?php echo $type ?>
      </p>
    </td>
  </tr>
</table>

<table width="100%" style="margin-bottom: 6px">
  <tr>
    <td width="35%"></td>
    <td width="65%">
      <div style="color:#363f93; border: 3px solid #ee1d23; display: inline-block; font-size: 24px; font-style:bold; padding: 2px 18px; margin-right: 8px">SURAT MUATAN</div>
      <div style="padding: 2px 0px; font-size: 28px; font-style:bold; display: inline-block; color:#363f93;">(RESI)</div>
    </td>
  </tr>
</table>

<table width="100%" style="margin-bottom: 10px">
  <tr>
    <td style="padding-left: 12px; vertical-align: top;">
      <b>PENGIRIM :</b> <?php echo $this->ms_variable->textTruncate($data->sender_name, 30) ?> <br>
      <?php echo $this->ms_variable->textTruncate($data->sender_address, 20) ?> <br>
      <?php echo $this->ms_variable->textTruncate($data->sender_phone, 13) ?>
    </td>
    <td style="vertical-align: top;">
      <b>PENERIMA :</b> <?php echo $this->ms_variable->textTruncate($data->receiver_name, 30) ?> <br>
      <?php echo $this->ms_variable->textTruncate($data->receiver_address, 20) ?> <br>
      <?php echo $this->ms_variable->textTruncate($data->receiver_phone, 13) ?>
    </td>
  </tr>
</table>

<table width="100%" border="1" style="border-collapse:collapse; margin-bottom: 10px">
  <tr>
    <td class="table-header" width="10%">COLLY</td>
    <td class="table-header" width="30%">ISI BARANG</td>
    <td class="table-header">BERAT</td>
    <td class="table-header" width="20%">BIAYA</td>
    <td class="table-header">MODE BAYAR</td>
  </tr>
  <tr style="height: 64px">
    <td style="text-align: center">
      <?php echo $this->ms_variable->textTruncate($data->stuff_colly, 3) ?>
    </td>
    <td style="vertical-align: top; padding: 4px 6px">
      <?php echo $this->ms_variable->textTruncate($data->stuff_content, 20) ?>
    </td>
    <td style="text-align: center">
      <?php
        if ($data->stuff_weight != "") {
        	echo $data->stuff_weight.' Kg';
        } 
      ?>
    </td>
    <td style="text-align: center">
      <?php
        if ($data->price != "") {
        	echo 'Rp. '.number_format($data->price);
        }
      ?>
    </td>
    <td style="text-align: center">
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
    <td colspan="3" style="text-align: center; background-color: #ee1d23;">
      <p style="font-size: 18px; color: white; padding: 4px 0; margin: 0; font-style: bold">ISI TIDAK DIPERIKSA</p>
    </td>
    <td colspan="2" style="background-color: #fff101; max-height: 200px">
      <p style="font-size: 18px;font-style: bold; padding: 0; margin: 0">
        &nbsp;No.Ref : <?php echo $this->ms_variable->textTruncate($data->stuff_reference_no, 30) ?>
      </p>
    </td>
  </tr>
</table>

<table width="100%">
  <tr>
    <td width="15%" style="vertical-align: top; text-align: center">
      <span>PENERIMA <br><br><br><br><br></span>
      <p>(_ _ _ _ _ _ _ _)</p>
    </td>
    <td style="vertical-align: top; font-size: 12px; line-height: 90%;" width="50%">
      <b>KETENTUAN :</b> <br>
      1. Barang kiriman diserahkan oleh pengangkut sesuai alamat tertera <br>
      2. Dalam hal force majure seperti; kecelakaan, keterlambatan, kebakaran, perampokan tidak menjadi tanggung jawab pengangkut <br>
      3. Kiriman-kiriman yang mudah pecah dan busuk tidak menjadi tanggung jawab kami <br>
      4. Kiriman yang hilang diganti max 10x bea angkut kecuali yang diasuransikan melalui kami <br>
      5. Claim dilayani selambat-lambatnya 24 jam setelah penyerahan berita acara <br>
      6. Kiriman yang tidak ditanyakan dalam tempo 3 bulan, pengangkut dibebaskan dari tanggung jawab <br>
      7. Apabila penerima menolak bea angkutan, maka pengirim diwajibkan untuk membayarnya <br>
      8. Untuk pembatalan kiriman dikenakan bea pembatalan sebesar 50% dari biaya pengiriman <br>
    </td>
    <td width="15%" style="vertical-align: top; text-align: center;">
      <span style="margin-bottom: 30px">
        <span style="text-transform: capitalize; display: inline-block;">
          <?php
            $branchName = $this->session->userdata('branch_name');
            $branchNaming = explode(" ", $branchName);
            if (count($branchNaming) > 1) {
              echo $branchNaming[1];
            } else {
              echo $branchName;
            }
          ?>
        </span>, <br>
        <?php echo Date('d-M-Y') ?>
        <br><br><br><br><br><br>
      </span>
      <span>EKSPEDISI</span>
    </td>
  </tr>
</table>

</body>
</html>