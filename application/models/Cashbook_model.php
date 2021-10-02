<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cashbook_model extends CI_Model {

    public function get_cashbook($args = null) {
        $this->db->select('*');
        $this->db->from('tbl_cashbook');
        if (isset($args['cash_in'])):
            $this->db->where('cash_in IS NOT NULL', null, false);
            $query_result = $this->db->get();
            $result = $query_result->result();
        elseif (isset($args['cash_out'])):
            $this->db->where('cash_out IS NOT NULL', null, false);
            $query_result = $this->db->get();
            $result = $query_result->result();
        else:
            $this->db->order_by('pk_cashbook_id', 'DESC');
            $query_result = $this->db->get();
            $result = $query_result->result();
        endif;
        return $result;
    }

    public function save_cashbook($data) {
        $this->db->insert('tbl_cashbook', $data);
        $return = $this->db->insert_id();
        return $return;
    }
}