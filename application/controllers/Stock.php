<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $user_id = $this->session->userdata('user_id');
        if ($user_id == NULL) {
            redirect('login', 'refresh');
        }
        if (time() - $this->session->userdata('login_time') > 900) {
            $activity = array();
            $activity['activity_type'] = 'error';
            $activity['fk_user_id'] = $user_id;
            $activity['activity_name'] = $this->session->userdata('user_name') . ' logout due to inactivity';
            $activity['created_by'] = $user_id;
            $this->app_model->save_activity($activity);
            $this->session->sess_destroy();
            redirect('login');
        } else {
            $sdata = array();
            $sdata['login_time'] = time();
            $this->session->set_userdata($sdata);
        }
        $this->load->model('stock_model');
        $this->load->model('product_model');
        $this->load->model('client_model');
        $this->load->model('cashbook_model');
        $this->load->model('inventory_model');
    }

    public function index() {
        $data = array();
        $data['title'] = 'Stocks';
        $data['all_stocks'] = $this->stock_model->get_stocks();
        $data['home'] = $this->load->view('stock/stocks', $data, true);
        $this->load->view('app/master', $data);
    }

    public function add_stock($edit = NULL) {
        $data = array();
        $data['edit'] = $edit;
        if ($edit):
            $data['title'] = "Edit Stock";
            $data['stock_info'] = $this->stock_model->get_stocks($edit);
        else:
            $data['title'] = "Add Stock";
        endif;
        $data['all_products'] = $this->product_model->get_products();
        $data['all_branches'] = $this->client_model->get_clients();
        $data['home'] = $this->load->view('stock/add_stock', $data, true);
        $this->load->view('app/master', $data);
    }

    public function save_stock() {
        $time = date('H:i:s');
        $date = date('Y-m-d');
        $logged_user = $this->session->userdata('user_id');

        $data = array();
        $data['fk_branch_id'] = $this->input->post('branch_id', true);
        $data['fk_product_id'] = $this->input->post('product_id', true);
        $data['stock_type'] = $this->input->post('type', true);
        $data['buying_price'] = $this->input->post('buying_price', true);
        $data['selling_price'] = $this->input->post('selling_price', true);
        $transaction_date = $this->input->post('transaction_date', true);
        $data['transaction_date'] = date('Y-m-d', strtotime($transaction_date));
        $product_info = $this->product_model->get_products($data['fk_product_id']);
        $product_unit = $product_info->product_unit;
        $box = $this->input->post('box', true);
        $qty = $this->input->post('qty', true);
        $data['stock_quantity'] = ($product_unit * $box) + $qty;
        $data['create_time'] = $time;
        $data['create_date'] = $date;
        $data['created_by'] = $this->session->userdata('user_id');
        $result = $this->db->insert('tbl_stocks', $data);

        $stock_id = $this->db->insert_id();
        $activity = array();
        $activity['activity_type'] = 'success';
        $activity['fk_user_id'] = $this->session->userdata('user_id');
        $activity['activity_name'] = $this->session->userdata('user_name') . ' add a stock. Which ID -' . $stock_id;
        $activity['created_by'] = $this->session->userdata('user_id');
        $this->app_model->save_activity($activity);

        $cashbook = array();
        $cashbook['fk_branch_id'] = $data['fk_branch_id'];
        $cashbook['fk_product_id'] = $data['fk_product_id'];
        $cashbook['fk_stock_id'] = $stock_id;
        $cashbook['transaction_date'] = date('Y-m-d', strtotime($transaction_date));
        $cashbook['cashbook_description'] = 'Stock In';
        $cashbook['cash_in'] = $data['stock_quantity'] * $data['buying_price'];
        $cashbook['create_time'] = $time;
        $cashbook['create_date'] = $date;
        $cashbook['created_by'] = $this->session->userdata('user_id');
        $cashbook_id = $this->cashbook_model->save_cashbook($cashbook);

        $cashbook_activity = array();
        $cashbook_activity['activity_type'] = 'success';
        $cashbook_activity['fk_user_id'] = $this->session->userdata('user_id');
        $cashbook_activity['activity_name'] = $this->session->userdata('user_name') . ' add some stock and the amount of stock is ' . $cashbook['cash_in'] . ' Cashbook ID -' . $cashbook_id;
        $cashbook_activity['created_by'] = $this->session->userdata('user_id');
        $this->app_model->save_activity($cashbook_activity);

        $this->db->select('fk_product_id');
        $this->db->from('tbl_inventories');
        $this->db->where('fk_product_id', $data['fk_product_id']);
        $this->db->where('buying_price', $data['buying_price']);
        $query_result = $this->db->get();
        $inventory_update = $query_result->row();

        if ($inventory_update) {
            if ($data['stock_type'] == 'regular') {
                $sql = "UPDATE tbl_inventories SET buying_price = '" . $data['buying_price'] . "', regular_quantity = regular_quantity + '" . $data['stock_quantity'] . "', update_time = '$time', update_date = '$date', updated_by = '$logged_user' WHERE fk_product_id = '" . $data['fk_product_id'] . "' AND buying_price = '" . $data['buying_price'] . "' AND fk_branch_id = '" . $data['fk_branch_id'] . "'";
                $this->db->query($sql);
            } elseif ($data['stock_type'] == 'damage') {
                $sql = "UPDATE tbl_inventories SET buying_price = '" . $data['buying_price'] . "', damage_quantity = damage_quantity + '" . $data['stock_quantity'] . "', update_time = '$time', update_date = '$date', updated_by = '$logged_user' WHERE fk_product_id = '" . $data['fk_product_id'] . "' AND buying_price = '" . $data['buying_price'] . "' AND fk_branch_id = '" . $data['fk_branch_id'] . "'";
                $this->db->query($sql);
            } elseif ($data['stock_type'] == 'free') {
                $sql = "UPDATE tbl_inventories SET buying_price = '" . $data['buying_price'] . "', free_quantity = free_quantity + '" . $data['stock_quantity'] . "', update_time = '$time', update_date = '$date', updated_by = '$logged_user' WHERE fk_product_id = '" . $data['fk_product_id'] . "' AND buying_price = '" . $data['buying_price'] . "' AND fk_branch_id = '" . $data['fk_branch_id'] . "'";
                $this->db->query($sql);
            }
        } else {
            $inventory = array();
            $inventory['fk_product_id'] = $data['fk_product_id'];
            $inventory['fk_stock_id'] = $stock_id;
            $inventory['fk_branch_id'] = $data['fk_branch_id'];
            $inventory['buying_price'] = $data['buying_price'];
            $inventory['selling_price'] = $data['selling_price'];
            
            if ($data['stock_type'] == 'regular') {
                $inventory['regular_quantity'] = $data['stock_quantity'];
            } elseif ($data['stock_type'] == 'damage') {
                $inventory['damage_quantity'] = $data['stock_quantity'];
            } elseif ($data['stock_type'] == 'free') {
                $inventory['free_quantity'] = $data['stock_quantity'];
            }

            $inventory['create_time'] = $time;
            $inventory['create_date'] = $date;
            $inventory['created_by'] = $this->session->userdata('user_id');
            $this->inventory_model->save_inventory($inventory);
        }
        if ($result):
            echo 'success';
        endif;
    }
    
    public function edit_stock($edit) {
        $data = array();
        $data['title'] = "Edit Stock";
        $data['edit'] = $edit;
        $data['stock_info'] = $this->stock_model->get_stocks($edit);
        $data['all_products'] = $this->product_model->get_products();
        $data['all_branches'] = $this->client_model->get_clients();
        $data['home'] = $this->load->view('stock/edit_stock', $data, true);
        $this->load->view('app/master', $data);
    }
    
    public function update_stock() {
        $time = date('H:i:s');
        $date = date('Y-m-d');
        $logged_user = $this->session->userdata('user_id');

        $stock_id = $this->input->post('stock_id', true);
        
        $data = array();
        $data['fk_branch_id'] = $this->input->post('branch_id', true);
        $data['fk_product_id'] = $this->input->post('product_id', true);
        $data['stock_type'] = $this->input->post('type', true);
        $data['buying_price'] = $this->input->post('buying_price', true);
        $data['selling_price'] = $this->input->post('selling_price', true);
        $transaction_date = $this->input->post('transaction_date', true);
        $data['transaction_date'] = date('Y-m-d', strtotime($transaction_date));
        $product_info = $this->product_model->get_products($data['fk_product_id']);
        $product_unit = $product_info->product_unit;
        $box = $this->input->post('box', true);
        $qty = $this->input->post('qty', true);
        $data['stock_quantity'] = ($product_unit * $box) + $qty;
        $data['update_time'] = $time;
        $data['update_date'] = $date;
        $data['updated_by'] = $this->session->userdata('user_id');
        $this->db->where('pk_stock_id', $stock_id);
        $result['stock_update'] = $this->db->update('tbl_stocks', $data);
        
        $activity = array();
        $activity['activity_type'] = 'success';
        $activity['fk_user_id'] = $this->session->userdata('user_id');
        $activity['activity_name'] = $this->session->userdata('user_name') . ' update a stock. Which ID -' . $stock_id;
        $activity['created_by'] = $this->session->userdata('user_id');
        $this->app_model->save_activity($activity);

        $cashbook = array();
        $cashbook['fk_branch_id'] = $data['fk_branch_id'];
        $cashbook['fk_product_id'] = $data['fk_product_id'];
        $cashbook['fk_stock_id'] = $stock_id;
        $cashbook['transaction_date'] = date('Y-m-d', strtotime($transaction_date));
        $cashbook['cashbook_description'] = 'Stock In';
        $cashbook['cash_in'] = $data['stock_quantity'] * $data['buying_price'];
        $cashbook['update_time'] = $time;
        $cashbook['update_date'] = $date;
        $cashbook['updated_by'] = $this->session->userdata('user_id');
        $this->db->where('fk_stock_id', $stock_id);
        $result['cashbook_update'] = $this->db->update('tbl_cashbook', $cashbook);

        $cashbook_activity = array();
        $cashbook_activity['activity_type'] = 'success';
        $cashbook_activity['fk_user_id'] = $this->session->userdata('user_id');
        $cashbook_activity['activity_name'] = $this->session->userdata('user_name') . ' update some stock and the amount of stock is ' . $cashbook['cash_in'] . ' Stock ID -' . $stock_id;
        $cashbook_activity['created_by'] = $this->session->userdata('user_id');
        $this->app_model->save_activity($cashbook_activity);

        $this->db->select('fk_product_id');
        $this->db->from('tbl_inventories');
        $this->db->where('fk_product_id', $data['fk_product_id']);
        $this->db->where('buying_price', $data['buying_price']);
        $query_result = $this->db->get();
        $inventory_update = $query_result->row();

        if ($inventory_update) {
            if ($data['stock_type'] == 'regular') {
                $sql = "UPDATE tbl_inventories SET buying_price = '" . $data['buying_price'] . "', regular_quantity = '" . $data['stock_quantity'] . "', update_time = '$time', update_date = '$date', updated_by = '$logged_user' WHERE fk_stock_id = '$stock_id'";
                $this->db->query($sql);
            } elseif ($data['stock_type'] == 'damage') {
                $sql = "UPDATE tbl_inventories SET buying_price = '" . $data['buying_price'] . "', damage_quantity = '" . $data['stock_quantity'] . "', update_time = '$time', update_date = '$date', updated_by = '$logged_user' WHERE fk_stock_id = '$stock_id'";
                $this->db->query($sql);
            } elseif ($data['stock_type'] == 'free') {
                $sql = "UPDATE tbl_inventories SET buying_price = '" . $data['buying_price'] . "', free_quantity = '" . $data['stock_quantity'] . "', update_time = '$time', update_date = '$date', updated_by = '$logged_user' WHERE fk_stock_id = '$stock_id'";
                $this->db->query($sql);
            }
        } else {
            $inventory = array();
            $inventory['fk_product_id'] = $data['fk_product_id'];
            $inventory['fk_stock_id'] = $stock_id;
            $inventory['fk_branch_id'] = $data['fk_branch_id'];
            $inventory['buying_price'] = $data['buying_price'];
            $inventory['selling_price'] = $data['selling_price'];
            
            if ($data['stock_type'] == 'regular') {
                $inventory['regular_quantity'] = $data['stock_quantity'];
            } elseif ($data['stock_type'] == 'damage') {
                $inventory['damage_quantity'] = $data['stock_quantity'];
            } elseif ($data['stock_type'] == 'free') {
                $inventory['free_quantity'] = $data['stock_quantity'];
            }

            $inventory['update_time'] = $time;
            $inventory['update_date'] = $date;
            $inventory['updated_by'] = $this->session->userdata('user_id');
            $this->db->where('fk_stock_id', $stock_id);
            $result['inventory_update'] = $this->db->update('tbl_inventories', $inventory);
        }
        if ($result):
            echo 'success';
        endif;
    }
}