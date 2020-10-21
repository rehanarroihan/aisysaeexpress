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
            ? strftime("%A, %d %B %Y %H:%M", strtotime($oldDateFormat))
            : strftime("%A, %d %B %Y", strtotime($oldDateFormat));
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

    public function getDateRangeInWeek() {
        $monday = strtotime("last monday");
        $monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
        $sunday = strtotime(date("Y-m-d",$monday)." +6 days");
        $this_week_sd = date("Y-m-d",$monday);
        $this_week_ed = date("Y-m-d",$sunday);
        
        return array($this_week_sd, $this_week_ed);
    }

    function textTruncate($text, $chars = 25) {
        if (strlen($text) <= $chars) {
            return $text;
        }
        $text = $text." ";
        $text = substr($text,0,$chars);
        $text = substr($text,0,strrpos($text,' '));
        $text = $text."...";
        return $text;
    }
}
