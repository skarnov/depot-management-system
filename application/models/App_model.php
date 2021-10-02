<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class App_model extends CI_Model {

    public function user_login_check($data) {
        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->where('user_name', $data['user_name']);
        $this->db->where('user_password', $data['user_password']);
        $this->db->where('user_status', 'active');
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function get_statics() {
        $this->db->select_sum('cash_in');
        $query_result = $this->db->get('tbl_cashbook');
        $result['cash_in'] = $query_result->row();
        
        $this->db->select_sum('cash_out');
        $query_sum = $this->db->get('tbl_cashbook');
        $result['cash_out'] = $query_sum->row();
        return $result;
    }

    public function save_activity($data) {
        $time = date('H:i:s');
        $date = date('Y-m-d');

        $insert = array();
        $insert['activity_type'] = $data['activity_type'];
        $insert['fk_user_id'] = $data['fk_user_id'];
        $insert['activity_name'] = $data['activity_name'];
        $insert['create_time'] = $time;
        $insert['create_date'] = $date;
        $insert['created_by'] = $data['created_by'];
        $return = $this->db->insert('tbl_activities', $insert);
        return $return;
    }
}