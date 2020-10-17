<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {
    
    public function getDailyData($date) {
        $branch_id = $this->session->userdata('branch_id');

        $query = $this->db->select('DATE_FORMAT(created_at, "%Y-%m-%d") as date, COUNT(*) as trx_count, SUM(price) as turnover, SUM(stuff_weight) as tonnage, SUM(stuff_colly) as colly')->from('shipping')->group_by('DATE_FORMAT(created_at, "%Y-%m-%d")');

        if ($branch_id) {
            $query->where('origin_branch_id', $branch_id);
        }

        if ($date) {
            $query->where('created_at', $date);
        } else {
            // If $date are not asssigned, then get weekly datas
            $inWeekDateRange = $this->ms_variable->getDateRangeInWeek();
            $query
                ->where('shipping.created_at >=', $inWeekDateRange[0])
                ->where('shipping.created_at <=', $inWeekDateRange[1]);
        }
        
        $result = $query->get()->result();

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
}