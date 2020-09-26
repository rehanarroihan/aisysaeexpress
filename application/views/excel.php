<table width="100%">
    <tr height="30px">
        <td colspan="3">MANIFES DAFTAR MUAT</td>
    </tr>
    <tr height="30px">
        <td>TANGGAL: </td>
        <td>NOPOL: </td>
        <td>SUPIR & KERNET: </td>
    </tr>
</table>
<table border="1">
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
        <th><?php echo $shipping->tracking_no ?></th>
        <th><?php echo $shipping->sender_name ?></th>
        <th><?php echo $shipping->receiver_name ?></th>
        <th></th>
        <th><?php echo $shipping->stuff_content ?></th>
        <th><?php echo $shipping->stuff_weight ?></th>
        <th><?php echo $shipping->stuff_colly ?></th>
        <!-- CASH / COD / DELIVERY -->
        <th><?php if ($shipping->payment_type == 1) { echo "&#10003;"; } ?></th>
        <th><?php if ($shipping->payment_type == 2) { echo "&#10003;"; } ?></th>
        <th><?php if ($shipping->payment_type == 3) { echo "&#10003;"; } ?></th>
        <th></th>
    </tr>
    <?php endforeach; ?>

    <tr>
        <th colspan="4"></th>
        <th>Total</th>
        <th><?php echo $shippingList["totalWeight"] ?></th>
        <th><?php echo $shippingList["totalColly"] ?></th>
        <th><?php echo $shippingList["totalCashCount"] ?></th>
        <th><?php echo $shippingList["totalCodCount"] ?></th>
        <th><?php echo $shippingList["totalDeliveryCount"] ?></th>
        <th border="0"></th>
    </tr>
</table>