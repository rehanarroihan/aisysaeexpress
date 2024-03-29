<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ms_variable {
    public $dbDateTimeFormat = "Y-m-d H:m:s";

    private $shippingStatus = array(
        array(
            "id" => 1,
            "order" => 1,
            "title" => 'Order Masuk',
            "badge_title" => 'Order Masuk'
        ),
        array(
            "id" => 2,
            "order" => 2,
            "title" => 'Perjalanan ke Kota Tujuan',
            "badge_title" => 'Perjalanan'
        ),
        array(
            "id" => 3,
            "order" => 3,
            "title" => 'Transit',
            "badge_title" => 'Transit'
        ),
        array(
            "id" => 4,
            "order" => 6,
            "title" => 'Diterima Dengan Baik',
            "badge_title" => 'Diterima'
        ),
        array(
            "id" => 5,
            "order" => 7,
            "title" => 'Cancelled',
            "badge_title" => 'Cancelled'
        ),
        array(
            "id" => 6,
            "order" => 4,
            "title" => 'Sampai di Warehouse Kota Tujuan',
            "badge_title" => 'Warehouse Tujuan'
        ),
        array(
            "id" => 7,
            "order" => 5,
            "title" => 'Proses Antar Kurir',
            "badge_title" => 'Kurir'
        ),
    );

    public function shippingStatusList() {
        $statusList = $this->shippingStatus;

        usort($statusList, function($a, $b) {
            return strcmp($a["order"], $b["order"]);
        }); 

        return $statusList;
    }

    public $shippingType = array(
        array(
            "id" => 1,
            "title" => 'One Night Service (ONS)',
            "alias" => 'ONS'
        ),
        array(
            "id" => 2,
            "title" => 'Cargo',
            "alias" => 'Cargo'
        ),
        array(
            "id" => 3,
            "title" => 'Carter',
            "alias" => 'Carter'
        ),
        array(
            "id" => 3,
            "title" => 'Reguler',
            "alias" => 'Carter'
        ),
    );

    public $shippingMode = array(
        array(
            "id" => 1,
            "title" => 'Trucking',
            "code" => '01'
        ),
        array(
            "id" => 2,
            "title" => 'Kereta',
            "code" => '02'
        ),
        array(
            "id" => 3,
            "title" => 'Pesawat',
            "code" => '03'
        ),
        array(
            "id" => 4,
            "title" => 'Kapal Laut',
            "code" => '04'
        ),
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
                } else if ($status['id'] == 6) {
                    $statusBadgeColorClass = "info";
                } else if ($status['id'] == 7) {
                    $statusBadgeColorClass = "info";
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

    public function months() {
        return array(
            (object) array(
                "id"    =>  1,   
                "name"  => "Januari"
            ),
            (object) array(
                "id"    =>  2,   
                "name"  => "Februari"
            ),
            (object) array(
                "id"    =>  3,
                "name"  => "Maret"
            ),
            (object) array(
                "id"    =>  4,   
                "name"  => "April"
            ),
            (object) array(
                "id"    =>  5,   
                "name"  => "Mei"
            ),
            (object) array(
                "id"    =>  6,   
                "name"  => "Juni"
            ),
            (object) array(
                "id"    =>  7,   
                "name"  => "Juli"
            ),
            (object) array(
                "id"    =>  8,   
                "name"  => "Agustus"
            ),
            (object) array(
                "id"    =>  9,   
                "name"  => "September"
            ),
            (object) array(
                "id"    =>  10,   
                "name"  => "Oktober"
            ),
            (object) array(
                "id"    =>  11,   
                "name"  => "November"
            ),
            (object) array(
                "id"    =>  12,   
                "name"  => "Desember"
            ),
        );
    }
}
