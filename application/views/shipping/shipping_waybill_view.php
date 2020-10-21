<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<style>
		.top-item {
			border-bottom: 1px solid black;
			margin-bottom: 54px;
		}

		.bottom-item {
			border-top: 1px solid black;
		}

		.grayscale {
			-webkit-filter: grayscale(100%);
			-moz-filter: grayscale(100%);
			filter: grayscale(100%);
		}
	</style>
</head>
<body>
	<div class="top-item">
		<?php $this->load->view('shipping/waybill', array('type' => 'ASLI')) ?>
	</div>
	<div class="bottom-item grayscale">
		<?php $this->load->view('shipping/waybill', array('type' => 'COPY')) ?>
	</div> 
	<div class="top-item grayscale">
		<?php $this->load->view('shipping/waybill', array('type' => 'COPY')) ?>
	</div> 
	<div class="bottom-item grayscale">
		<?php $this->load->view('shipping/waybill', array('type' => 'COPY')) ?>
	</div> 
</body>
</html>