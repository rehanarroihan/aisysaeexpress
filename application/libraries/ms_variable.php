<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ms_variable {
    public $dbDateTimeFormat = "Y-m-d H:m:s";

    public $shippingStatus = array(
        array(
            "id" => 1,
            "title" => 'Order Masuk',
            "badge_title" => 'Order Masuk'
        ),
        array(
            "id" => 2,
            "title" => 'Perjalanan ke Kota Tujuan',
            "badge_title" => 'Perjalanan'
        ),
        array(
            "id" => 3,
            "title" => 'Transit',
            "badge_title" => 'Transit'
        ),
        array(
            "id" => 4,
            "title" => 'Diterima Dengan Baik',
            "badge_title" => 'Diterima'
        ),
        array(
            "id" => 5,
            "title" => 'Cancelled',
            "badge_title" => 'Cancelled'
        )
    );

    public $shippingType = array(
        array(
            "id" => 1,
            "title" => 'One Day Service'
        ),
        array(
            "id" => 2,
            "title" => 'Cargo'
        ),
    );

    public $shippingMode = array(
        array(
            "id" => 1,
            "title" => 'Trucking'
        ),
        array(
            "id" => 2,
            "title" => 'Kereta'
        ),
        array(
            "id" => 3,
            "title" => 'Pesawat'
        ),
        array(
            "id" => 4,
            "title" => 'Kapal Laut'
        )
    );

    public $shippingPaymentType = array(
        array(
            "id" => 1,
            "title" => 'Tagihan'
        ),
        array(
            "id" => 2,
            "title" => 'COD'
        ),
        array(
            "id" => 3,
            "title" => 'Cash'
        ),
    );

    // convert 2020-12-24 to Kamis, 24 Desember 2020
    public function date($oldDateFormat, $includeTime = false) {
        return $includeTime 
            ? strftime("%A, %d %B %Y %H:%M", strtotime($oldDateFormat)) . "\n"
            : strftime("%A, %d %B %Y", strtotime($oldDateFormat)) . "\n";
    }

    // Helper for get status title and bootstrap color class name
    public function getShppingStatusTitleAndColor($statusId) {
        $statusTitle = "";
        $statusBadgeColorClass = "";
        foreach ($this->shippingStatus as $status) {
            if ($status['id'] == $statusId) {
                $statusTitle = $status['badge_title'];
                if ($status['id'] == 1) {
                    $statusBadgeColorClass = "info";
                } else if ($status['id'] == 2) {
                    $statusBadgeColorClass = "warning";
                } else if ($status['id'] == 3) {
                    $statusBadgeColorClass = "primary";
                } else if ($status['id'] == 4) {
                    $statusBadgeColorClass = "success";
                } else if ($status['id'] == 5) {
                    $statusBadgeColorClass = "danger";
                }
                break;
            }
        }

        return array($statusTitle, $statusBadgeColorClass);
    }
}
