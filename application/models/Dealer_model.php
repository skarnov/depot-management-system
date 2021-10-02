<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dealer_model extends CI_Model {

    public function get_dealers($edit = NULL) {
        $this->db->select('*');
        $this->db->from('tbl_clients');
        $this->db->where('client_type', 'dealer');
        if ($edit):
            $this->db->where('pk_client_id', $edit);
            $query_result = $this->db->get();
            $result = $query_result->row();
        else:
            $this->db->order_by('pk_client_id', 'DESC');
            $query_result = $this->db->get();
            $result = $query_result->result();
        endif;
        return $result;
    }
}