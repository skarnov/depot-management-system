<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    public function get_products($edit = NULL) {
        $this->db->select('*');
        $this->db->from('tbl_products');
        if ($edit):
            $this->db->where('pk_product_id', $edit);
            $query_result = $this->db->get();
            $result = $query_result->row();
        else:
            $this->db->order_by('pk_product_id', 'DESC');
            $query_result = $this->db->get();
            $result = $query_result->result();
        endif;
        return $result;
    }
}