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

    public function vehicleList() {
        return array(
            (object) array(
                'id' => 1,
                'registration_no' => 'B 5567 KL',
                'brand' => 'Mitsubishi',
                'model' => 'Colt FE 71',
                'type' => 'Truck',
                'manufacture_year' => '2020',
                'machine_number' => 'OP51E45636677',
            ),
            (object) array(
                'id' => 2,
                'registration_no' => 'L 345 RND',
                'brand' => 'Mitsubishi',
                'model' => 'Fighter FN 61 L HD',
                'type' => 'Truck',
                'manufacture_year' => '2012',
                'machine_number' => 'RQ51E67836679',
            ),
            (object) array(
                'id' => 3,
                'registration_no' => 'B 3445 KR',
                'brand' => 'Hino',
                'model' => 'Dutro Cargo 110 SDR',
                'type' => 'Truck',
                'manufacture_year' => '2015',
                'machine_number' => 'RS51E88936622',
            ),
            (object) array(
                'id' => 4,
                'registration_no' => 'B 9809 RH',
                'brand' => 'Fuso',
                'model' => 'Fighter FM 65 FS Hi-Gear',
                'type' => 'Truck',
                'manufacture_year' => '2020',
                'machine_number' => 'JI51U903766678',
            ),
            (object) array(
                'id' => 5,
                'registration_no' => 'D 9810 PPR',
                'brand' => 'Hino',
                'model' => 'Dutro Cargo 110 SDR',
                'type' => 'Truck',
                'manufacture_year' => '2020',
                'machine_number' => 'JI51U903700678',
            ),
            (object) array(
                'id' => 6,
                'registration_no' => 'B 4467 QR',
                'brand' => 'Hino',
                'model' => 'Dutro Cargo 110 SDR',
                'type' => 'Truck',
                'manufacture_year' => '2020',
                'machine_number' => 'JI91U903700678',
            ),
        );
    }

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