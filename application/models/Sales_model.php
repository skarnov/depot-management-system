<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_model extends CI_Model {

    public function get_sales() {
        $this->db->select('*');
        $this->db->from('tbl_sales');
        $this->db->order_by('pk_sale_id', 'DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();       
        return $result;
    }
}