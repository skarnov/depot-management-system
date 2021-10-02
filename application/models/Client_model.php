<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Client_model extends CI_Model {

    public function get_clients($edit = NULL) {
        $this->db->select('*');
        $this->db->from('tbl_clients');
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