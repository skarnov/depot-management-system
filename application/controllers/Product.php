<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

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
        $this->load->model('product_model');
    }

    public function index() {
        $data = array();
        $data['title'] = 'Products';
        $data['all_products'] = $this->product_model->get_products();
        $data['home'] = $this->load->view('product/products', $data, true);
        $this->load->view('app/master', $data);
    }

    public function select_product($id) {
        $data = array();
        $data['product_info'] = $this->product_model->get_products($id);
        $this->load->view('product/productInfo', $data);
    }

    public function add_product($edit = NULL) {
        $data = array();
        $data['edit'] = $edit;
        if ($edit):
            $data['title'] = "Edit Product";
            $data['product_info'] = $this->product_model->get_products($edit);
        else:
            $data['title'] = "Add Product";
        endif;
        $data['home'] = $this->load->view('product/add_product', $data, true);
        $this->load->view('app/master', $data);
    }

    public function save_product($edit = NULL) {
        $time = date('H:i:s');
        $date = date('Y-m-d');
        $product_name = $this->input->post('name', true);

        if ($product_name) {
            $data = array();
            $data['product_name'] = $this->input->post('name', true);
            $data['product_weight'] = $this->input->post('weight', true);
            $data['product_unit'] = $this->input->post('unit', true);

            if ($edit):
                $data['update_time'] = $time;
                $data['update_date'] = $date;
                $data['updated_by'] = $this->session->userdata('user_id');
                $this->db->where('pk_product_id', $edit);
                $result = $this->db->update('tbl_products', $data);
                $activity = array();
                $activity['activity_type'] = 'warning';
                $activity['fk_user_id'] = $this->session->userdata('user_id');
                $activity['activity_name'] = $this->session->userdata('user_name') . ' updated a product. Which ID -' . $edit;
                $activity['created_by'] = $this->session->userdata('user_id');
                $this->app_model->save_activity($activity);
            else:
                $data['create_time'] = $time;
                $data['create_date'] = $date;
                $data['created_by'] = $this->session->userdata('user_id');
                $result = $this->db->insert('tbl_products', $data);
                $insert_id = $this->db->insert_id();
                $activity = array();
                $activity['activity_type'] = 'success';
                $activity['fk_user_id'] = $this->session->userdata('user_id');
                $activity['activity_name'] = $this->session->userdata('user_name') . ' add a product. Which ID -' . $insert_id;
                $activity['created_by'] = $this->session->userdata('user_id');
                $this->app_model->save_activity($activity);
            endif;
            if ($result):
                echo 'success';
            endif;
        }
    }
}
