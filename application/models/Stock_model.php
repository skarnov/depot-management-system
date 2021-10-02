<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_model extends CI_Model {

    public function get_stocks($edit = NULL) {
        $this->db->select('*');
        $this->db->from('tbl_stocks');
        $this->db->join('tbl_clients', 'tbl_clients.pk_client_id = tbl_stocks.fk_branch_id','left');
        $this->db->join('tbl_products', 'tbl_products.pk_product_id = tbl_stocks.fk_product_id','left');
        if ($edit):
            $this->db->where('pk_stock_id', $edit);
            $query_result = $this->db->get();
            $result = $query_result->row();
        else:
            $this->db->order_by('pk_stock_id', 'DESC');
            $query_result = $this->db->get();
            $result = $query_result->result();
        endif;
        return $result;
    }
}