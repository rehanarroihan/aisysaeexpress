<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('Shipping_model');
    }
    
    
    public function getDailyData($date) {
        $branch_id = $this->session->userdata('branch_id');

        $query = $this->db->select('COUNT(*) as trx_count, SUM(price) as turnover, SUM(stuff_weight) as tonnage, SUM(stuff_colly) as colly')
                            ->from('shipping')
                            ->group_by('DATE_FORMAT(created_at, "%Y-%m-%d")');

        if ($branch_id) {
            $query->where('origin_branch_id', $branch_id);
        }

        if ($date) {
            $query->where('DATE(`created_at`)', $date);
            $result = $query->get()->result();
            $result = count($result) > 0 ? $result[0] : $result;
        } else {
            // If $date are not asssigned, then get weekly datas
            $inWeekDateRange = $this->ms_variable->getDateRangeInWeek();
            $query
                ->where('shipping.created_at >=', $inWeekDateRange[0])
                ->where('shipping.created_at <=', $inWeekDateRange[1]);

            $result = $query->get()->result();
        }
        

        // Null / underfined saver
        if (!$result) {
            $result = (object) array(
                "date" => $date,
                "trx_count" => 0,
                "turnover" => 0,
                "tonnage" => 0,
                "colly" => 0
            );
        }

        return $result;
    }

    public function getMonthlyData($monthNumber) {
        $branch_id = $this->session->userdata('branch_id');

        $query = $this->db->select('DATE_FORMAT(created_at, "%Y-%m-%d") as date, COUNT(*) as trx_count, SUM(price) as turnover, SUM(stuff_weight) as tonnage, SUM(stuff_colly) as colly')
                            ->from('shipping');

        if ($branch_id) {
            $query->where('origin_branch_id', $branch_id);
        }

        if ($monthNumber) {
            $firsdayOfMonth = date('Y-m-d', mktime(0, 0, 0, $monthNumber, 1, date('Y')));
            $lastDatOfMonth = date('Y-m-d', mktime(0, 0, 0, $monthNumber+1, 0, date('Y')));

            $query->where('shipping.created_at >=', $firsdayOfMonth)
                ->where('shipping.created_at <=', $lastDatOfMonth);

            $result = $query->get()->result();
            $result = count($result) > 0 ? $result[0] : $result;
        }
        
        // Null / underfined saver
        if (!$result) {
            $result = (object) array(
                "trx_count" => 0,
                "turnover" => 0,
                "tonnage" => 0,
                "colly" => 0
            );
        }

        return $result;
    }

    public function getUnfinishedTasks() {
        $tasks = $this->db
            ->where('status', 3)
            ->where('origin_branch_id', $this->session->userdata('branch_id'))
            ->get('shipping')
            ->result();

        $fiveTasks = $this->db
            ->where('status', 3)
            ->where('origin_branch_id', $this->session->userdata('branch_id'))
            ->limit(5)
            ->get('shipping')
            ->result();

        return (object) array(
            "total" => count($tasks),
            "data"  => $fiveTasks
        );
    }
}