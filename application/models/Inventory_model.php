<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory_model extends CI_Model {

    public function get_inventories($edit = NULL) {
        $this->db->select('*');
        $this->db->from('tbl_inventories');
        $this->db->join('tbl_products', 'tbl_products.pk_product_id = tbl_inventories.fk_product_id','left');
        if ($edit):
            $this->db->where('pk_stock_id', $edit);
            $query_result = $this->db->get();
            $result = $query_result->row();
        else:
            $this->db->order_by('pk_inventory_id', 'DESC');
            $query_result = $this->db->get();
            $result = $query_result->result();
        endif;
        return $result;
    }
    
    public function save_inventory($data) {
        $this->db->insert('tbl_inventories', $data);
        $return = $this->db->insert_id();
        return $return;
    }
}