<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<style>
		body {
			font-family: "Segoe UI";
			display: flex;
			flex-wrap: wrap;
			align-content: flex-start;
		}

		.tbl {
			margin-right: 16px;
			margin-bottom: 16px;
		}

		.bg-yellow {
			background-color: yellow;
		}

		.bg-red {
			background-color: red;
			color: white;
		}

		.bg-blue {
			background-color: blue;
			color: white;
		}

		.height-40 {
			height: 40px;
		}

		.height-ten-percent {
			height: 14%;
		}

		.height-64 {
			height: 64px;
		}

		.main-table {
			width: 560px;
			text-align: center;
			text-transform: uppercase;
			font-weight: 600;
			border-collapse: collapse;
		}

		.kop-logo {
			height: 64px;
		}
	</style>
</head>
<body>
<?php $this->load->view('shipping/waybill', array('type' => 'PENERIMA')) ?>
<?php $this->load->view('shipping/waybill', array('type' => 'PENGIRIM')) ?>
<?php $this->load->view('shipping/waybill', array('type' => 'TRANSPORTER')) ?>
<?php $this->load->view('shipping/waybill', array('type' => 'TRANSPORTER')) ?>
</body>
</html>