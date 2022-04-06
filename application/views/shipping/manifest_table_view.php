<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
			font-family: "Segoe UI"
		}
    </style>
</head>
<body>
<table width="100%" style="">
    <tr height="30px">
        <td colspan="3">MANIFES DAFTAR MUAT</td>
    </tr>
    <tr height="30px">
        <td>TANGGAL: <?php echo $this->ms_variable->date(Date('Y-m-d')) ?></td>
        <td>NOPOL: <?php echo $this->input->post('nopol') ?></td>
        <td>SUPIR & KERNET: <?php echo $this->input->post('driver') ?></td>
    </tr>
</table>
<table border="1" style="border-collapse: collapse; text-align: center">
    <tr>
        <th rowspan="2">NO. RESI</th>
        <th rowspan="2">PENGIRIM</th>
        <th rowspan="2">PENERIMA</th>
        <th rowspan="2">CAB. TUJUAN</th>
        <th rowspan="2">ISI BARANG</th>
        <th rowspan="2">BERAT</th>
        <th rowspan="2">COLLY</th>
        <th colspan="3">PEMBAYARAN</th>
        <th rowspan="2">KETERANGAN</th>
    </tr>
    <tr>
        <th>TAGIHAN</th>
        <th>COD</th>
        <th>CASH</th>
    </tr>

    <?php foreach($shippingList["shippingList"] as $shipping): ?>
    <tr>
        <td><?php echo $shipping->tracking_no ?></td>
        <td><?php echo $shipping->sender_name ?></td>
        <td><?php echo $shipping->receiver_name ?></td>
        <td><?php echo $shipping->name ?> (<?php echo $shipping->registration_code ?>)</th>
        <td><?php echo $shipping->stuff_content ?></td>
        <td><?php echo $shipping->stuff_weight ?></td>
        <td><?php echo $shipping->stuff_colly ?></td>
        <!-- CASH / COD / DELIVERY -->
        <td><?php if ($shipping->payment_type == 1) { echo 'Rp. '.number_format($shipping->price); } ?></td>
        <td><?php if ($shipping->payment_type == 2) { echo 'Rp. '.number_format($shipping->price); } ?></td>
        <td><?php if ($shipping->payment_type == 3) { echo 'Rp. '.number_format($shipping->price); } ?></td>
        <td></td>
    </tr>
    <?php endforeach; ?>

    <tr>
        <td colspan="4"></td>
        <td>Total</td>
        <td><?php echo $shippingList["totalWeight"] ?></td>
        <td><?php echo $shippingList["totalColly"] ?></td>
        <td><?php echo 'Rp. '.number_format($shippingList["totalInvoiceCount"]) ?></td>
        <td><?php echo 'Rp. '.number_format($shippingList["totalCodCount"]) ?></td>
        <td><?php echo 'Rp. '.number_format($shippingList["totalCashCount"]) ?></td>
        <td border="0"></td>
    </tr>

    <tr>
        <td colspan="4"></td>
        <td colspan="3">Total pendapatan manifes</td>
        <?php $total = (int) $shippingList["totalCashCount"] + (int) $shippingList["totalCodCount"] + (int) $shippingList["totalInvoiceCount"] ?>
        <td colspan="3">Rp. <?php echo number_format($total) ?></td>
        <td></td>
    </tr>
</table>
</body>
</html>