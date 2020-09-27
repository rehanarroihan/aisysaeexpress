<table width="100%" style="">
    <tr height="30px">
        <td colspan="3">MANIFES DAFTAR MUAT</td>
    </tr>
    <tr height="30px">
        <td>TANGGAL: </td>
        <td>NOPOL: </td>
        <td>SUPIR & KERNET: </td>
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
        <th>CASH</th>
        <th>COD</th>
        <th>DELIVERY</th>
    </tr>

    <?php foreach($shippingList["shippingList"] as $shipping): ?>
    <tr>
        <td><?php echo $shipping->tracking_no ?></td>
        <td><?php echo $shipping->sender_name ?></td>
        <td><?php echo $shipping->receiver_name ?></td>
        <td></th>
        <td><?php echo $shipping->stuff_content ?></td>
        <td><?php echo $shipping->stuff_weight ?></td>
        <td><?php echo $shipping->stuff_colly ?></td>
        <!-- CASH / COD / DELIVERY -->
        <td><?php if ($shipping->payment_type == 1) { echo $shipping->price; } ?></td>
        <td><?php if ($shipping->payment_type == 2) { echo $shipping->price; } ?></td>
        <td><?php if ($shipping->payment_type == 3) { echo $shipping->price; } ?></td>
        <td></td>
    </tr>
    <?php endforeach; ?>

    <tr>
        <td colspan="4"></td>
        <td>Total</td>
        <td><?php echo $shippingList["totalWeight"] ?></td>
        <td><?php echo $shippingList["totalColly"] ?></td>
        <td><?php echo $shippingList["totalCashCount"] ?></td>
        <td><?php echo $shippingList["totalCodCount"] ?></td>
        <td><?php echo $shippingList["totalDeliveryCount"] ?></td>
        <td border="0"></td>
    </tr>

    <tr>
        <td colspan="4"></td>
        <td colspan="3">Total pendapatan manifes</td>
        <?php $total = (int) $shippingList["totalCashCount"] + (int) $shippingList["totalCodCount"] + (int) $shippingList["totalDeliveryCount"] ?>
        <td colspan="3">Rp. <?php echo number_format($total) ?></td>
        <td></td>
    </tr>
</table>