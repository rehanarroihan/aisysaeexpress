<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<style>
		@media screen,
			print {
			table {
				table-layout: fixed;
				width: 100%;
				margin-bottom: 22px;
				margin-right: 22px;
			}
		}

		html {
			margin: 12px;
		}

		body {
			font-family: "Segoe UI";
			display: flex;
			flex-wrap: wrap;
			align-content: flex-start;
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

		.mn {
			display: flex;
			flex-wrap: wrap;
			flex-direction: row;
		}

		.date-box {
			display: flex;
			justify-content: flex-end;
			flex-direction: column;
			align-items: flex-end;
		}

		.date-box span {
			display: flex;
			border: 1px solid black;
			width: 25px;
    		height: 25px;
			align-content: center;
		}
	</style>
</head>
<body>
	<div class="mn">
	<?php $this->load->view('shipping/waybill', array('type' => 'PENERIMA')) ?>
	<?php $this->load->view('shipping/waybill', array('type' => 'PENGIRIM')) ?> 
	<?php $this->load->view('shipping/waybill', array('type' => 'TRANSPORTER')) ?>
	<?php $this->load->view('shipping/waybill', array('type' => 'TRANSPORTER')) ?>
	</div>
</body>
</html>